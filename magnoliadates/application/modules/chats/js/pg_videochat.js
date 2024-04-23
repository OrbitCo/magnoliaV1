function PG_videochat(params)
{

    this.properties = {
        site_url:               '',
        settings:               [],
        id_chat:                0,
        id_inviter_user:        0,
        id_invited_user:        0,
        inviter_peer_id:        '',
        invited_peer_id:        '',
        video_id_you:           'its_me',
        video_id_him:           'its_him',
        video_you:              null,
        video_him:              null,
        pauseVideo:             'pauseVideo',
        pauseAudio:             'pauseAudio',
        pauseChat:              'pauseChat',
        resumeChat:             'resumeChat',
        completeChat:           'completeChat',
        messagesChat:           'messagesChat',
        is_inviter:             false,
        is_pauseVideo:          false,
        is_pauseAudio:          false,
        is_pauseChat:           false,
        is_pauseHisChat:        false,
        timeout_set_status:     null,
        timeout_change_status:  null,
        xhr_check_status:       null,

        waiting_lang:           'Waiting for other people...',
        pause_lang:             'Pause',
        complete_lang:          'Complete',
        close_alert_text:       'You are going to finish chat session. Are you sure?',
        error_support:          'Browser is not supported',
        connect_now:            'Connect now',

        msg_input_obj:          'videochatMessage',
        inviter_photo:          '',
        invited_photo:          '',
        my_user_id:             0,
        message_max_id:         0,
        is_sending:             false,
        getMassages:            false,

        change_status:          'chats/ajax_change_status/',
        get_messages:           'chats/ajax_get_messages/',
        send_messages:          'chats/ajax_send_message/',
        send_command:           'chats/send_command/',

        start_chat_id:          'start-chat-link',
        close_chat_id:          'close-chat',
        chat_block:             'start-chat-block',
        try_connect:            false,
        chat_exists:            null,
        errorObj: new Errors(),
    };

    var _self = this;

    this.init = function (options) {
        options = options || {};

        $.extend(true, _self.properties, options);
        if (!_self.properties.id_inviter_user || !_self.properties.id_invited_user) {
            return this;
        }

        _self.commands = [];
        _self.peer = null;
        _self.isCommand = false;

        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
            if (!navigator.getUserMedia) {
                $('#my_info_block').html('<div style="padding:10px; font-size:20px">' + _self.properties.error_support + '</div>');
                $('#my_info_block').show();
                return;
            }
        }

        _self.properties.video_you = $('#' + _self.properties.video_id_you);
        _self.properties.video_him = $('#' + _self.properties.video_id_him);

        _self.properties.close = false;

        if (_self.properties.is_inviter) {
            _self.properties.my_user_id = _self.properties.id_inviter_user;
        } else {
            _self.properties.my_user_id = _self.properties.id_invited_user;
        }

        _self.initControls();

        _self.initMyCam();

        return this;
    };

    this.initMyCam = function () {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({audio: true,video: true}).then(function (stream) {
                window.localStream = stream;

                $('#' + _self.properties.video_id_you).prop('srcObject', stream);

                $('#my_info_block').hide();

                $('#' + _self.properties.pauseVideo).show();
                $('#' + _self.properties.pauseAudio).show();

                _self.initPeer();
            }).catch(function (e) {
              error_object.show_error_block('something went wrong', 'error');
              console.log(e.name +'---'+ e.message); });
              }else {
            navigator.getUserMedia({audio: true,video: true}, function (stream) {
                window.localStream = stream;

                $('#' + _self.properties.video_id_you).prop('srcObject', stream);

                $('#my_info_block').hide();

                $('#' + _self.properties.pauseVideo).show();
                $('#' + _self.properties.pauseAudio).show();

                _self.initPeer();
            }, function (e) {
              error_object.show_error_block('something went wrong', 'error');
              console.log(e.name +'---'+ e.message);
            });
        }
    };

    this.initPeer = function () {
        _self.properties.inviter_peer_id = '';
        _self.properties.invited_peer_id = '';

        _self.peer = new Peer({
            host: 'video.pilotgroup.net',
            port: 9001,
            secure: true,
            debug: 0,
            logFunction: false,
            config: {'iceServers': [
                { urls: 'stun:video.pilotgroup.net:3478' },
                { urls: 'turn:video.pilotgroup.net:3478', username: 'test', credential: '12345' }
                ]}
        });

        _self.peer.off('open').on('open', function () {
            if (_self.properties.is_inviter) {
                _self.properties.inviter_peer_id = _self.peer.id;
            } else {
                _self.properties.invited_peer_id = _self.peer.id;
            }

            _self.checkStatus();
        });

        _self.peer.off('call').on('call', function (call) {
            call.answer(window.localStream);
            _self.initHisCam(call);
        });

        _self.peer.off('error').on('error', function (err) {
            console.log('err: ', err)

            _self.renderUser('approve');

            _self.reconnectChat();
        });

        _self.peer.off('connection').on('connection', function (conn) {
            conn.off('data').on('data', function (data) {
                _self.appendMessage('peer', data);
                conn.close();
            });
        });

        _self.initConnect();
    };

    this.initConnect = function () {
        if (_self.properties.is_inviter) {
            $(_self).off().on('send', function (o, msg) {
                var conn = _self.peer.connect(_self.properties.invited_peer_id);
                conn.on('open', function () {
                    conn.send(msg);
                    _self.appendMessage('send', msg);
                });
            });
        } else {
            $(_self).off().on('send', function (o, msg) {
                var conn = _self.peer.connect(_self.properties.inviter_peer_id);
                conn.on('open', function () {
                    conn.send(msg);
                    _self.appendMessage('send', msg);
                });
            });
        }

        return this;
    };

    this.initHisCam = function (call) {
        if (window.existingCall) {
            window.existingCall.close();
        }

        call.on('stream', function (stream) {
            $('#' + _self.properties.video_id_him).prop('srcObject', stream);
        });

        // UI stuff
        window.existingCall = call;
    }

    this.startChat = function () {
        _self.sendCommand('start', function (chat) {
            _self.initHisCam(_self.peer.call(chat.invited_peer_id, window.localStream));
        });
    }

    this.pauseChat = function () {
        _self.sendCommand('pause', function () {

        });
    }

    this.resumeChat = function () {
        _self.sendCommand('resume', function () {

        });
    }

    this.stopChat = function () {
        _self.sendCommand('stop', function () {
            _self.closeChat();
        });
    }

    this.reconnectChat = function () {
        _self.sendCommand('reconnect', function () {

        });
    }

    this.muteVideo = function () {
        window.localStream.getVideoTracks().forEach(function (track) {
            track.enabled = _self.properties.is_pauseVideo;
        });

        $('#' + _self.properties.pauseVideo).toggleClass('fa-video-camera fa-eye-slash fa-video');

        _self.properties.is_pauseVideo = !_self.properties.is_pauseVideo;
    };

    this.muteAudio = function () {
        window.localStream.getAudioTracks().forEach(function (track) {
            track.enabled = _self.properties.is_pauseAudio;
        });

        $('#' + _self.properties.pauseAudio).toggleClass('fa-microphone fa-microphone-slash');

        _self.properties.is_pauseAudio = !_self.properties.is_pauseAudio;
    }

    this.closeChat = function () {
        if (window.existingCall) {
            window.existingCall.close();
        }

        _self.renderUser('completed');
    }

    this.checkStatus = function () {
        var data = {};

        if (_self.properties.is_inviter) {
            data.inviter_peer_id = _self.properties.inviter_peer_id;
        } else {
            data.invited_peer_id = _self.properties.invited_peer_id;
        }

        $.ajax({
            type: 'POST',
            url: _self.properties.site_url + _self.properties.change_status + _self.properties.id_chat,
            data: data,
            success: function (resp, textStatus, jqXHR) {
                if (resp.errors) {
                  _self.properties.errorObj.show_error_block(resp.errors, 'error');
                }

                _self.renderUser(resp.chat.status);

                if (resp.chat.status == 'approve') {
                    if (_self.properties.is_inviter && !resp.chat.inviter_peer_id || !_self.properties.is_inviter && !resp.chat.invited_peer_id) {
                        _self.initPeer();
                        return;
                    }

                    _self.properties.inviter_peer_id = resp.chat.inviter_peer_id;
                    _self.properties.invited_peer_id = resp.chat.invited_peer_id;

                    if (_self.properties.is_inviter && resp.chat.inviter_peer_id && resp.chat.invited_peer_id) {
                        _self.startChat();
                    }
                } else if (resp.chat.status == 'current') {
                    // reassign peer ids
                    _self.properties.inviter_peer_id = resp.chat.inviter_peer_id;
                    _self.properties.invited_peer_id = resp.chat.invited_peer_id;

                    _self.properties.video_him.muted = false;
                } else if (resp.chat.status == 'paused') {
                    _self.properties.video_him.muted = true;
                } else if (resp.chat.status == 'completed') {
                    _self.closeChat();
                    return;
                } else {
                }

                setTimeout(function () {
                    _self.checkStatus();
                }, 2000);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
            dataType: 'json'
        });
        return false;
    }

    this.sendCommand = function (command, callback) {
        _self.commands.push({command: command, callback: callback});
        _self.execCommand();
    }

    this.execCommand = function () {
        if (_self.commands.length == 0 || _self.isCommand) {
            return;
        }

        var command = _self.commands.shift();

        _self.isCommand = true;

        $.ajax({
            type: 'POST',
            url: site_url + _self.properties.send_command + _self.properties.id_chat,
            data: {
                command: command.command,
            },
            dataType: 'json',
            success: function (resp) {
                if (typeof command.callback === 'function') {
                    command.callback(resp.chat);
                }
                _self.isCommand = false;
                _self.execCommand();
            },
            complete: function () {

            }
        });
    }

    this.initControls = function () {
        $("#" + _self.properties.start_chat_id).on('click', function (e) {
            e.preventDefault();
            $("#col-chat").animate({ width: "80%" }, 300);
            $("#" + _self.properties.chat_block).show();
            $('.message-scroller').scrollTop($('#messagesChat')[0].scrollHeight);
        });

        $("#" + _self.properties.close_chat_id).on('click', function () {
            $("#col-chat").animate({width: "100%" }, 300);
            $("#" + _self.properties.chat_block).hide();
        });

        $('#' + _self.properties.pauseVideo).off('click').on('click', function (e) {
            e.preventDefault();
            _self.muteVideo();
        });

        $('#' + _self.properties.pauseAudio).off('click').on('click', function (e) {
            e.preventDefault();
            _self.muteAudio();
        });

        $('#' + _self.properties.pauseChat).off('click').on('click', function (e) {
            e.preventDefault();
            _self.pauseChat();
        });

        $('#' + _self.properties.resumeChat).off('click').on('click', function (e) {
            e.preventDefault();
            _self.resumeChat();
        });

        $('#' + _self.properties.completeChat).off('click').on('click', function () {
            alerts.show({
                text: _self.properties.close_alert_text,
                type: 'confirm',
                ok_callback: function () {
                    _self.properties.close = true;
                    _self.stopChat();
                }
            });
        });

        $('#' + _self.properties.msg_input_obj).off('keydown').on('keydown', function (e) {
            if (e.keyCode !== 13) {
                return;
            }

            var msg = $('#' + _self.properties.msg_input_obj).val();
            if (msg.length == 0) {
                return;
            }

            $(_self).trigger('send', msg);

            $('#' + _self.properties.msg_input_obj).val('');
        });

      $('.btn-send-msg').off('click').on('click', function (e) {

        var msg = $('#' + _self.properties.msg_input_obj).val();
        if (msg.length == 0) {
          return;
        }

        $(_self).trigger('send', msg);

        $('#' + _self.properties.msg_input_obj).val('');
      });
    }

    this.renderUser = function (status) {
        switch (status) {
            case "approve":
                $('#its_him').hide();
                $('#chat_user_block').show();
                $('#his_info_block_text').html(_self.properties.waiting_lang);
                $('#his_info_block').show();
                $('#pauseChat').hide();
                $('#resumeChat').hide();
                $("#" + _self.properties.start_chat_id).hide();
                $("#" + _self.properties.close_chat_id).trigger('click');
                break;

            case "current":
                $('#chat_user_block').hide();
                $('#his_info_block').hide();
                $('#pauseChat').show();
                $('#resumeChat').hide();
                $('#its_him').show();
                $("#" + _self.properties.start_chat_id).show();
                break;

            case "paused":
                $('#its_him').hide();
                $('#his_info_block_text').html(_self.properties.pause_lang);
                $('#his_info_block').show();
                $('#chat_user_block').show();
                $('#pauseChat').hide();
                $('#resumeChat').show();
                $("#" + _self.properties.start_chat_id).hide();
                $("#" + _self.properties.close_chat_id).trigger('click');
                break;

            case "completed":
                $('#its_him').hide();
                $('#his_info_block_text').html(_self.properties.complete_lang);
                $('#his_info_block').show();
                $('#chat_user_block').show();
                $('#pauseChat').hide();
                $('#resumeChat').hide();
                $("#" + _self.properties.start_chat_id).hide();
                $("#" + _self.properties.close_chat_id).trigger('click');
                break;
        }
    }

    this.appendMessage = function (s, msg) {
        var isPeer = (s == 'peer');

        var style = isPeer ? 'left' : 'right';

        if (isPeer) {
            $("#" + _self.properties.start_chat_id).trigger('click');
        }

        if (isPeer && !_self.properties.is_inviter || !isPeer && _self.properties.is_inviter) {
            var photo = _self.properties.inviter_photo;
        } else {
            var photo = _self.properties.invited_photo;
        }

        var html =
            '<div class="vc-message vc-message--' + style + '">' +
            '<img src="' + photo + '" class="f' + style + '"/>' +
            '<div class="message">' + msg + '</div></div>';

        $('#' + _self.properties.messagesChat).append(html);

        var height = $('#messagesChat')[0].scrollHeight;
        $('.message-scroller').scrollTop(height);
    };

    _self.init(params);

    return this;
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.PG_videochat = PG_videochat;
}
