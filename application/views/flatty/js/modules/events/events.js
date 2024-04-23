"use strict";
function Events(optionArr)
{

    this.properties = {
        siteUrl: '',
        profile_id: null,
        is_admin: null,
        profile: {},
        lang: {},
        limits: 10,
        compared: 0,
        btn_id: 'btn-event',
        event_content_id: 'event_content',
        name_id: 'event_name',
        image_id: 'event_image',
        btn_compare_id: 'btn_compare',
        btn_more_id: 'btn_more',
        btn_conversation_class: 'chatbox_connect',
        btn_invite_users: 'invite_users_block',
        last_event_id: 'last_event',
        next_event_id: 'next_event',
        event_action_id: 'event_action_',
        event_id: 'event_',
        actions_block: 'event-actions',
        event_action_class: 'event-action',
        btn_delete_user: 'delete-user',
        load_events_url: 'events/ajaxLoadEvents',
        view_events_url: 'events/ajaxViewEvents',
        set_compare_url: 'events/ajaxSetCompare',
        set_answer_url: 'events/ajaxSetAnswer',
        change_status_url: 'events/ajaxChangeStatus',
        set_chatbox_url: 'chatbox/chat/',
        set_invite_users_url: 'events/ajaxLoadUsers',
        approve_users_block_url: 'events/ajaxGetApprovedList',
        approve_users_block: 'participants_block',
        common_ancestor: 'body',
        lang_delete_confirm: '',
        contentObj: new loadingContent({
            loadBlockWidth: '400px',
            loadBlockLeftType: 'center',
            loadBlockTopType: 'top',
            loadBlockTopPoint: 100,
            closeBtnClass: 'w',
            draggable: true
        }),
    mailboxObj: new loadingContent({
        loadBlockWidth: '800px',
        closeBtnClass: 'w', loadBlockTopType: 'top',
        loadBlockTopPoint: 20,
        blockBody: true,
        showAfterImagesLoad: false
        })
    };

    this.data = {
        event_id: '',
    }

    var _self = this;
    var _temp_obj = {};

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.init_controls();
    };

    this.init_controls = function () {
        $('#' + _self.properties.btn_id).off('click').on('click', function () {
            _self.loadEvents();
        });

        $('#' + _self.properties.btn_more_id).off('click').on('click', function () {
            _self.getEvent();
        });

        $('#' + _self.properties.btn_compare_id).off('click').on('click', function () {
            _self.setCompare($(this).data('id'));
        });

        $('#' + _self.properties.last_event_id).off('click').on('click', function () {
            _self.getLastEvent();
        });

        $('#' + _self.properties.next_event_id).off('click').on('click', function () {
            _self.getNextEvent();
        });

        $('.' + _self.properties.event_action_class + '>a').off('click').on('click', function () {
            _self.answeEvent($(this).data('id'), $(this).data('answer'));
        });

        $('.' + _self.properties.btn_conversation_class).off('click').on('click', function () {
            //_self.loadChatbox();
            if (!_self.properties.is_admin) {
                var url = _self.properties.siteUrl + _self.properties.set_chatbox_url + _self.properties.profile_id;
                window.open(url);
            } else {
                var url = _self.properties.siteUrl + 'tickets';
                window.open(url);
            }
        });

        $('.' + _self.properties.actions_block).off().on('click', '[data-click="change-status"]', function () {
            _self.changeStatus($(this).attr('data-status'));
        });

        $('#' + _self.properties.btn_invite_users).off().on("click", function () {
            _self.loadUsers();
        });

        _self.initDeleteUserButton();
    };

    this.initDeleteUserButton = function () {
        $('.' + _self.properties.btn_delete_user).off().on("click", function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            var alert_text = _self.properties.lang_delete_confirm;
            alerts.show({
                text: alert_text,
                type: 'confirm',
                ok_callback: function () {
                        _self.deleteUser(href);
                        //_self.updateUsersBlock();
                }
            });
            return false;
        });
    }

    this.loadEvents = function () {
        if (_self.properties.compared) {
            error_object.show_error_block(_self.properties.lang.already_sent, 'error');
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: _self.properties.siteUrl + _self.properties.load_events_url,
                success: function (data) {
                    _self.getEvent(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (typeof (console) !== 'undefined') {
                        console.error(errorThrown);
                    }
                },
            });
        }
    };

    this.getEvent = function (content) {
        if (typeof (_temp_obj.count_events) === 'undefined') {
            var post_data = {profile_id: _self.properties.profile_id, limits: _self.properties.limits};
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: _self.properties.siteUrl + _self.properties.view_events_url,
                data: post_data,
                success: function (data) {
                    if (data.length != 0) {
                        if (typeof (content) !== 'undefined') {
                            _self.properties.contentObj.show_load_block(content);
                        }
                        _temp_obj.count_events = data.length;
                        _temp_obj.event_obj = [];
                        for (var key in data) {
                            _temp_obj.event_obj.push(data[key]);
                        }
                        _temp_obj.event_last_key = _temp_obj.count_events - 1;
                        _self.viewEvent(0);
                    } else {
                        _self.properties.contentObj.hide_load_block();
                        $('#' + _self.properties.btn_id).find('i').addClass('g');
                        error_object.show_error_block(_self.properties.lang.events_empty, 'error');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (typeof (console) !== 'undefined') {
                        console.error(errorThrown);
                    }
                },
            });
        } else if (_temp_obj.event_key >= _temp_obj.count_events) {
            _temp_obj.event_last_key = _temp_obj.count_events - 1;
            _self.appendEvents();
        } else {
            _self.viewEvent(_temp_obj.event_key);
        }
    };

    this.getLastEvent = function () {
        if (_temp_obj.event_key <= 1) {
            _self.viewEvent(_temp_obj.event_last_key);
        } else {
            var last_key = parseInt(_temp_obj.event_key) - 2;
            _self.viewEvent(last_key);
        }
    };

    this.getNextEvent = function () {
        _self.getEvent();
    };

    this.viewEvent = function (key) {
        _temp_obj.event_key = parseInt(key) + 1;
        var check_image = _self.checkImage(key);
        if (check_image == true) {
            var html_data = '';
            $('#' + _self.properties.event_content_id).html(function (index, old_html) {
                html_data += '<div class="mtb10 ib">';
                html_data += '<div id="' + _self.properties.last_event_id + '" class="icon-chevron-left hover fleft pointer"></div>';
                html_data += '<div id="' + _self.properties.image_id + '" class="mlr20 fleft"><img src="' + _temp_obj.event_obj[key].image.thumbs.big + '"></div>';
                html_data += '<div id="' + _self.properties.next_event_id + '" class="icon-chevron-right hover fleft pointer"></div>';
                html_data += '</div>';
                html_data += '<div class="clr"></div>';
                html_data += '<div class="mtb10" id="' + _self.properties.name_id + '">' + _temp_obj.event_obj[key].name + '</div>';
                html_data += '<div class="mtb10"><input data-id="' + _temp_obj.event_obj[key].id + '" type="button" id="' + _self.properties.btn_compare_id + '" value="' + _self.properties.lang.compare + '" name="compare" >&nbsp;<input type="button" id="' + _self.properties.btn_more_id + '" value="' + _self.properties.lang.more + '" name="more" ></div>';
                return html_data;
            });
            $('#' + _self.properties.last_event_id).css('margin-top', '35%');
            $('#' + _self.properties.next_event_id).css('margin-top', '35%');
        } else {
            _self.getNextEvent();
        }
    };

    this.appendEvents = function () {
        var post_data = {profile_id: _self.properties.profile_id, limits: _self.properties.limits, last_id: _temp_obj.event_obj[_temp_obj.event_last_key].id};
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: _self.properties.siteUrl + _self.properties.view_events_url,
            data: post_data,
            success: function (data) {
                if (data.length) {
                    _temp_obj.count_events = _temp_obj.count_events + data.length;
                    for (var key in data) {
                        _temp_obj.event_obj.push(data[key]);
                    }
                    _self.viewEvent(_temp_obj.event_last_key + 1);
                } else {
                    _self.viewEvent(0);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
        });
    };

    this.checkImage = function (key) {
        var req = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
        if (!req) {
            throw new Error('XMLHttpRequest not supported');
        }
        req.open('HEAD', _temp_obj.event_obj[key].image.thumbs.big, false);
        req.send(null);
        if (req.status == 200) {
            return true;
        } else {
            _temp_obj.event_obj.splice(key, 1);
            _temp_obj.count_events = (_temp_obj.count_events > 0) ? (_temp_obj.count_events - 1) : 0;
            return false;
        }
        return false;
    };

    this.setCompare = function (event_id) {
        var post_data = {event_id: event_id, profile_id: _self.properties.profile_id};
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: _self.properties.siteUrl + _self.properties.set_compare_url,
            data: post_data,
            success: function (data) {
                if (!data.error) {
                    $('#' + _self.properties.btn_id).find('i').addClass('g');
                    _self.properties.compared = 1;
                }
                _self.properties.contentObj.hide_load_block();
                error_object.show_error_block(data, 'error');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
        });
    };

    this.answeEvent = function (event_id, answer_gid) {
        var post_data = {event_id: event_id, answer: answer_gid};
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: _self.properties.siteUrl + _self.properties.set_answer_url,
            data: post_data,
            success: function (data) {
                if (data.success) {
                    var answer = _self.createAnswer(answer_gid);
                    $('#' + _self.properties.event_action_id + event_id).html('');
                    $('#' + _self.properties.event_id + event_id).append(answer);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
        });
    };

    this.createAnswer = function (answer_gid) {
        var html_data = '';
        html_data += '<div class="fright answer"><div class="content fleft"><i class="icon-caret-right icon-4x fltr"></i><div class="event-block">' + _self.properties.lang.answer[answer_gid] + '</div></div><div class="image small fright"><img src="' + _self.properties.profile.media.user_logo.thumbs.small + '" alt="' + _self.properties.profile.nickname + '" title="' + _self.properties.profile.nickname + '" /><div>' + _self.properties.profile.nickname + ', ' + _self.properties.profile.age + '</div></div></div>';
        return html_data;
    };

    this.escapeRegExp = function (str) {
        return str.replace(/[]/g, "\\$&");
    };

    this.addJSParams = function (data) {
        var str = 'siteUrl: site_url,';
        var reg = new RegExp(_self.escapeRegExp(str).replace(/[]/g, '|'), 'gi');
        return data.replace(reg, '$&' + ' singleton: 0,');
    };


    this.changeStatus = function (status) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: _self.properties.siteUrl + _self.properties.change_status_url + '/' + _self.data.event_id + '/' + status,
            success: function (data) {
                if (data.success) {
                    error_object.show_error_block(data.success, 'success');
                }

                locationHref(_self.properties.siteUrl + 'events/view/' + _self.data.event_id);
            }
        });
    }

    // this.loadChatbox = function() {
    //     $.ajax({
    //         type: 'POST',
    //         dataType: 'json',
    //         url: _self.properties.siteUrl + _self.properties.set_chatbox_url + '/' + _self.data.event_id,
    //         success: function (data) {
    //             if(data.content) {
    //                 _self.properties.mailboxObj.show_load_block(data.content);
    //             } else if(data.msg) {
    //                 error_object.show_error_block(data.msg, 'info');
    //             }

    //         }
    //     });
    // }

    this.loadUsers = function () {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: _self.properties.siteUrl + _self.properties.set_invite_users_url + '/' + _self.data.event_id,
            success: function (data) {
                if (data.content) {
                    _self.properties.contentObj.show_load_block(data.content);
                }
            }
        });
    }

    this.deleteUser = function (url) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: url,
            success: function (data) {
                if (data.success) {
                    _self.updateUsersBlock();
                    error_object.show_error_block(data.success, 'success');
                }
            }
        });
    }

    this.updateUsersBlock = function () {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: _self.properties.siteUrl + _self.properties.approve_users_block_url + '/' + this.data.event_id,
            success: function (data) {
                if (data.content) {
                    $('#' + _self.properties.approve_users_block).html(data.content);

                    _self.initDeleteUserButton();
                }
            }
        });
    }

    _self.Init(optionArr);

}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.Events = Events;
}