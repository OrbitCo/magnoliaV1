/* global site_rtl_settings */

function Im(params)
{

    this.properties = {
        site_url: '',
        age_lng: '[age] years old',
        history_lng: 'Show history',
        clear_confirm_lng: 'Are you sure you want to clear history?',
        active_ajax_timeout: 3,
        inactive_ajax_timeout: 6,
        contact_list_time: 0,
        statuses: {},
        id_user: 0,
        user_name: '',
        active_contact_id: 0,
        site_status: 0,
        get_contact_list_url: 'im/ajax_get_contact_list',
        set_site_status_url: 'im/ajax_set_site_status',
        get_messages_url: 'im/ajax_get_messages',
        post_message_url: 'im/ajax_post_message',
        get_history_url: 'im/ajax_get_history',
        clear_history_url: 'im/ajax_clear_history',
        get_status_url: 'im/ajax_get_im_status',
        get_init_url: 'im/ajax_get_init',
        available_view_url: '/application/js/available_view.js',
        available_status: 0,
        new_msgs: {contacts: {}, count_new: 0},
        chat_id: 'im_chat',
        chat_btn_id: 'im_chat_btn',
        contact_list_btn_id: 'im_chat_contact_list_btn',
        im_panel_id: 'im_panel',
        im_contact_list_id: 'im_contact_list',
        im_messages_window_id: 'im_messages_window',
        im_contact_list_search_id: 'im_contact_list_search',
        im_info_popup_id: 'im_info_popup',
        im_msg_btns_id: 'im_msg_btns',
        imMobileBlock: '.im-mobile-block',
        bottomBtns: '#bottom-btns',
        imPanelBottom: '#im_panel-bottom',
        toggleBlock: '.js-toggle-block',
        toggleSearch: '.js-toggle-search',
        is_dom_init: false,
        is_opened: false,
        errorObj: new Errors(),
        emojiPicker: null,
        position: (site_rtl_settings === 'rtl') ? 'left' : 'right',
    };

    let _p = {
        chat_obj: {},
        chat_btn_obj: {},
        contact_list_btn_obj: {},
        panel_obj: {},
        contact_list_obj: {},
        msg_window_obj: {},
        contact_list_search_obj: {},
        info_popup_obj: {},
        msg_close_btn_obj: {},
        msg_nick_obj: {},
        msg_textarea_obj: {},
        msg_chat_obj: {},
        msg_btns_obj: {},
        message_window_state: 0,
        ajax_site_status_to: null,
        info_popup_to: null,
        flash_to: null,
        xhr_site_status: null,
        xhr_history: null,
        xhr_clear_history: null,
        xhr_send_message: null,
        im_available_view: null,
        isset_service: false,
        access_denided: {
            get_messages: false,
            post_message: false
        }
    };

    this.init_vars = function () {
        _p.message_window_state = 0;
        _p.ajax_site_status_to = null;
        _p.info_popup_to = null;
        _p.flash_to = null;
        _p.xhr_site_status = null;
        _p.xhr_history = null;
        _p.xhr_clear_history = null;
        _p.xhr_send_message = null;
        _p.im_available_view = null;
        _p.isset_service = false;

        this.contact_users = {};
        this.contact_list = {};
        this.contact_temp = {};
        this.active_contact = {};
        this.contacts_drafts = {};
        this.contacts_messages = {};
    };

    let _self = this;

    _self.init_vars();

    $(document).on('users:login', function () {
        //_p.onLogin();
    }).on('users:logout, session:guest', function () {
        _p.onLogout();
    });

    this.init = function (options) {
        /* custom_B */
        if (typeof im == 'undefined') {

        } else {
            im.uninit();
        }
        /* /custom_B */

        options = options || {};
        $.extend(true, _self.properties, options);
        if (!_self.properties.id_user) {
            return this;
        }

        _p.initDomObjects();
        _p.initChatBtns();
        _self.setFlashingNewMessages();
        _self.getContactList(1);
        _p.initMultiRequest();

        $(document).off('im:hide').on('im:hide', function () {
            MultiRequest.properties.actions.im_get_contact_list.period = _self.properties.inactive_ajax_timeout;
            _p.info_popup_obj.hide();
        }).off('im:show').on('im:show', function () {
            MultiRequest.properties.actions.im_get_contact_list.period = _self.properties.active_ajax_timeout;
        }).off('click', '.mobile-menu-item[data-id=im_panel-bottom]').on('click', '.mobile-menu-item[data-id=im_panel-bottom]', function () {
            _p.info_popup_obj.hide();
            _self.checkImAvailable();
        }).off('click', _self.properties.toggleSearch).on('click', _self.properties.toggleSearch, function () {
            $(".js-header__search").show().focusout(function () {
                $(this).hide();
            }).find("input").focus();
        });

        return this;
    };

    this.uninit = function () {
        if (_self.properties.is_dom_init) {
            _p.chat_btn_obj.off('click');
            _p.contact_list_obj.off('click', '.im-contact').off('mouseenter', '.im-contact').off('mouseleave', '.im-contact').off('change keyup', '.im-bottom select[name="site_status"]');
            _p.msg_close_btn_obj.off('click');
            _p.contact_list_search_obj.off('change keydown keyup blur');
            _p.msg_btns_obj.off('click', 'input[name="sendbtn"]').off('click', '[data-button="profile"]').off('click', '[data-button="block"]').off('click', '[data-button="clear"]').off('click', '[data-mblock-id=im_panel-bottom]');
            _p.msg_textarea_obj.off('keydown');
            _p.msg_chat_obj.off('click', '.history a');
            _p.contact_list_btn_obj.off('click');
            _p.panel_obj.hide();
            _p.chat_btn_obj.hide();
            _p.contact_list_obj.hide();
            _p.msg_window_obj.hide();
            _p.info_popup_obj.hide();
        }
        $(document).trigger('im:hide');
        _self.properties.contact_list_time = 0;
        _self.properties.active_contact_id = 0;
        _self.properties.new_msgs = {contacts: {}, count_new: 0};
        _self.init_vars();
        return this;
    };

    _p.onLogin = function () {
        $.ajax({
            type: 'POST',
            url: _self.properties.site_url + _self.properties.get_init_url,
            data: {},
            success: function (resp, textStatus, jqXHR) {
                if (resp && resp.id_user) {
                    _self.properties.id_user = resp.id_user;
                    _self.properties.site_status = parseInt(resp.user_status.site_status);
                    _self.properties.new_msgs = resp.new_msgs;
                    _self.properties.user_name = resp.user_name;
                    _self.uninit().init();
                    _p.contact_list_obj.find('.im-bottom select[name="site_status"]').val(_self.properties.site_status);
                    let status_class = _p.chat_btn_obj.attr('data-status-class');
                    _p.chat_btn_obj.removeClass(status_class).addClass(_self.properties.statuses[_self.properties.site_status].text).attr('data-status-class', _self.properties.statuses[_self.properties.site_status].text);
                    if (_self.properties.statuses[_self.properties.site_status].text === 'offline') {
                        _p.chat_btn_obj.addClass('bg-delimiter_color');
                    } else {
                        _p.chat_btn_obj.removeClass('bg-delimiter_color');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
            complete: function () {

            },
            dataType: 'json',
            backend: 0,
            async: true
        });
    };

    _p.onLogout = function () {
        _self.properties.id_user = 0;
        _self.properties.site_status = 0;
        _self.properties.user_name = '';
        MultiRequest.disableAction('im_get_contact_list');
        MultiRequest.disableAction('im_new_msgs');
        _self.uninit();
    };

    this.die = function () {
        MultiRequest.disableAction('im_get_contact_list');
        MultiRequest.disableAction('im_new_msgs');
        _self.uninit();

        if ( _p.chat_obj.length > 0) {
            _p.chat_obj.remove();
        }
        return this;
    };

    _p.setService = function () {
        if (_p.isset_service) {
            return;
        }
        _p.isset_service = true;
    };

    _p.unsetService = function () {
        if (_p.isset_service) {
            _p.chat_btn_obj.off('click').on('click', function () {
                _p.chat_btn_obj.fadeOut();
                _self.showChat();
            });
        }
        _p.isset_service = false;
    };

    _p.getStatus = function (denied_callback, success_callback) {
        success_callback = success_callback || function () {};
        denied_callback = denied_callback || function () {};
        $.ajax({
            type: 'POST',
            url: _self.properties.site_url + _self.properties.get_status_url,
            data: {},
            success: function (resp) {
                if (resp) {
                    if (!_p.checkStatus(resp)) {
                        denied_callback();
                        return false;
                    }
                    success_callback();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
            dataType: 'json',
            backend: 0,
            async: false
        });
    };


    this.showChat = function () {
        _p.panel_obj.fadeIn();
        if (_p.message_window_state) {
            _p.msg_window_obj.fadeIn();
        } else {
            _p.msg_window_obj.hide();
        }
        $(document).trigger('im:show');
        return this;
    };


    this.hideChat = function () {
        _p.panel_obj.fadeOut({duration: 300, done: function () {
                $(document).trigger('im:hide');
                _p.chat_btn_obj.fadeIn(300);
        }});
        _p.msg_window_obj.fadeOut(300);
        _self.properties.active_contact_id = 0;
        return this;
    };


    this.sendMessage = function () {
        if (_p.xhr_send_message && _p.xhr_send_message.readyState !== 4) {
            return this;
        }

        let text = '';
        if (typeof _self.properties.emojiPicker !== 'undefined') {
            $('.emoji-wysiwyg-editor').find('img').each(function () {
                let alt = $(this).attr('alt');
                $(this).replaceWith(alt);
            });
            text = $('.emoji-wysiwyg-editor').html();
            if (typeof text == 'undefined') {
                text = _p.trimStr(_p.msg_textarea_obj.val());
            }
        } else {
            text = _p.trimStr(_p.msg_textarea_obj.val());
        }
        let id_contact = parseInt(_self.properties.active_contact_id);
        if (!text || !id_contact) {
            return this;
        }
        let min_max_id = _p.getMinMaxId(id_contact);

        _p.xhr_send_message = $.ajax({
            type: 'POST',
            url: _self.properties.site_url + _self.properties.post_message_url,
            data: {id_contact: id_contact, text: text, min_id: min_max_id.min_id, max_id: min_max_id.max_id},
            beforeSend: function () {
                //$('input[name="sendbtn"]').prop('disabled', true);
            },
            success: function (resp) {
                if (typeof resp.info.access_denied !== 'undefined' && resp.info.access_denied.length > 0) {
                    if (_p.access_denided.post_message === false) {
                        _p.access_denided.post_message = true;
                    }
                    _self.properties.errorObj.show_error_block(resp.info.access_denied, 'error');
                    return false;
                } else {
                    _p.access_denided.post_message = false;
                    if (resp.im_status) {
                        if (!_p.checkStatus(resp.im_status)) {
                            return false;
                        }
                    }

                    if (!resp.errors.length) {
                        _p.msg_textarea_obj.val('');

                        if (typeof _self.properties.emojiPicker !== 'undefined') {
                            _self.properties.emojiPicker.clearTextarea('.emoji-wysiwyg-editor');
                        }

                        if (resp.messages.msg.length) {
                            _p.setContactsMessages(id_contact, resp.messages);
                            _p.renderMessages(id_contact, resp.messages.msg, 'replace', true);
                            sendAnalytics('im_send_message', 'communication', 'user');
                        }
                    } else {
                        _self.properties.errorObj.show_error_block(resp.errors, 'error');
                    }
                    if (resp.notices && resp.notices.length) {
                        _self.properties.errorObj.show_error_block(resp.notices, 'info');
                    }
                }
            },
            dataType: 'json',
            async: true,
            backend: 0
        });
    };


    this.getContactList = function (formatted) {
        formatted = formatted || 0;
        $.ajax({
            type: 'POST',
            url: _self.properties.site_url + _self.properties.get_contact_list_url,
            data: {formatted: formatted},
            success: function (resp) {
                if (typeof resp.info.access_denied !== 'undefined' && resp.info.access_denied.length > 0) {
                    _p.panel_obj.find('.js-contact-window').html('<div class="p20">' + resp.info.access_denied + '</div>');
                    return false;
                } else {
                    if (resp.im_status) {
                        if (!_p.checkStatus(resp.im_status)) {
                            return false;
                        }

                        _self.updateContactList(resp);
                    } else if (resp.list) {
                        _self.updateContactList(resp);
                    }

                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                        console.error(errorThrown);
                }
            },
            complete: function () {
                MultiRequest.enableAction('im_get_contact_list');
            },
            dataType: 'json'
        });
        return this;
    };


    this.setActiveContact = function (id) {
        _self.active_contact = typeof _self.contact_users[id] !== 'undefined' ? _self.contact_users[id] : {};
        _p.contact_list_obj.find('.im-contact').removeClass('selected');
        $('#im_contact_list_contact_' + id).addClass('selected');
        return this;
    };

    this.resetActiveContact = function () {
        _p.contact_list_obj.find('.im-contact').removeClass('selected');
    };

    this.setActiveMessagesWindow = function (id) {
        let i = 0;

        let find_contact = setInterval(function () {
            _p.message_window_state = $('#im_contact_list_contact_' + id).length;
            i++;
            if (_p.message_window_state || i == 3) {
                clearInterval(find_contact);

                _self.properties.emojiPicker.discover();
                if (_self.properties.active_contact_id) {
                    _self.contacts_drafts[_self.properties.active_contact_id] = _p.msg_textarea_obj.val();
                }

                let text = _self.contacts_drafts[id] ? _self.contacts_drafts[id] : '';

                _self.properties.active_contact_id = id;

                if (_p.message_window_state) {
                    _p.access_denided.post_message = false;
                    _p.getContactsMessages(id);
                    _p.msg_nick_obj.html(_self.active_contact.output_name);
                    _p.msg_window_obj.show();

                    if (typeof _self.properties.emojiPicker !== 'undefined') {
                        _self.properties.emojiPicker.clearTextarea('.emoji-wysiwyg-editor', text);
                    } else {
                         _p.msg_textarea_obj.val(text);
                    }
                } else {
                    _p.msg_window_obj.hide();
                }

                return this;
            }
        }, 500);
    };

    this.updateNewMessages = function (data) {
        _self.properties.new_msgs = {count_new: data.count_new, contacts: {}};
        for (let i = 0; i < data.contacts.length; i++) {
            if (data.contacts[i].id_contact === _self.properties.active_contact_id) {
                _p.getContactsMessages(data.contacts[i].id_contact, true);
            } else {
                _self.properties.new_msgs.contacts[data.contacts[i].id_contact] = data.contacts[i];
            }
        }

        _self.setContactListFlashState();
        return this;
    };


    this.openContact = function (data) {
        let success_func = function () {
            let block_visible = true;
            if ($(document).width() < 768) {
                block_visible = $(_self.properties.imMobileBlock).is(':visible');
            }
            // if (_self.properties.active_contact_id === data.list[0].id_contact && block_visible) {
            //     _self.properties.active_contact_id = 0;
            //     _self.hideChat();
            // } else {
                _self.contact_temp = data.list[0];
                _self.contact_users[data.list[0].contact_user.id] = data.list[0].contact_user;
                _self.updateContactList({list: _self.contact_list});
                _p.chat_btn_obj.fadeOut();
                _self.showChat();
                _self.setActiveContact(data.list[0].id_contact);
                _self.setActiveMessagesWindow(data.list[0].id_contact);
            //}
        };
         _p.getStatus(
            function () {
                if (!_self.properties.available_status) {
                    _p.chat_btn_obj.fadeOut();
                    _self.showChat();
                    return false;
                }
            },
            success_func
        );
        if (_p.isset_service === false) {
            success_func;
        }
        if ($(document).width() < 768) {
            _p.info_popup_obj.hide();
            _self.checkImAvailable();
        }
    };


    this.updateContactList = function (data) {
        let old_list = _self.contact_list;
        let new_list = data.list;
        let is_lists_equals = _p.isContactListsEquals(old_list, new_list)
        if (new_list && new_list.length) {
            _self.contact_list = new_list;
            for (let i = 0; i < new_list.length; i++) {
                if (new_list[i].contact_user) {
                    _self.contact_users[new_list[i].contact_user.id] = new_list[i].contact_user;
                }
            }
        }

        let set_contacts_actions = false;
        // only if contact list was changed
        if (!is_lists_equals) {
            _p.contact_list_obj.find('.im-scroller').html('');
            for (let i = 0; i < _self.contact_list.length; i++) {
                let contact = _self.contact_users[_self.contact_list[i].id_contact] || false;

                if (contact) {
                    let age_text = contact.age ? _self.properties.age_lng.replace('[age]', contact.age) : '&nbsp;';
                    let status_lang = '';
                    if (typeof _self.contact_list[i].site_status !== 'undefined') {
                        contact.site_status = _self.contact_list[i].site_status;
                        status_lang = _self.properties.statuses[_self.contact_list[i].site_status].lang;
                    }
                    _p.renderContact(contact, age_text, status_lang);
                }
            }
            set_contacts_actions = true;
        }

        if (!$.isEmptyObject(_self.contact_temp)) {
            let contact = _self.contact_users[_self.contact_temp.id_contact];
            if (!$('#im_contact_list_contact_' + contact.id).length) {
                let age_text = contact.age ? _self.properties.age_lng.replace('[age]', contact.age) : '';
                let status_lang = _self.properties.statuses[0].lang;
                _p.renderContact(contact, age_text, status_lang, 'prepend');
                set_contacts_actions = true;
            }
        }

        if (set_contacts_actions) {
            _self.setActiveContact(_self.properties.active_contact_id);
            _self.setContactListFlashState();
            _self.searchContacts();
        }
        return this;
    };


    _p.renderContact = function (contact, age_text, status_lang, method) {
        method = method || 'append';
        let html =
                '<div id="im_contact_list_contact_' + contact.id + '" class="im-contact box-sizing">' +
                '<div class="im-contact__image"><img src="' + contact.thumbs.small + '" />';
        if (contact.site_status == 1) {
            html += '<div class="im-contact__status">' + status_lang + '</div>';
        }
        html += '</div>' +
                '<div class="im-contact__info">' + contact.output_name + '</div>';
        if (contact.location !== 'undefined' && contact.location.length > 0) {
            html += '<div class="im-contact__more-info hide">';
        } else {
            html += '<div class="im-contact__more-info hide is_blocked">';
        }
                html += '<div>' + age_text + '</div><div>' + contact.location + '</div>' +
                '</div>' +
                '</div>';

        if (method === 'append') {
            _p.contact_list_obj.find('.im-scroller').append(html);
        } else {
            if (!_p.contact_list_obj.find('#im_contact_list_contact_' + contact.id).length) {
                _p.contact_list_obj.find('.im-scroller').prepend(html);
            }
        }
    };


    _p.isContactListsEquals = function (list1, list2) {
        if (list1.length !== list2.length) {
            return false;
        }
        for (let i in list1) {
            if (!list1.hasOwnProperty(i)) {
                continue;
            }
            if (!list2.hasOwnProperty(i)) {
                return false;
            }
            if (!(list1[i].count_new === list2[i].count_new && list1[i].id_contact === list2[i].id_contact && list1[i].site_status === list2[i].site_status)) {
                return false;
            }
        }
        for (let i in list2) {
            if (list2.hasOwnProperty(i) && !list1.hasOwnProperty(i)) {
                return false;
            }
        }

        return true;
    };


    this.searchContacts = function (search_kw) {
        search_kw = search_kw || _p.trimStr(_p.contact_list_search_obj.val());
        if (search_kw) {
            for (let i = 0; i < _self.contact_list.length; i++) {
                let contact = _self.contact_users[_self.contact_list[i].id_contact];
                let regexp = new RegExp(search_kw, 'i');
                if (regexp.test(contact.output_name)) {
                    $('#im_contact_list_contact_' + contact.id).show();
                } else {
                    $('#im_contact_list_contact_' + contact.id).hide();
                }
            }
        } else {
            _p.contact_list_obj.find('.im-contact').show();
        }
        return this;
    };


    this.setSiteStatus = function (status) {
        if (_self.properties.site_status === status) {
            return false;
        }
        if (_p.ajax_site_status_to) {
            clearTimeout(_p.ajax_site_status_to);
        }
        _p.ajax_site_status_to = setTimeout(function () {
            if (_p.xhr_site_status) {
                _p.xhr_site_status.abort();
            }
            _p.xhr_site_status = $.ajax({
                type: 'POST',
                url: _self.properties.site_url + _self.properties.set_site_status_url,
                data: {site_status: status},
                success: function (resp, textStatus, jqXHR) {
                    if (resp) {
                        let status_class = _p.chat_btn_obj.attr('data-status-class');
                        _p.chat_btn_obj.removeClass(status_class).addClass(_self.properties.statuses[status].text).attr('data-status-class', _self.properties.statuses[status].text);
                        if (_self.properties.statuses[status].text === 'offline') {
                            _p.chat_btn_obj.addClass('bg-delimiter_color');
                        } else {
                            _p.chat_btn_obj.removeClass('bg-delimiter_color');
                        }
                        _self.properties.site_status = status;
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {

                },
                dataType: 'json',
                async: true,
                backend: 1
            });
        }, 300);

        return this;
    };


    this.setContactListFlashState = function () {
        _p.contact_list_obj.find('.im-contact [data-flash]').attr('data-flash', '0');
        if (_self.properties.new_msgs.contacts && !$.isEmptyObject(_self.properties.new_msgs.contacts)) {
            for (let i in _self.properties.new_msgs.contacts) {
                let contact = _self.properties.new_msgs.contacts[i];
                if (!$('#im_contact_list_contact_' + contact.id_contact).find('[data-flash]').length) {
                    $('#im_contact_list_contact_' + contact.id_contact).append('<s class="new-msg"><i class="fa fa-comment" data-flash="1"></i></s>');
                } else {
                    $('#im_contact_list_contact_' + contact.id_contact).find('[data-flash]').attr('data-flash', '1');
                }
            }
        }
        _p.contact_list_obj.find('.im-contact .new-msg [data-flash="0"]').remove();
        return this;
    };


    this.setFlashingNewMessages = function () {
        if (_p.flash_to) {
            clearTimeout(_p.flash_to);
        }

        let flash_obj = _p.chat_obj.find('[data-flash]');
        if (_self.properties.new_msgs.count_new > 0) {
            _p.chat_btn_obj.find('[data-flash]').attr('data-flash', '1');
            flash_obj = _p.chat_obj.find('[data-flash="1"]');

            if (flash_obj.hasClass('fa-comment')) {
                flash_obj.removeClass('fa-comment');
            } else {
                flash_obj.addClass('fa-comment');
                flash_obj.removeClass('fa-comments');
            }
        } else {
            flash_obj.attr('data-flash', '0').removeClass('fa-comment');
            flash_obj.addClass('fa-comments');
        }

        /* custom_B */
        if ($('#' + _self.properties.chat_btn_id + '[data-im-id="' + _p.chat_obj_rand_id + '"]').length == 1) {
            _p.flash_to = setTimeout(function () {
                _self.setFlashingNewMessages();
            }, 500);
        }
        /* /custom_B */

        return this;
    };


    this.getHistory = function () {
        if (_p.xhr_history && _p.xhr_history.readyState !== 4) {
            return this;
        }

        let id_contact = _self.properties.active_contact_id;
        let min_max_id = _p.getMinMaxId(id_contact);

        _p.xhr_history = $.ajax({
            type: 'POST',
            url: _self.properties.site_url + _self.properties.get_history_url,
            data: {id_contact: id_contact, max_id: min_max_id.max_id, min_id: min_max_id.min_id},
            success: function (resp, textStatus, jqXHR) {
                if (resp.im_status) {
                    if (!_p.checkStatus(resp.im_status)) {
                        return false;
                    }
                }
                if (resp.msg) {
                    _p.setContactsMessages(id_contact, resp);
                    _p.renderMessages(id_contact, resp.msg, 'prepend', true);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
            dataType: 'json',
            backend: 0
        });

        return this;
    };


    this.clearHistory = function () {
        if (_p.xhr_clear_history && _p.xhr_clear_history.readyState !== 4) {
            return this;
        }

        if (_self.properties.active_contact_id === 0) {
            return;
        }
        let id_contact = _self.properties.active_contact_id;
        let min_max_id = _p.getMinMaxId(id_contact);

        _p.xhr_clear_history = $.ajax({
            type: 'POST',
            url: _self.properties.site_url + _self.properties.clear_history_url,
            data: {id_contact: id_contact, max_id: min_max_id.max_id, min_id: min_max_id.min_id},
            success: function (resp, textStatus, jqXHR) {
                delete(_self.contacts_messages[id_contact]);
                _p.renderMessages(id_contact, {}, '');
                _p.getContactsMessages(id_contact);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
            dataType: 'json',
            backend: 0
        });

        return this;
    };


    _p.getContactsMessages = function (id_contact, force) {
        force = force || false;
        let messages = {}, min_max_id = _p.getMinMaxId(id_contact);
        if (_self.contacts_messages[id_contact]) {
            messages = _self.contacts_messages[id_contact].msg;
        } else {
            _self.contacts_messages[id_contact] = {min_id: min_max_id.min_id, max_id: min_max_id.max_id, msg: [], loaded: 0};
        }
        _p.renderMessages(id_contact, messages, '');
        _self.setContactListFlashState();

        if (!force && _self.contacts_messages[id_contact].loaded && !_self.properties.new_msgs.contacts[id_contact]) {
            return this;
        }

        $.ajax({
            type: 'POST',
            url: _self.properties.site_url + _self.properties.get_messages_url,
            data: {id_contact: id_contact, max_id: min_max_id.max_id, min_id: min_max_id.min_id},
            success: function (resp) {
                if (typeof resp.info.access_denied !== 'undefined' && resp.info.access_denied.length > 0) {
                    if (_p.access_denided.get_messages === false) {
                        _p.access_denided.get_messages = true;
                        _self.properties.errorObj.show_error_block(resp.info.access_denied, 'error');
                    }
                    return false;
                } else {
                    _p.access_denided.get_messages = false;
                    if (resp.im_status) {
                        if (!_p.checkStatus(resp.im_status)) {
                            return false;
                        }
                    }
                    if (resp.msg) {
                        _p.setContactsMessages(id_contact, resp);

                        if (_self.properties.new_msgs.contacts[id_contact]) {
                            delete(_self.properties.new_msgs.contacts[id_contact]);
                            _self.setContactListFlashState();
                        }
                        let render_type = _self.contacts_messages[id_contact].loaded ? 'replace' : '';
                        _p.renderMessages(id_contact, _self.contacts_messages[id_contact].msg, render_type);
                        _self.contacts_messages[id_contact].loaded = 1;
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
            dataType: 'json',
            backend: 1
        });

        return this;
    };


    _p.setContactsMessages = function (id_contact, data) {
        if (_self.contacts_messages[id_contact]) {
            if ((_self.contacts_messages[id_contact].min_id > data.min_id && data.min_id > 0) || _self.contacts_messages[id_contact].min_id === 0) {
                _self.contacts_messages[id_contact].min_id = data.min_id;
            }
            if (_self.contacts_messages[id_contact].max_id < data.max_id) {
                _self.contacts_messages[id_contact].max_id = data.max_id;
            }
            if (data.hasOwnProperty('history_exists')) {
                _self.contacts_messages[id_contact].history_exists = data.history_exists;
            }
        } else {
            _self.contacts_messages[id_contact] = {
                min_id: data.min_id,
                max_id: data.max_id,
                history_exists: (data.hasOwnProperty('history_exists')) ? data.history_exists : 0,
                msg: []
            };
        }

        for (let i = 0; i < data.msg.length; i++) {
            let msg_id = parseInt(data.msg[i].id);
            _self.contacts_messages[id_contact].msg[msg_id] = data.msg[i];
        }
    };


    _p.renderMessages = function (id_contact, messages, type, make_assoc) {
        if (id_contact != _self.properties.active_contact_id) {
            return this;
        }
        make_assoc = make_assoc || false;
        if (make_assoc) {
            let assoc_messages = [], msg_id = 0;
            for (let i in messages)
                if (messages.hasOwnProperty(i)) {
                    msg_id = parseInt(messages[i].id);
                    assoc_messages[msg_id] = messages[i];
                }
            }
            messages = assoc_messages;
        }
        let html = '', replace_from_msg_obj = null, replace_to_msg_obj = null, contact_user, user_name;

        for (let i in messages)
            if (messages.hasOwnProperty(i)) {
                contact_user = _self.contact_users[parseInt(messages[i].id_contact)];

                if (type === 'replace' && _p.msg_chat_obj.html()) {
                    let exists_msg = _p.msg_chat_obj.find('[data-msg-id="' + messages[i].id + '"]');
                    if (exists_msg.length) {
                        replace_from_msg_obj = exists_msg.prev('[data-msg-id]');
                        replace_to_msg_obj = exists_msg.next('[data-msg-id]');
                        exists_msg.remove();
                    }
                }

                user_name = messages[i].dir === 'o' ? _self.properties.user_name : '<a href="' + contact_user.link + '">' + contact_user.output_name + '</a>';

                //messages[i].text = _self.properties.emojiPicker.codeToColon(JSON.parse(JSON.stringify(messages[i].text).replace(/\\\\u/g, '\\u')));
                messages[i].text = _self.properties.emojiPicker.codeToColon(JSON.parse(JSON.stringify(messages[i].text)));
            // for without slash save format string in db
            // messages[i].text = _self.properties.emojiPicker.codeToColon(JSON.parse(JSON.stringify(messages[i].text).replace(/u/g, '\\u')));

                html +=
                    '<div class="im-msg clearfix ' + messages[i].dir + '" data-msg-id="' + messages[i].id + '">' +
                    '<div class="im-msg__date">' + messages[i].date_add_format + '</div>' +
                    '<div class="im-msg__photo g-pic-border g-rounded-small"><img src="' + contact_user.thumbs.small + '" /></div>' +
                    '<div class="im-msg__body">' +
                    '<div class="text" id="m' + messages[i].id + '">' + _self.properties.emojiPicker.colonToImage(messages[i].text) + '</div>' +
                    '</div>' +
                    '</div>';
            }
        }

        let prev_height = _p.msg_chat_obj.get(0).scrollHeight;
        switch (type) {
            case 'replace':
                if (replace_from_msg_obj && replace_from_msg_obj.length) {
                    replace_from_msg_obj.after(html);
                } else if (replace_to_msg_obj && replace_to_msg_obj.length) {
                    replace_to_msg_obj.before(html);
                } else {
                    _p.msg_chat_obj.append(html);
                    break;
                }
                break;
            case 'append':
                _p.msg_chat_obj.append(html).scrollTop(_p.msg_chat_obj.get(0).scrollHeight);
                break;
            case 'prepend':
                _p.msg_chat_obj.prepend(html);
                break;
            default:
                _p.msg_chat_obj.html(html).scrollTop(_p.msg_chat_obj.get(0).scrollHeight);
                break;
        }

        _p.msg_chat_obj.find('.history').remove();
        if (_self.contacts_messages[id_contact] && _self.contacts_messages[id_contact].history_exists) {
            _p.msg_chat_obj.prepend('<div class="history"><a href="javascript:;">' + _self.properties.history_lng + '</a></div>');
        }
        if (type === 'prepend') {
            _p.msg_chat_obj.scrollTop(_p.msg_chat_obj.get(0).scrollHeight - prev_height);
            _p.msg_chat_obj.animate({scrollTop: _p.msg_chat_obj.get(0).scrollHeight - prev_height - _p.msg_chat_obj.height() + 80}, 500);
        } else {
            _p.msg_chat_obj.scrollTop(_p.msg_chat_obj.get(0).scrollHeight);
        }

        return this;
    };


    _p.initDomObjects = function () {

        /* custom_B */
        _p.chat_obj_rand_id = Math.floor(Math.random() * Math.floor(99999999999));
        $('#' + _self.properties.chat_btn_id).attr('data-im-id',  _p.chat_obj_rand_id);
        $('#' + _self.properties.chat_id).attr('data-im-id',  _p.chat_obj_rand_id);

        _p.chat_btn_obj = $('#' + _self.properties.chat_btn_id + '[data-im-id="' + _p.chat_obj_rand_id + '"]');
        _p.chat_obj = $('#' + _self.properties.chat_id  + '[data-im-id="' + _p.chat_obj_rand_id + '"]');
        /* /custom_B */

        _p.contact_list_btn_obj = $('#' + _self.properties.contact_list_btn_id);
        _p.panel_obj = $('#' + _self.properties.im_panel_id);
        _p.contact_list_obj = $('#' + _self.properties.im_contact_list_id);
        _p.msg_window_obj = $('#' + _self.properties.im_messages_window_id);
        _p.contact_list_search_obj = $('#' + _self.properties.im_contact_list_search_id);
        _p.info_popup_obj = $('#' + _self.properties.im_info_popup_id);
        _p.msg_close_btn_obj = _p.msg_window_obj.find('.im-header>ins.im__close');
        _p.msg_nick_obj = _p.msg_window_obj.find('.im-header>span');
        _p.msg_textarea_obj = _p.msg_window_obj.find('.im-bottom textarea.im-textarea-js');
        _p.msg_chat_obj = _p.msg_window_obj.find('.im-content .im-scroller');
        _p.msg_btns_obj = $('.' + _self.properties.im_msg_btns_id);


        _p.contact_list_obj.off('click', '.im-contact').on('click', '.im-contact', function () {
            let id = $(this).attr('id');
            let contact_id = id.substr(id.lastIndexOf('_') + 1);
            _self.setActiveContact(contact_id);
            _self.setActiveMessagesWindow(contact_id);
            _p.message_window_state = 0;

        })
                .off('mouseenter', '.im-contact').on('mouseenter', '.im-contact', function () {
                    if ($(_self.properties.imMobileBlock).is(':hidden')) {
                        let more_info = $(this).find('.im-contact__more-info:not(.is_blocked)').html();
                        if (typeof more_info !== 'undefined') {
                            _p.info_popup_obj.html($(this).find('.im-contact__more-info').html());
                    let top = _p.panel_obj.position().top + $(this).position().top + ($(this).outerHeight() / 2);
                    let right = _p.contact_list_obj.width();
                            _p.info_popup_obj.css('top', top + 'px');
                            _p.info_popup_obj.css(_self.properties.position, right + 'px');
                            if (_p.info_popup_obj.is(':visible')) {
                                _p.info_popup_obj.stop().show();
                            } else {
                                if (_p.info_popup_to) {
                                    clearTimeout(_p.info_popup_to);
                                }
                                _p.info_popup_to = setTimeout(function () {
                                    if (_p.panel_obj.is(':visible')) {
                                        _p.info_popup_obj.stop().fadeIn(100);
                                    }
                                }, 500);
                            }
                        }
                    }
                }).off('mouseleave', '.im-contact').on('mouseleave', '.im-contact', function () {
                    if (_p.info_popup_to) {
                        clearTimeout(_p.info_popup_to);
                    }
                    $('#im_info_popup').fadeOut(200);
                }).off('change keyup', '.im-bottom select[name="site_status"]').on('change keyup', '.im-bottom select[name="site_status"]', function () {
            let status = $(this).val();
                    _self.setSiteStatus(status);
                });

        _p.contact_list_search_obj.off('change keydown keyup blur').on('change keydown keyup blur', function () {
            _self.searchContacts();
        });

        _p.msg_btns_obj.off('click', 'input[name="sendbtn"]').on('click', 'input[name="sendbtn"]', function () {
            _self.sendMessage();
        }).off('click', '[data-button="profile"]').on('click', '[data-button="profile"]', function () {

            locationHref(_self.active_contact.link);
        }).off('click', '[data-button="block"]').on('click', '[data-button="block"]', function () {
            locationHref(_self.active_contact.link, true);
        }).off('click', '[data-button="clear"]').on('click', '[data-button="clear"]', function () {
            alerts.show({
                text: _self.properties.clear_confirm_lng,
                type: 'confirm',
                ok_callback: function () {
                    _self.clearHistory();
                }
            });
        });

        _p.msg_close_btn_obj.off('click').on('click', function () {
            _self.setActiveContact(0);
            _self.setActiveMessagesWindow(0);
        });

        $('#im_msg_btns').off('keydown', '.emoji-wysiwyg-editor').on('keydown', '.emoji-wysiwyg-editor', function (e) {
            if (e.ctrlKey && e.keyCode === 13) {
                _self.sendMessage();
            }
        });

        _p.msg_chat_obj.off('click', '.history a').on('click', '.history a', function () {
            _self.getHistory();
        });

        _p.contact_list_obj.show();
        _self.properties.is_dom_init = true;
        return this;
    };


    _p.initChatBtns = function () {
        _p.chat_btn_obj.off('click').on('click', function () {
            _p.chat_btn_obj.fadeOut();
            _self.showChat();
        }).show();

        _p.contact_list_btn_obj.off('click').on('click', function () {
            _self.resetActiveContact();
            _self.hideChat();
        });
        return this;
    };


    _p.initMultiRequest = function () {
        let actions = [
            {
                gid: 'im_new_msgs',
                params: {module: 'im', model: 'ImContactListModel', method: 'backendCheckNewMessages'},
                paramsFunc: function () {
                    return {};
                },
                callback: function (resp) {
                    if (resp) {

                        /* custom_B */
                        _self = im;
                        /* /custom_B */

                        if (resp.im_status) {
                            _self.properties.available_status = resp.im_status.im_service_access;
                        }
                        _self.updateNewMessages(resp);
                        _self.updateCountMessages(resp.count_new);
                    }
                },
                period: 3,
                status: 1
        },
            {
                gid: 'im_get_contact_list',
                params: {module: 'im', model: 'ImContactListModel', method: 'getContactList'},
                paramsFunc: function () {
                    let result = {loaded_contact_ids: ''};
                    let loaded_contact_ids = [];
                    for (let i in _self.contact_users) {
                        loaded_contact_ids.push(_self.contact_users[i].id);
                    }
                    result.loaded_contact_ids = loaded_contact_ids.join(',');
                    return result;
                },
                callback: function (resp) {
                    if (resp.im_status) {
                        _self.properties.available_status = resp.im_status.im_service_access;
                        if (!_p.checkStatus(resp.im_status)) {
                            return false;
                        }
                    }
                    if (resp.list && _self.properties.available_status) {
                        _self.updateContactList(resp);
                    }
                },
                period: _self.properties.inactive_ajax_timeout,
                status: 0
        }
        ];

        MultiRequest.initActions(actions);
        return this;
    };


    _p.getMinMaxId = function (id_contact) {
        let min_id = 0, max_id = 0;
        if (_self.contacts_messages[id_contact]) {
            min_id = _self.contacts_messages[id_contact].min_id;
            max_id = _self.contacts_messages[id_contact].max_id;
        }
        return {min_id: min_id, max_id: max_id};
    };

    _p.checkStatus = function (status) {
        if (status.id_user === 0) {
            _p.onLogout();
        } else if (_self.properties.id_user === 0) {
            _p.onLogin();
        }
        if (status.im_on === 0) {
            _self.die();
            return false;
        }
        if (!status.im_service_access) {
            _p.setService();
            return false;
        } else if (_p.isset_service) {
            _p.unsetService();
        }
        return true;
    };

    _p.trimStr = function (s) {
        s = s.replace(/^\s+/g, '');
        return s.replace(/\s+$/g, '');
    };

    this.createMobileBlock = function (width, reload) {
        if (_self.properties.available_status === false) {
            locationHref(_self.properties.site_url + 'access_permissions/');
        }
        if (_p.im_available_view === null || reload === 1) {
            if (typeof width === 'undefined') {
                width = $(window).width();
            }
            if (width < 768) {
                if (!$(_self.properties.imPanelBottom).find('div').length) {
                    _self.showChat();
                    _p.chat_btn_obj.hide();
                    _p.chat_obj.appendTo(_self.properties.imPanelBottom);
                }
            } else {
                if ($(_self.properties.imPanelBottom).find('div').length) {
                    _self.resetActiveContact();
                    _self.hideChat();
                    _p.chat_btn_obj.show();
                    _p.chat_obj.prependTo(_self.properties.bottomBtns);
                }
            }
        }
        return this;
    };

    this.updateCountMessages = function (count) {
        if (count > 0) {
            $('.mobile-top-menu').find('[data-mblock-id=im_panel-bottom]').html('<span class="badge">' + count + '</span>');
        } else {
            $('.mobile-top-menu').find('[data-mblock-id=im_panel-bottom]').html('');
        }
        return this;
    };

    this.checkImAvailable = function () {
        if (_p.im_available_view && !_self.properties.available_status) {
            _p.im_available_view = new available_view({
                siteUrl: _self.properties.site_url,
                checkAvailableAjaxUrl: 'im/ajax_available_im/',
                buyAbilityAjaxUrl: 'im/ajax_activate_im/',
                buyAbilityFormId: 'ability_form',
                buyAbilitySubmitId: 'ability_form_submit',
                success_request: function (message) {
                    _self.properties.errorObj.show_error_block(message, 'success');
                },
                fail_request: function (message) {
                    _self.properties.errorObj.show_error_block(message, 'error');
                },
                windowObj: new loadingContent({loadBlockWidth: '520px', destroyOnReload: false, closeBtnClass: 'w'})
            });
            _p.getStatus(
                    function () {
                        _p.im_available_view.check_available();
                    });
        } else {
            //if ($(_self.properties.imMobileBlock).is(':hidden')) {
                $(_self.properties.toggleBlock).hide();
                _self.createMobileBlock($(window).width());
            if (_self.properties.available_status) {
                $(_self.properties.imMobileBlock).parent('div').show();
            }
                _p.initDomObjects();
            // } else {
            //     $(_self.properties.toggleBlock).hide();
            // }
        }
        return this;
    };

    this.scrollToIm = function () {
        let width = $(window).width();
        if (width < 768) {
            $('html, body').animate({scrollTop: $(_self.properties.imMobileBlock).offset().top}, 800);
        }
        return this;
    };

    _self.init(params);

    return this;
}
