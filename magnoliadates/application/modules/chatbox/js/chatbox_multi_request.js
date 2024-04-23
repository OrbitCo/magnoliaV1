'use strict';
if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'chatbox',
        params: {module: 'chatbox', model: 'ChatboxContactListModel', method: 'backendCheckNewMessages'},
        paramsFunc: function () {
            if (location.href.indexOf("chatbox") === -1) {
                window.chatbox = undefined;
            }

            if (typeof window.chatbox != 'undefined' && typeof window.chatbox.properties != 'undefined') {
                return {l_time: window.chatbox.properties.l_time, contact_id: window.chatbox.properties.contactId};
            }
            return {};
        },
        callback: function (resp) {
            if (resp) {
                if (typeof window.chatbox != 'undefined' && typeof window.chatbox.properties != 'undefined') {
                    if (resp.l_time) {
                        window.chatbox.properties.l_time = resp.l_time;
                    }

                    if (typeof (resp.contacts) != 'undefined') {
                        if (resp.contacts.length) {
                            $('.chatbox-users__list .empty').hide();
                        }
                        for (var i in resp.contacts) {
                            if (resp.contacts[i].html != '') {
                                if ($('li#chb_user_' + resp.contacts[i].id).length) {
                                    $('li#chb_user_' + resp.contacts[i].id).remove();
                                }
                                $('.chatbox-users__list ul').prepend(resp.contacts[i].html);
                            }
                        }

                        if (window.chatbox.properties.contactId) {
                            $('#chb_user_' + window.chatbox.properties.contactId).addClass('active');
                            setTimeout(function () {
                                $('#chb_user_' + window.chatbox.properties.contactId).find('.chatbox-users__new_msg').fadeOut('slow', function () {
                                    $(this).html('');
                                });
                            }, 2000);
                        }
                        window.chatbox.initUsersActions();
                    }

                    if (window.chatbox.properties.contactId != 0 && window.chatbox.properties.contactId == resp.contact_id) {
                        if (typeof (resp.messages) != 'undefined') {
                            window.chatbox.renderMessages(resp.messages);
                        }
                    }

                    if (resp.count_new) {
                        $('.chatbox-mobile-msg-counter').html('<span>' + resp.count_new + '</span>');
                    } else {
                        $('.chatbox-mobile-msg-counter').html('');
                    }
                }

                if (typeof favicon == 'undefined' && typeof Favico != 'undefined' ) {
                    let favicon = new Favico({
                        animation:'slide'
                    });
                }

                var messboxBlock = $('#activities_chatbox_item, #activities_chatbox_item_xs, [data-id="activities_chatbox_item_xs"]');

                let title_changer,
                    original_title,
                    first_position,
                    last_count;


                if (typeof first_position != 'undefined') {
                    if (first_position > resp.count_new) {
                        if (typeof title_changer != 'undefined' && title_changer != null) {
                            document.title = original_title;
                            clearInterval(title_changer);
                            title_changer = null;
                        }
                    }
                }

                if (typeof original_title == 'undefined' || original_title == null) {
                    if ($('head title').length == 0) {
                        $('head').append('<title> </title>')
                        original_title = ' ';
                    } else {
                        original_title = $('head title').text();
                    }
                } else {
                    if ($('head title').length > 0) {
                        if ($('head title').text() != resp.lang_new_message) {
                            original_title = $('head title').text();
                        }
                    } else {
                        original_title = ' ';
                    }
                }

                if (typeof title_changer == 'undefined' || title_changer == null) {
                    document.title = original_title;
                }

                if (resp.count_new) {
                    if (typeof first_position == 'undefined') {
                        first_position = resp.count_new;
                    }

                    if (typeof last_count !== 'undefined') {
                        if (last_count < resp.count_new) {
                            last_count = resp.count_new

                            var location_url = location.href;

                            if (typeof title_changer == 'undefined' || title_changer == null) {
                                title_changer = setInterval(() => {
                                    let cur_location = location.href;
                                    if (location_url != cur_location) {
                                        document.title = original_title;
                                        clearInterval(title_changer);
                                        title_changer = null;
                                    }

                                    if ($('head title').text() == original_title) {
                                        $('head title').text(resp.lang_new_message);
                                    } else {
                                        $('head title').text(original_title);
                                    }

                                }, 1000)
                            }
                        } else {
                            last_count = resp.count_new;
                        }
                    } else {
                        last_count = first_position;
                    }

                    if (!messboxBlock.find('.badge').length) {
                        messboxBlock.append('<span class="badge">' + resp.count_new + '</span>');
                    } else {
                        if (typeof favicon != 'undefined') {
                            favicon.badge(resp.count_new);
                        }
                        messboxBlock.find('.badge').html(resp.count_new);
                    }
                } else {
                    first_position = 0;
                    last_count = 0;
                    messboxBlock.find('.badge').html('');

                    if (typeof favicon != 'undefined') {
                        favicon.badge(0);
                    }
                }

                if (resp.new_message_alert_html) {
                    let top_message_menu = $('.navbar-right.hidden-xs #menu_mailbox_alerts .menu-alerts-more-items:first');
                    if (top_message_menu.length > 0) {
                        top_message_menu.html(resp.new_message_alert_html);

                        if (resp.count_new > resp.max_messages_count) {
                            top_message_menu.find('.menu-alerts-view-all').removeClass('hide');
                        } else {
                            top_message_menu.find('.menu-alerts-view-all').addClass('hide');
                        }
                    }
                }

                if ($('.menu-alerts-more-items .message-body').length > 0) {
                    if (typeof chatbox != 'undefined') {
                        if (typeof chatbox.properties != 'undefined') {
                            if (typeof chatbox.properties.emojiPicker != 'undefined') {
                                $('.menu-alerts-more-items .message-body').each(function () {
                                    let message = $(this).find('.text');
                                    if (!message.hasClass('rendered-emoji')) {
                                        message.html(chatbox.properties.emojiPicker.colonToImage(chatbox.properties.emojiPicker.codeToColon(message.html())));
                                        message.addClass('rendered-emoji');
                                    }
                                });
                            }
                        }
                    }
                }

                $('.inbox_new_message').html(resp.count_new);
                $('.ind_inbox_new_message').html('(' + resp.count_new + ')');

                if ($('#chatbox_mini_btn').length > 0) {
                    let chat_btn_obj = $('#chatbox_mini_btn');
                    let flash_obj = chat_btn_obj.find('[data-flash]');
                    window.count_mess = resp.count_new;

                    if (typeof window.flash_to == 'undefined') {
                        window.flash_to = setInterval(function () {
                            if ( window.count_mess > 0) {
                                chat_btn_obj.find('[data-flash]').attr('data-flash', '1');
                                flash_obj = chat_btn_obj.find('[data-flash="1"]');
                                if (flash_obj.hasClass('fa-comment')) {
                                    flash_obj.removeClass('fa-comment');
                                } else {
                                    flash_obj.addClass('fa-comment');
                                    flash_obj.removeClass('fa-comments');
                                }
                            }
                        }, 500);
                    } else {
                        if (resp.count_new == 0) {
                            clearTimeout(window.flash_to);
                            delete window.flash_to;
                            flash_obj.removeClass('fa-comment');
                            flash_obj.addClass('fa-comments');
                        }
                    }
                }

                if (resp.count_new) {
                    $('.ind_inbox_new_message').show();
                } else {
                    $('.ind_inbox_new_message').hide();
                }
            }
        },
        period: 3,
        status: 1
    });

    function unlockAudio()
    {
        const sound = new Audio(site_url + "uploads/audio/Sound_11340.wav");
        //sound.play();
        sound.pause();
        sound.currentTime = 0;

        if (document.body) {
            document.body.removeEventListener('click', unlockAudio);
            document.body.removeEventListener('touchstart', unlockAudio);
        }
    }

    function soundNotification()
    {
        const sound = new Audio(site_url + "uploads/audio/Sound_11340.wav");
        const promise = sound.play();

        if (promise !== undefined) {
            promise.then(() => {}).catch(error => console.error);
        }

        if (document.body) {
            document.body.addEventListener('click', unlockAudio);
            document.body.addEventListener('touchstart', unlockAudio);
        }
    }

}
