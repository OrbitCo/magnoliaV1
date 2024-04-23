function webcamera(optionArr) {

    var _self = this;

    this.properties = {
        // Process settings
        wc_width: 320,
        wc_height: 240,
        wc_canvas: 'canvas',
        wc_video: 'video',
        wc_take_picture: 'take_picture',
        wc_save_picture: 'save_picture',
        wc_allow: 'allow',
        wc_change_photo: 'btn_change_photo',
        wc_use_webcamera: 'btn_use_webcamera',
        wc_cancel_webcamera: 'btn_cancel_webcamera',
        wc_load_avatar: 'load_avatar',
        wc_stuff: 'stuff',
        wc_repicture: 'repicture',
        wc_photo_edit: 'photo-edit',
        wc_videoStreamUrl: false,
        wc_alert: 'empty videoStreamUrl',
        wc_user_avatar: '',
        avatar_content_id: 'avatar_owner_content',
        createNewWindow: false,
        errorObj: new Errors(),
        isUseWebcamera: false
    };

    var wc_context = null;
    var canvas = $('#' + _self.properties.wc_canvas)[0];

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.wc_context = canvas.getContext('2d');
        if (window.location.protocol === 'https:') {
            _self.properties.isUseWebcamera = true;
        }
        return _self;
    };

    $('#' + _self.properties.wc_change_photo).unbind('click').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        _self.createNewWindow();
        _self.showLoadAvatar();
    });

    $('#' + _self.properties.wc_cancel_webcamera).unbind('click').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        $('#' + _self.properties.wc_stuff + ', #' + _self.properties.wc_cancel_webcamera + ', #' + _self.properties.wc_repicture).hide(300);
        $('#' + _self.properties.wc_load_avatar + ', #' + _self.properties.wc_use_webcamera).show(300);

        if (window.wc_videoStreamUrl) {
            window.wc_videoStreamUrl.getVideoTracks()[0].stop();
            window.wc_videoStreamUrl = null;
        }
    });

    $('#' + _self.properties.wc_use_webcamera + ', #' + _self.properties.wc_repicture).unbind('click').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        $('#' + _self.properties.wc_stuff + ', #' + _self.properties.wc_cancel_webcamera).show(300);
        $('#' + _self.properties.wc_load_avatar + ', #'
                + _self.properties.wc_use_webcamera + ', #'
                + _self.properties.wc_photo_edit + ', #'
                + _self.properties.wc_repicture + ', #'
                + _self.properties.wc_save_picture).hide(300);
        $('#' + _self.properties.wc_take_picture + ', #'
                + _self.properties.wc_video).show().css({'display': 'inline-block'});
        $('#' + _self.properties.wc_canvas).attr('width', '0');
        $('#' + _self.properties.wc_canvas).attr('height', '0');
        $('#' + _self.properties.wc_video).attr('width', '320');
        $('#' + _self.properties.wc_video).attr('height', '240');

        $('#' + _self.properties.wc_take_picture).unbind('click').on('click', _self.captureMe);

        if (!window.wc_videoStreamUrl) {
            _self.getUserMedia();
        } else {
            video.src = window.wc_videoStreamUrl;
        }
    });

    this.captureMe = function () {
        if (!window.wc_videoStreamUrl) {
            _self.properties.errorObj.show_error_block(_self.properties.wc_alert, 'error');
            return false;
        }

        $('#' + _self.properties.wc_video).attr('width', _self.properties.wc_width);
        $('#' + _self.properties.wc_video).attr('height', _self.properties.wc_height);

        $('#' + _self.properties.wc_video + ', #' + _self.properties.wc_take_picture).hide().css({'display': 'none'});
        $('#' + _self.properties.wc_canvas).attr('width', _self.properties.wc_width);
        $('#' + _self.properties.wc_canvas).attr('height', _self.properties.wc_height);
        $('#' + _self.properties.wc_repicture).show().css({'display': 'inline-block'});

        // canvas translate mirror
        _self.wc_context.translate(canvas.width, 0);
        _self.wc_context.scale(-1, 1);

        _self.wc_context.drawImage(video, 0, 0, video.width, video.height);

        var base64dataUrl = canvas.toDataURL('image/png');
        _self.wc_context.setTransform(1, 0, 0, 1, 0, 0);
        var img = new Image();
        img.src = base64dataUrl;
        blob = window.dataURLtoBlob && window.dataURLtoBlob(base64dataUrl);

        $('#' + _self.properties.wc_save_picture).show().css({'display': 'inline-block'});

        $('#' + _self.properties.wc_canvas).html(img);

        if (canvas.toBlob) {
            canvas.toBlob(function (blob) {
                try {
                    var file = new File([blob], 'avatar.png', {type: 'image/png'});
                    avatar_web_uploader.addFile(file);
                } catch (e) {
                    alert(e);
                }
            });
        } else {
            console.log("toBlob NOT SUPPORT");
        }

        if (window.wc_videoStreamUrl) {
            window.wc_videoStreamUrl.getVideoTracks()[0].stop();
            window.wc_videoStreamUrl = null;
        }
    }

    // video stream
    this.getUserMedia =  function () {
        let cur_stream = null;
        let error = [];
        var device_is_access = false;
        var find_devices = [];

        if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) {
            console.log('You are using a browser that does not support the Media Capture API');
            _self.properties.errorObj.show_error_block(_self.properties.wc_alert, 'error');
            setTimeout(function() { $('#' + _self.properties.wc_cancel_webcamera).click()}, 1000);
        } else {
            window.state_nav = navigator.mediaDevices.enumerateDevices()
            .then(function(devices) {
                if (devices.length > 0) {
                    devices.forEach(function(device) {
                        if (device.kind == 'videoinput') {
                            device_is_access = true;
                        }
                    });
                    if (navigator.mediaDevices.getUserMedia !== undefined && device_is_access) {
                        window.state = navigator.mediaDevices.getUserMedia({ audio: false, video: true })
                        .then(function(stream) {
                            cur_stream = stream
                            if (stream.active) {
                                try {
                                    $('#' + _self.properties.wc_allow).hide().css({'display': 'none'});
                                    _self.properties.wc_user_avatar.properties.window_obj.properties.stream = window.wc_videoStreamUrl = stream;
                                    video.srcObject = stream;
                                    return false;
                                } catch(err) {

                                    if (stream) {
                                        stream.getVideoTracks()[0].stop();
                                    }

                                    error['error'] = err;
                                    console.log(error);
                                    return error;
                                }
                            } else {
                                error['error'] = 'no active steam';
                                console.log(error);
                                return error;
                            }
                        })
                        .catch(function(err) {
                            if (window.wc_videoStreamUrl) {
                                window.wc_videoStreamUrl.getVideoTracks()[0].stop();
                                window.wc_videoStreamUrl = null;
                            }

                            error['error'] = err;
                            console.log(error);
                            return error;
                        });

                    } else {
                        error['error'] = 'not supported webcam devices';
                        console.log(error);
                        return error;
                    }

                } else {
                    error['error'] = 'not supported devices';
                    console.log(error);
                    return error;
                }
            })
            .catch(function(err) {
                if (window.wc_videoStreamUrl) {
                    window.wc_videoStreamUrl.getVideoTracks()[0].stop();
                    window.wc_videoStreamUrl = null;
                }

                error['error'] = err;
                console.log(error);
                return error;
            });
            state_nav.then(function(value){
                if (typeof value == 'object' && value['error'].length > 0) {
                    _self.properties.errorObj.show_error_block(_self.properties.wc_alert, 'error');
                    setTimeout(function() { $('#' + _self.properties.wc_cancel_webcamera).click()}, 1000);
                }
            });
        }
        if (error.length) {
            _self.properties.errorObj.show_error_block(_self.properties.wc_alert, 'error');
            setTimeout(function() {$('#' + _self.properties.wc_cancel_webcamera).click()}, 1000);
        }
    }

    this.showLoadAvatar = function() {
        if(_self.properties.createNewWindow) {
            _self.createNewWindow();
        }
        $('#' + _self.properties.wc_load_avatar + ', #' + _self.properties.wc_use_webcamera + ', #' + _self.properties.wc_photo_edit + ', #' + _self.properties.wc_change_photo).hide(300);
        $('#' + _self.properties.wc_load_avatar).show(300);
        if (_self.properties.isUseWebcamera === true) {
            $('#' + _self.properties.wc_use_webcamera).show(300);
        }
    }

    this.isMobile = function() {
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
            || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
            return true;
        }
        return false;
    }

    this.createNewWindow = function() {
        var content = $('#' + _self.properties.avatar_content_id).html();
        _self.properties.wc_user_avatar.destroy_window();
        _self.properties.wc_user_avatar.init_window_obj();
        _self.properties.wc_user_avatar.properties.window_obj.show_load_block(content);

        _self.properties.wc_user_avatar.properties.window_obj.properties.onClose = function() {
            if (_self.properties.wc_user_avatar.properties.window_obj.properties.stream) {
                let stream = _self.properties.wc_user_avatar.properties.window_obj.properties.stream;
                stream.getVideoTracks()[0].stop();
                stream = null;
            }
        }
    }

    _self.Init(optionArr);
}
if (typeof exports === 'object') {
  exports.__esModule = true;
  exports.webcamera = webcamera;
}
