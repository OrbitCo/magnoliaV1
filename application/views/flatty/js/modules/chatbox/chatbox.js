function Chatbox(optionArr)
{
    this.properties = {
        siteUrl: '',
        loadUsersFormLink: 'chatbox/ajax_add_contact_form',
        startDialogLink: 'chatbox/ajax_open_dialog',
        getDialogsLink: 'chatbox/ajax_get_dialogs',
        deleteDialogLink: 'chatbox/ajax_delete_dialog',
        sendMessageLink: 'chatbox/ajax_send_message',
        loadMessagesLink: 'chatbox/ajax_get_messages',
        deleteMessageLink: 'chatbox/ajax_delete_message',
        lastMessagesStatusLink: 'chatbox/ajax_messages_status',

        btnOk: "Ok",
        btnCancel: "Cancel",
        mini: false,

        contactId: 0,
        addNewContactBtn: '.js-add-contact',
        sendMsgId: 'chb_message',
        sendMsgBtnId: 'chb_send_msg_btn',
        dialogStateClass: 'dialog-opened',

        user_id: 0,

        l_time: 0,
        errorObj: new Errors(),
        usersContentObj: new loadingContent({
            loadBlockTopType: 'center',
            loadBlockWidth: '50%',
            closeBtnPadding: 12,
            blockBody: true,
            showAfterImagesLoad: false,
        }),
        langs: {
            text_your: 'Вы',
            notice_clear_history: 'Вы действительно хотите очистить историю сообщений с этим пользователем?',
            notice_delete_message: 'Вы действительно хотите удалить это сообщение?',
        },
        isFocusPage: 1,
        uploaded: false,
        gallery: null,
        next_gallery_image: null,
        prev_gallery_image: null,
        images: [],
        image_lng: 'Image',
        emojiPicker: null,
        check_is_read_mess: null,
        key_sent_btn: null,
    };

    var _self = this,

        xhrLoadDialogs = null,
        xhrLoadHistory = null,

        _p = {
            dialogBox: '',
            emptyDialogBox: '',
            historyLoaded: false,
            dialogsLoaded: false,
    };



    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);

        _p.dialogBox = $('#chb_dialog');
        _p.emptyDialogBox = $('.chatbox-dialog__empty');

        _self.initActions();
        _self.initUsersActions();

        _self.properties.gallery = new loadingContent({
            loadBlockID: 'chatbox_gallery',
            loadBlockBgID: 'chatbox_gallery_bg',
            loadBlockWidth: '980px',
            loadBlockTopType: 'top',
            loadBlockTopPoint: 10,
            linkerObjID: null,
            blockBody: true,
            showAfterImagesLoad: true,
            closeBtnClass: 'w'
        });

        if (!_self.properties.check_is_read_mess) {
            _self.initMultiRequest();
        }

        if (_self.properties.contactId != 0) {
            _self.startDialog(_self.properties.contactId);
        }

        window.onfocus = () => _self.properties.isFocusPage = 1;
        window.onblur = () => _self.properties.isFocusPage = 0;

        /*if (!_self.properties.mini) {
            $(window).resize(function() {
                if ($( window ).width() > 767) {
                    $('body').css('overflow', 'auto');
                } else {
                    $('body').css('overflow', 'hidden');
                }
            });

            $(window).trigger('resize');
        }*/
    };

    this.initActions = function () {
        $(_self.properties.addNewContactBtn).off('click').click(function () {
            _self.openAddContactForm();
        });

        // $('.chatbox-users__list').slimScroll({
        //  /*   height: '497px',*/
        //     height: '426px',
        //     railVisible: false,
        //     alwaysVisible: false,
        //     size: '5px',
        //     wheelStep: 7,
        //     allowPageScroll: true,
        //     scrollY85: function () {
        //         let search_kw = _self.trimStr($('.chatbox-users__filter input[type=text]').val());
        //         _self.loadDialogs(search_kw, true);
        //     }
        // });

        $('.chatbox-users__filter input[type=text]').off('change').change(function () {
            _p.dialogsLoaded = false;
            let search_kw = _self.trimStr($('.chatbox-users__filter input[type=text]').val());
            _self.loadDialogs(search_kw, false, true);
        });
    }

    this.initUsersActions = function () {
        $('.chatbox-users__user').off('click').click(function (e) {
            if (!$(e.target).hasClass('chatbox-users__delele')) {
                let contact_id = $(this).data('contact-id');
                _self.startDialog(contact_id);
            }
            return false;
        });



        $('.chatbox-users__delele').off('click').click(function () {
            let contact_id = $(this).data('contact-id');
            _self.viewAlert(_self.properties.langs.notice_clear_history, 'deleteDialog', contact_id);

            return false;
        });

        $('.chatbox-users__list ul li').each(function () {
            let $message = $(this).find('.chatbox-users__message:not(.emoji-rendered)');
            if (typeof $message.html() != 'undefined') {
                $message.html(_self.properties.emojiPicker.colonToImage(_self.properties.emojiPicker.codeToColon(JSON.parse(JSON.stringify($message.html()).replace(/\\\\u/g, '\\u')))));
                $message.addClass('emoji-rendered');
            }
        });
    }

    this.initDialogActions = function () {
        $('#chb_close_dialog').off('click').click(function () {
            _self.closeDialog();
            return false;
        });

        // let scroll_height = '425px';

        // if (_self.properties.mini) {
        //     scroll_height = '367px';
        // }

        // $('.chatbox-dialog__messages').slimScroll({
        //     height: scroll_height,
        //     railVisible: false,
        //     alwaysVisible: false,
        //     size: '5px',
        //     wheelStep: 7,
        //     start: 'bottom',
        //     allowPageScroll: true,
        //     scrollY15: function () {
        //         _self.loadHistory();
        //     }
        // });

        // если картинки не успели прогрузится
        // setTimeout(function () {
        //     let scrollTo_val = $('.chatbox-dialog__messages').prop('scrollHeight');
        //     $('.chatbox-dialog__messages').slimScroll({scrollTo: scrollTo_val + 'px'});
        // }, 500);

        _self.properties.emojiPicker.discover();
        if (typeof _self.properties.emojiPicker !== 'undefined') {
            _self.properties.emojiPicker.clearTextarea('.emoji-wysiwyg-editor', '');
        } else {
            $('#' + _self.properties.sendMsgId).val('');
        }

        let $emojiEditor = $('#' + _self.properties.sendMsgId).parent().find('.emoji-wysiwyg-editor');


        $emojiEditor.off('keypress').keypress(function (e) {
            if (_self.properties.key_sent_btn != 'enter') {
                if (e.keyCode == 13 && e.shiftKey) {
                    $('#' + _self.properties.sendMsgBtnId).click();
                    return false;
                }
            } else {
                if (e.keyCode == 13 && e.shiftKey) {
                    return true;
                } else if (e.keyCode == 13) {
                    e.preventDefault();
                    e.stopPropagation();
                    $('#' + _self.properties.sendMsgBtnId).click();
                    return false;
                }
            }

        });
    }

    this.viewAlert = function (text, func, id) {
        var contentObj = new loadingContent({
            loadBlockWidth: '50%',
            closeBtnClass: 'w',
            scroll: true,
            otherClass: 'alert_load',
            closeBtnPadding: 5,
            blockBody: true,
        });
        var cont_id = contentObj.show_load_block('<div class="center"><div class="alert_text">' + text + '</div><button class="alert_ok alert_ok_delete btn btn-primary mt20 mlr20">' + _self.properties.btnOk + '</button> <button class="alert_cancel alert_cancel_delete btn btn-cancel mt20 mlr20">' + _self.properties.btnCancel + '</button></div>');
        $('.alert_ok.alert_ok_delete').unbind('click').on('click', function () {
            _self[func](id);
            $('.load_content_close').click();
            $('#' + cont_id).parent().hide();
        });
        $('.alert_cancel.alert_cancel_delete').unbind('click').on('click', function () {
            $('.load_content_close').click();
            $('#' + cont_id).parent().hide();
        });
    }

    this.initMessagesAction = function () {
        $('.chatbox-messages__message-image').off('click').click(function () {
            _self.initGallery($(this));
        });

        $('.chatbox-messages__delele').off('click').click(function () {
            let message_id = $(this).data('message-id');
            _self.viewAlert(_self.properties.langs.notice_delete_message, 'deleteMessage', message_id);

            return false;
        });
        $('.chatbox [data-toggle="tooltip"]').tooltip();

        $('.chatbox-dialog__messages ul li').each(function () {
            let $message = $(this).find('.chatbox-messages__message:not(.emoji-rendered)');
            if (typeof $message.html() != 'undefined') {
                $message.html(_self.properties.emojiPicker.colonToImage(_self.properties.emojiPicker.codeToColon(JSON.parse(JSON.stringify($message.html()).replace(/\\\\u/g, '\\u')))));
                $message.addClass('emoji-rendered');
            }
        });
    }

    this.loadDialogs = function (search_kw, load_more, is_search) {
        if (xhrLoadDialogs == true) {
            return;
        }

        load_more = load_more || false;
        is_search = is_search || false;

        if (load_more && _p.dialogsLoaded == true) {
            return;
        }

        let is_backend = 0;
        let l_date = '';
        let l_id = 0;
        if (load_more) {
            let $l_dialog = $('.chatbox-users__list li.chatbox-users__user:last');
            if ($l_dialog) {
                l_date = $l_dialog.data('udate');
                l_id = $l_dialog.data('id');
            }
            is_backend = 1;
        }

        xhrLoadDialogs = true;
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.getDialogsLink,
            type: 'POST',
            data: {
                search: search_kw,
                l_date: l_date,
                l_id: l_id
            },
            dataType: 'json',
            cache: false,
            backend: is_backend,
            success: function (resp) {
                xhrLoadDialogs = false;
                if (!load_more) {
                    _self.renderDialogs(resp.dialogs, false, is_search);
                } else {
                    if (resp.count > 0) {
                        _self.renderDialogs(resp.dialogs, true, is_search);
                    } else {
                        _p.dialogsLoaded = true;
                    }
                }
            }
        });

        return this;
    };

    this.renderDialogs = function (dialogs, load_more, is_search) {
        load_more = load_more || false;
        is_search = is_search || false;

        $('.chatbox-users__list .empty').hide();
        if (!dialogs.length && !load_more) {
            $('.chatbox-users__list .empty').show();
        }

        if (!load_more) {
            $('.chatbox-users__list li.chatbox-users__user').remove();
        }

        $dialogs_block = $('.chatbox-users__list ul');

        for (let i in dialogs) {
            if (!$dialogs_block.find('#chb_user_' + dialogs[i].contact_id).length) {
                $dialogs_block.append(dialogs[i].html);
            }
        }

        _self.initUsersActions();

        if (is_search) {
            $('.chatbox-users__list').slimScroll({
                scrollTo: '0px'
            });
        } else {
            let bar = $('.chatbox-users__list').parent().find('.slimScrollBar');
            let percentScroll = parseInt(bar.css('top')) / ($('.chatbox-users__list').outerHeight() - bar.outerHeight());
            // если диалоги были не проскролены, то ставим скрол в верхнее положение
            if (percentScroll == 0) {
                $('.chatbox-users__list').slimScroll({
                    scrollTo: '0px'
                });
            }
        }

        return this;
    }

    this.deleteDialog = function (contact_id) {
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.deleteDialogLink,
            type: 'POST',
            data: {
                contact_id: contact_id
            },
            dataType: 'json',
            success: function (resp) {
                if (typeof resp.success != 'undefined' && resp.success == 1) {
                    if (contact_id == _self.properties.contactId) {
                        _self.closeDialog();
                    }
                    $('.chatbox-users__list li#chb_user_' + contact_id).remove();
                }
            }
        });

        return this;
    }

    this.loadHistory = function () {
        if (xhrLoadHistory == true || _p.historyLoaded == true) {
            return;
        }

        let f_adate = '';
        let $first_msg = $('.chatbox-dialog__messages li.chatbox-messages__item:first');
        if ($first_msg) {
            f_adate = $first_msg.data('date-added');
        }

        xhrLoadHistory = true;
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.loadMessagesLink,
            type: 'POST',
            data: {
                contact_id: _self.properties.contactId,
                f_adate: f_adate
            },
            dataType: 'json',
            cache: false,
            backend: 1,
            success: function (resp) {
                xhrLoadHistory = false;
                if (resp.count > 0) {
                    _self.renderMessages(resp.messages, true);
                    //$('.chatbox-dialog__messages').scrollTop($('.chatbox-dialog__messages ul').height());
                } else {
                    _p.historyLoaded = true;
                }
            }
        });

        return this;
    }

    this.openAddContactForm = function () {
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.loadUsersFormLink,
            type: 'GET',
            cache: false,
            success: function (resp) {
                _self.properties.usersContentObj.show_load_block(resp);

            }
        });
    }

    this.initMultiRequest = function () {


        const actions = [
            {
                gid: 'check_is_read_messages',
                params: {module: 'chatbox', model: 'ChatboxModel', method: 'backendMessagesStatus'},
                paramsFunc: function () {
                    let contacts = [];

                    if ($('.chatbox-users__user').length > 0) {
                        $('.chatbox-users__user').each(function () {
                            if (parseInt($(this).data('contact-id')) != parseInt(_self.properties.user_id)) {
                                if ($(this).find('.chatbox-users__your')) {
                                    if (!($(this).find('.chatbox-users__message').hasClass('is_read'))) {
                                        contacts.push($(this).data('contact-id'));
                                    }
                                }
                            }
                        });
                    }

                    return {contacts: contacts};
                },
                callback: function (resp) {
                    if (resp.last_status_messages) {
                        for (let i in resp.last_status_messages) {
                            if ($('.chatbox-users__user[data-contact-id="' + resp.last_status_messages[i].user_id + '"]').length > 0) {
                                if (resp.last_status_messages[i].is_read == '1') {
                                    $('.chatbox-users__user[data-contact-id="' + resp.last_status_messages[i].user_id + '"] .chatbox-users__message').addClass('is_read');

                                    if (i == _self.properties.contactId) {
                                        $('.chatbox-messages__bubble-right').each(function () {
                                            $(this).parent().parent().addClass('is_read');
                                        });
                                    }
                                }
                            }
                        }
                    }
                },
                period: 1,
                status: 1
        }
        ];

        MultiRequest.initActions(actions);
        return this;
    };

    this.startDialog = function (contact_id, close_add_contact_popup) {
        // if (_self.properties.check_is_read_mess) {
        //     clearInterval(_self.properties.check_is_read_mess);
        //     _self.properties.check_is_read_mess = null;
        // }

        close_add_contact_popup = close_add_contact_popup || false;
        if (close_add_contact_popup) {
            _self.properties.usersContentObj.hide_load_block();
        }

        $.ajax({
            url: _self.properties.siteUrl + _self.properties.startDialogLink,
            type: 'POST',
            data: {
                contact_id: contact_id
            },
            dataType: 'json',
            success: function (resp) {
                if (resp.errors) {
                    _self.properties.errorObj.show_error_block(resp.errors, 'error');
                } else {
                    if (resp.content) {
                        _self.properties.contactId = resp.contact_id;
                        if (_self.properties.user_id) {
                        }
                        $('.chatbox-users__user').removeClass('active');
                        $('#chb_user_' + _self.properties.contactId).addClass('active');
                        $('#chb_user_' + _self.properties.contactId).find('.chatbox-users__new_msg').html('');
                        _p.dialogBox.html(resp.content);
                        _p.emptyDialogBox.hide();
                        _p.historyLoaded = false;
                        _self.initDialogActions();
                        _self.initMessagesAction();
                        _p.dialogBox.show();
                        _self.scrollToNewMsgs();
                        $('.emoji-wysiwyg-editor').focus();
                        $('.emoji-wysiwyg-editor').click();

                        if (!_self.properties.mini) {
                            history.pushState(null, null, _self.properties.siteUrl + 'chatbox/index/' + contact_id);
                        }

                        $('#chatbox').addClass(_self.properties.dialogStateClass);
                        $('.chatbox-dialog__footer').css('display', 'table');
                        if (_self.properties.user_id == _self.properties.contactId) {
                            $('.chatbox-dialog__footer').css('display', 'none');
                        }

                        if (!_self.properties.check_is_read_mess) {
                            _self.initMultiRequest();
                        }
                    }
                }
            }

        });
    }

    this.scrollToNewMsgs = function () {
        var scroll = $('.chatbox-dialog__messages ul').height();
        if ($('.chatbox-dialog__messages ul > li.chatbox-messages__item_new:first').length > 0) {
            scroll = $('.chatbox-dialog__messages ul > li.chatbox-messages__item_new:first').offset().top - 200;
        }
        $('.chatbox-dialog__messages').animate({ scrollTop: scroll }, () => {
            $('.chatbox-dialog__messages').scroll(function () {
                if (_self.properties.isFocusPage === 1) {
                    setTimeout(() => {
                        $('.chatbox-dialog__messages ul > li').removeClass('chatbox-messages__item_new')
                    }, 2000);
                }
            });
        });
    }

    this.closeDialog = function () {
        _self.properties.contactId = 0;

        if (!_self.properties.mini) {
            history.pushState(null, null, './');
        }

        $('.chatbox-users__user').removeClass('active');
        _p.dialogBox.html('');
        _p.dialogBox.hide();
        _p.emptyDialogBox.show();
        _p.historyLoaded = false;
        $('#chatbox').removeClass(_self.properties.dialogStateClass);
    }

    this.sendMessage = function () {
        if (_self.properties.contactId) {
            let message = $('#' + _self.properties.sendMsgId).val();

            if (_self.trimStr(message) != '') {
                let l_adate = '';
                let $last_msg = $('.chatbox-dialog__messages li.chatbox-messages__item:last');
                if ($last_msg) {
                    l_adate = $last_msg.data('date-added');
                }

                $.ajax({
                    url: _self.properties.siteUrl + _self.properties.sendMessageLink,
                    type: 'POST',
                    data: {
                        contact_id: _self.properties.contactId,
                        message: message,
                        l_adate: l_adate
                    },
                    dataType: 'json',
                    cache: false,
                    success: function (resp) {
                        if (typeof resp.errors != 'undefined' && resp.errors != '') {
                            _self.properties.errorObj.show_error_block(resp.errors, 'error');
                        } else {
                            $('#' + _self.properties.sendMsgId).val('');
                            $('#' + _self.properties.sendMsgId).css('height', 'auto');

                            if (typeof _self.properties.emojiPicker !== 'undefined') {
                                _self.properties.emojiPicker.clearTextarea('.emoji-wysiwyg-editor');
                            }
                            $('#' + _self.properties.sendMsgId).parent().find('.emoji-wysiwyg-editor').css('height', 'auto');

                            _self.renderMessages(resp.messages);
                            //$('.chatbox-dialog__messages').scrollTop($('.chatbox-dialog__messages ul').height());
                            $('.chatbox-dialog__messages').animate({ scrollTop: $('.chatbox-dialog__messages ul').height() }, "fast");

                            if (resp.contact) {
                                $("#chb_user_" + resp.contact.id).replaceWith(resp.contact.html);
                                $("#chb_user_" + resp.contact.id).removeClass('active');
                            }
                        }
                        return false;
                    }
                });
            }
        }
        return false;
    }

    this.getMessages = function (only_new) {
        only_new = only_new || 0;
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.loadMessagesLink,
            type: 'POST',
            data: {
                contact_id: _self.properties.contactId,
                only_new: only_new
            },
            dataType: 'json',
            cache: false,
            success: function (resp) {
                if (resp.messages) {
                    _self.renderMessages(resp.messages);
                }
            }
        });
    }

    this.renderMessages = function (messages, is_history) {
        is_history = is_history || false;

        if (messages.length) {
            $('.chatbox-dialog__messages-empty').hide();
        } else {
            return;
        }

        $messages_block = $('.chatbox-dialog__messages ul');
        let prev_mb_height = $('.chatbox-dialog__messages').prop('scrollHeight');
        let prepend_html_string = '';

        for (let i in messages) {
            if (!$messages_block.find('#chb_msg_' + messages[i].id).length) {
                if (is_history) {
                    prepend_html_string += messages[i].html;
                } else {
                    last_msg = messages[i];
                    $messages_block.append(messages[i].html);
                }
            }
        }

        if (is_history && prepend_html_string != '') {
            $messages_block.prepend(prepend_html_string);
        }

        _self.initMessagesAction();

        let scroll_pos = $('.chatbox-dialog__messages ul').height() - $('.chatbox-dialog__messages').scrollTop() - $('.chatbox-dialog__messages').height();

        if (scroll_pos < 160) {
            $('.chatbox-dialog__messages').animate({ scrollTop: $('.chatbox-dialog__messages ul').height() }, "fast");
        }

        // if (is_history) {
        //     let mb_height = $('.chatbox-dialog__messages').prop('scrollHeight');
        //     if (mb_height != prev_mb_height) {
        //         $('.chatbox-dialog__messages').slimScroll({
        //             scrollTo: (mb_height - prev_mb_height) + 'px'
        //         });
        //     }
        // } else {
        //     let bar = $('.chatbox-dialog__messages').parent().find('.slimScrollBar');
        //     let percentScroll = parseInt(bar.css('top')) / ($('.chatbox-dialog__messages').outerHeight() - bar.outerHeight());
        //     // если сообщения были проскролены до конца, то ставим скрол в нижнее положение
        //     if (percentScroll == 1) {
        //         let mb_height = $('.chatbox-dialog__messages').prop('scrollHeight');
        //         $('.chatbox-dialog__messages').slimScroll({
        //             scrollTo: mb_height + 'px'
        //         });

        //         // если картинки не успели прогрузится
        //         setTimeout(function () {
        //             $('.chatbox-dialog__messages').slimScroll({
        //                 scrollTo: mb_height + 'px'
        //             });
        //         }, 500);
        //     }
        // }

        return this;
    }

    this.deleteMessage = function (message_id) {
        if (message_id) {
            $.ajax({
                url: _self.properties.siteUrl + _self.properties.deleteMessageLink,
                type: 'POST',
                data: {
                    message_id: message_id
                },
                dataType: 'json',
                cache: false,
                success: function (resp) {
                    if (resp.success == 1) {
                        $('.chatbox-dialog__messages li#chb_msg_' + message_id).remove();

                        if (resp.msg_count === 0) {
                            $('.chatbox-dialog__messages-empty').show();
                            $('.chatbox-users__list li#chb_user_' + _self.properties.contactId).remove();
                        }
                    }
                }
            });
        }
    }

    this.initGallery = function (image_object) {
        if (image_object) {
            let gallery = $(image_object).closest('.chatbox-dialog__messages').attr('gallery');
            _self.properties.images = $('.chatbox-dialog__messages[gallery="' + gallery + '"]').find('img.chatbox-messages__message-image');
            $(document).off('click', '#chatbox_gallery [data-click=next_media]').on('click', '[data-click=next_media]', function () {
                _self.nextGalleryImage();
            });
            $(document).off('click', '#chatbox_gallery [data-click=prev_media]').on('click', '[data-click=prev_media]', function () {
                _self.prevGalleryImage();
            });
            _self.setGalleryImage(image_object.get(0));
        }
        return this;
    }

    this.setGalleryImage = function (event_object) {
        if (_self.properties.images.length) {
            let next = _self.properties.images[0];
            let prev = _self.properties.images[_self.properties.images.length - 1];
            let header_count = '1 / ' + (_self.properties.images.length);
            for (let i in _self.properties.images) {
                if (_self.properties.images[i] == event_object) {
                    if (typeof _self.properties.images[+i + 1] !== 'undefined') {
                        next = _self.properties.images[+i + 1];
                    }
                    if (typeof _self.properties.images[+i - 1] !== 'undefined') {
                        prev = _self.properties.images[+i - 1];
                    }
                    header_count = (+i + 1) + ' / ' + (_self.properties.images.length);
                }
            }
            _self.properties.next_gallery_image = next;
            _self.properties.prev_gallery_image = prev;
            let prev_html = '<img class="hide" src="' + $(prev).attr('gallery-src') + '" />';
            let next_html = '<img class="hide" src="' + $(next).attr('gallery-src') + '" />';
            let cur_html = '<img class="img-responsive" src="' + $(event_object).attr('gallery-src') + '" />';
            let html = '<div class="media-gallery-editor"><div class="media-gallery-editor__media-box"><div class="media-gallery-editor__media-source-box container_"><div class="inner-image">' + cur_html + '<div data-click="next_media" class="fas fa-angle-right load_content_right"></div><div data-click="prev_media" class="fas fa-angle-left load_content_left"></div></div>' + prev_html + next_html + '</div><div class="media-gallery-editor__photo-menu">' + header_count + '</div></div></div>';
            _self.properties.gallery.changeTemplate('gallery');
            _self.properties.gallery.update_css_styles({width: '962px'});
            _self.properties.gallery.show_load_block(html, true);
        }
    }

    this.nextGalleryImage = function () {
        _self.setGalleryImage(_self.properties.next_gallery_image);
    }

    this.prevGalleryImage = function () {
        _self.setGalleryImage(_self.properties.prev_gallery_image);
    }

    _self.trimStr = function (s) {
        s = s.replace(/^\s+/g, '').replace(/&nbsp;/g, '');
        return s.replace(/\s+$/g, '');
    };

    _self.nl2br = function (str) {
        return str.replace(/([^>])\n/g, '$1<br/>');
    }

    _self.br2nl = function (str) {
        return str.replace(/<br\s*\/?>/mg,"\n");
    }

    _self.getMessageText = function (str) {
        str = str.replace(/<div>/mg, "\n");
        str = str.replace(/<\/div>/mg, '');
        return _self.br2nl(str);
    }

    _self.Init(optionArr);

}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.Chatbox = Chatbox;
}
