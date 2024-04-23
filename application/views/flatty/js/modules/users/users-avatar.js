function UsersAvatar(optionArr)
{
    this.properties = {
        site_url: '',
        load_avatar_url: 'users/ajax_load_avatar/',
        photo_id: 'user_photo',
        id_user: 0,
        recrop_url: 'users/ajax_recrop_avatar/',
        recrop_container_id: 'photo_source_recrop_box',
        recrop_img_id: 'photo_source_recrop',
        photo_sizes_id: 'photo_sizes',
        image_content_id: 'image_content_avatar',
        menu_container_id: 'media_menu',
        recropMenuContainer: '#recrop_menu',
        rotateMenuId: '#rotate-menu',
        photoMirrorHorId: '#photo_mirror_hor',
        rotate_left_id: 'photo_rotate_left',
        rotate_right_id: 'photo_rotate_right',
        photo_crop_id: 'photo_crop',
        rotateUrl: 'users/photoRotate/',
        image_css_size: {width: 700, height: 500},
        selections: [],
        section: '',
        userType: 'user',
        saveAfterSelect: false,
        changePhotoClass: '.change-photo-button',
        viewPhotoClass: '.view-photo-button',
        photoAction: '.photo-action-js',
        haveAvatar: false,
        mobileWidth: 767,
        errorObj: new Errors,
        window_obj: new loadingContent({
            loadBlockWidth: '800px',
            closeBtnClass: 'w',
            loadBlockTopType: 'top',
            loadBlockTopPoint: 20,
            blockBody: true,
            showAfterImagesLoad: false
        }),
        callback: function () {}

    };

    var _p = {};
    var xhr_recrop = null;
    this.imageareaselect = null;
    this.selections = [];
    this.index = 0;
    this.img = new Image();
    this.image_css_size = {width: 0, height: 0};
    var _self = this;


    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.init_window_obj();
        _p.avatar_obj = $('#' + _self.properties.photo_id);
        $(_self.properties.photoAction).width(_p.avatar_obj.width());
        $(window).resize(function () {
            _p.avatar_obj = $('#' + _self.properties.photo_id);
            $(_self.properties.photoAction).width(_p.avatar_obj.width());
        });
        _p.avatar_obj.off('click').on('click', function () {
            if (_self.properties.mobileWidth < $(window).width()) {
                _self.load_avatar();
            }
        });
        $(_self.properties.viewPhotoClass).off('click').on('click', function () {
            _self.load_avatar();
        });
        $(_self.properties.changePhotoClass).off('click').on('click', function () {
            _self.load_avatar(1);
        });
        _self.init_imageareaselect();

        return this;
    };

    this.init_window_obj = function () {
        _self.properties.window_obj = new loadingContent({
            loadBlockWidth: '800px',
            closeBtnClass: 'w',
            loadBlockTopType: 'top',
            loadBlockTopPoint: 20,
            blockBody: true,
            showAfterImagesLoad: false
        });
    }

    this.destroy_window = function () {
        _self.properties.window_obj.hide_load_block();
        _self.properties.window_obj.destroy();
    }

    this.uninit = function () {
        _self.uninit_imageareaselect();
        _p.avatar_obj.off();
        return this;
    };

    this.load_avatar = function (uploader) {
        var load_uploader = uploader || '';
        $.ajax({
            url: _self.properties.site_url + _self.properties.load_avatar_url + load_uploader,
            type: 'POST',
            data: {id_user: _self.properties.id_user},
            dataType: 'json',
            cache: false,
            success: function (resp) {
                if (typeof resp.info.access_denied !== 'undefined' && resp.info.access_denied.length > 0) {
                    _self.properties.window_obj.show_load_block(resp.info.access_denied);
                    return false;
                }
                if (resp.status) {
                    _self.properties.window_obj.changeTemplate('gallery');
                    _self.properties.window_obj.update_css_styles({width: '962px'});
                    _self.properties.window_obj.show_load_block(resp.data.html);
                    _self.selections = [];
                    _self.properties.selections = resp.data.selections;
                    _self.add_selections(_self.properties.selections);
                } else if (resp.errors.length) {
                    error_object.show_error_block(resp.errors, 'error');
                }
            }
        });
    };

    this.add_selection = function (prefix, x1, y1, width, height) {
        _self.selections.push({
            prefix: prefix,
            x1: x1,
            y1: y1,
            width: width,
            height: height,
            orig_width: width,
            orig_height: height
        });
        return this;
    };

    this.add_selections = function (selections) {
        for (var i in selections) {
            if (selections.hasOwnProperty(i)) {
                _self.add_selection(i, 0, 0, parseInt(selections[i].width), parseInt(selections[i].height));
            }
        }
    };

    this.recrop = function () {

        if (xhr_recrop && xhr_recrop.state() == 'pending') {
            return xhr_recrop;
        }

        xhr_recrop = $.ajax({
            url: _self.properties.site_url + _self.properties.recrop_url + _self.properties.id_user,
            type: 'POST',
            data: _self.selections[_self.index],
            dataType: 'json',
            cache: false,
            success: function (resp) {
                if (resp.status) {
                    if (resp.data.img_url) {
                      for (var thumb in resp.data.img_url) {
                        $('img[src^="' + resp.data.img_url[thumb] + '"]').attr('src', resp.data.img_url[thumb] + '?' + new Date().getTime());
                      }
                    
                    $('#photo_source_recrop').attr('src',resp.data.img_url.grand);
                    $('#user_photo img, .inner-image img').attr('src',resp.data.img_url.grand);
                    $('#user_photo_bg').css("background", "transparent url('"+resp.data.img_url.grand+"') no-repeat center/cover");

                    setTimeout(()=>{
                      $('ul.media-gallery-editor__photo-view [data-section="view"]').trigger('click');
                    },0);
                  }
                } else if (resp.errors.length) {
                    error_object.show_error_block(resp.errors, 'error');
                }
                if (resp.msg.length) {
                    error_object.show_error_block(resp.msg, 'success');
                }
            }
        });
        return xhr_recrop;
    };

    this.init_imageareaselect = function () {
        _p.img_obj = $('#' + _self.properties.recrop_img_id);
        _p.photo_sizes_obj = $('#' + _self.properties.photo_sizes_id);
        _p.image_content_obj = $('#' + _self.properties.image_content_id);
        _p.photo_sizes_obj.html('');

        var recrop_img = $('#' + _self.properties.image_content_id + ' #' + _self.properties.recrop_container_id + ' img');
        var def_img  = $('#' + _self.properties.image_content_id + ' .inner-image #' + _self.properties.recrop_img_id);

        var recrop_src_rec = recrop_img.attr('src');
        var def_src_rec = def_img.attr('src');

        recrop_img.attr('src', recrop_src_rec  + '?' + new Date().getTime());
        def_img.attr('src', def_src_rec  + '?' + new Date().getTime());

        _p.image_content_obj.off('click', '#' + _self.properties.menu_container_id + ' [data-section]').on('click', '#' + _self.properties.menu_container_id + ' [data-section]', function () {

            var section = $(this).data('section');

            if (section === 'recrop' && _self.selections.length) {
                _p.image_content_obj.find('[data-area="view"]').hide();
                _p.image_content_obj.find('[data-area="recrop"]').show();
                _self.index = 1;
                _p.photo_sizes_obj.html('');
                _p.photo_sizes_obj.find('li').removeClass('active').eq(_self.index).addClass('active');
                _p.photo_sizes_obj.off('click', 'li span').on('click', 'li span', function () {
                    var size_index = $(this).data('index');
                    if (size_index >= _self.selections.length || size_index == _self.index) {
                        return false;
                    }
                    _self.index = size_index;
                    _self.change_selection();
                    _p.photo_sizes_obj.find('li').removeClass('active');
                    $(this).parent().addClass('active');
                    return false;
                });

                $('#' + _self.properties.recrop_container_id).off('recrop:do').on('recrop:do', function () {
                    _self.recrop();
                });

                if ($.isEmptyObject(_self.selections)) {
                    return;
                }

                _self.img.src = _p.img_obj.attr('src');
                _self.img.onload = function () {
                    if (_self.img.width) {
                        _p.image_ready();
                    } else {
                        _p.img_obj.off('load').on('load', function () {
                            _p.image_ready();
                        });
                    }
                };
                $('#' + _self.properties.rotate_left_id).on('click', function () {
                    _self.rotate(90);
                    return false;
                });
                $('#' + _self.properties.rotate_right_id).on('click', function () {
                    _self.rotate(-90);
                    return false;
                });
                $(_self.properties.photoMirrorHorId).on('click', function () {
                    _self.rotate('hor');
                    return false;
                });

                 $('#' +_self.properties.photo_crop_id).on('click', function () {
                    _self.recrop();
                    return false;
                });
            } else {
                _p.image_content_obj.find('[data-area="view"]').show();
                if (_self.imageareaselect) {
                    _self.imageareaselect.setOptions({hide: true});
                }
            }
            $(this).parents('ul').find('li').removeClass('active');
            $(this).parent().addClass('active');
        });

        $('#' + _self.properties.menu_container_id).find('[data-section="' + _self.properties.section + '"]').parent().addClass('active');
        $('#' + _self.properties.menu_container_id + ' .active span').click();

        _p.image_content_obj.off('click', '.media-gallery-editor__photo-view').on('click', '.media-gallery-editor__photo-view', function (event) {
            var editorBlock = $('#photo_source_recrop_box');
            var editorMenu = $(_self.properties.rotateMenuId);
            if (editorBlock.has(event.target).length === 0 && editorMenu.has(event.target).length === 0 ) {
                _p.image_content_obj.find('[data-area="recrop"]').hide();
                _p.image_content_obj.find('[data-area="view"]').show();
            }
        });

        if (_self.properties.userType == 'admin') {
            _p.image_content_obj.find('[data-section="recrop"]').trigger('click');
        }


        return this;
    };

    _p.image_ready = function (attempt) {

        attempt = attempt || 0;
        while (!(_p.img_obj.width() && _p.img_obj.height()) && attempt < 60) {
            setTimeout(function () {
                _p.image_ready(++attempt);
            }, 50);
            return this;
        }
        _self.image_css_size = {width: _p.img_obj.width(), height: _p.img_obj.height()};
        _self.selections = [];
        _self.add_selections(_self.properties.selections);
        _self.recalc_selection();
        _self.imageareaselect = _p.img_obj.imgAreaSelect({
            handles: true,
            persistent: true,
            aspectRatio: _self.selections[_self.index].width + ':' + _self.selections[_self.index].height,
            minWidth: _self.selections[_self.index].width,
            minHeight: _self.selections[_self.index].height,
            imageWidth: _self.img.width,
            imageHeight: _self.img.height,
            instance: true,
            parent: '#' + _self.properties.recrop_container_id,
            x1: _self.selections[_self.index].x1,
            y1: _self.selections[_self.index].y1,
            x2: _self.selections[_self.index].x1 + _self.selections[_self.index].width,
            y2: _self.selections[_self.index].y1 + _self.selections[_self.index].height,
            zIndex: 2,
            onSelectStart: function (image, selection) {
                _p.hide_recrop_btn(this);
            },
            onSelectEnd: function (image, selection) {
                if (!selection.width || !selection.height) {
                    return;
                }
                if (_self.properties.saveAfterSelect) {
                    _self.recrop();
                } else {
                    _p.show_recrop_btn(this);
                }
                _self.selections[_self.index].x1 = Math.min(selection.x1, selection.x2);
                _self.selections[_self.index].y1 = Math.min(selection.y1, selection.y2);
                _self.selections[_self.index].width = selection.width;
                _self.selections[_self.index].height = selection.height;
            },
            onSelectChange: function (image, selection) {
                if (!selection.width || !selection.height) {
                    return;
                }
                _p.hide_recrop_btn(this);
                _self.selections[_self.index].x1 = Math.min(selection.x1, selection.x2);
                _self.selections[_self.index].y1 = Math.min(selection.y1, selection.y2);
                _self.selections[_self.index].width = selection.width;
                _self.selections[_self.index].height = selection.height;
            },
            onInit: function (image, selection) {
                _p.show_recrop_btn(this);
            }
        });
    };

    _p.show_recrop_btn = function (imageareaselect) {
        var selection_obj = $(imageareaselect.parent).find('.' + imageareaselect.classPrefix + '-selection');
        //imageAreaSelect плагин перехватывает и переопределяет события мышки, поэтому задаем onmousedown с собственным триггером
        var btn = $('<div class="selection-recrop-btn"></div>');
        selection_obj.html(btn);
    };

    _p.hide_recrop_btn = function (imageareaselect) {
        $(imageareaselect.parent).find('.' + imageareaselect.classPrefix + '-selection').html('');
    };

    this.uninit_imageareaselect = function () {
        if (_p.img_obj) {
            _p.img_obj.off();
        }
        if (_p.photo_sizes_obj) {
            _p.photo_sizes_obj.off();
        }
        if (_p.image_content_obj) {
            _p.image_content_obj.off();
        }
        $('#' + _self.properties.recrop_container_id).off();
        _self.imageareaselect = null;
        _self.selections = [];
        _self.index = 0;
        return this;
    };

    this.change_selection = function () {
        var selection = _self.selections[_self.index];
        _self.imageareaselect.setOptions({
            aspectRatio: selection.width + ':' + selection.height,
            minWidth: selection.width,
            minHeight: selection.height,
            x1: selection.x1,
            y1: selection.y1,
            x2: selection.x1 + selection.width,
            y2: selection.y1 + selection.height
        });
        _self.imageareaselect.update(false);
        return this;
    };

    this.recalc_selection = function () {
        var height_ratio = _self.img.height / _self.image_css_size.height;
        var width_ratio = _self.img.width / _self.image_css_size.width;
        for (var i in _self.selections) {
            if (_self.selections.hasOwnProperty(i)) {
                if (_self.img.width < _self.selections[i].width || _self.img.height < _self.selections[i].height) {
                    var ratio;
                    if (_self.img.width < _self.selections[i].width) {
                        ratio = _self.img.width / _self.selections[i].width;
                        _self.selections[i].width *= ratio;
                        _self.selections[i].height *= ratio;
                    }
                    if (_self.img.height < _self.selections[i].height) {
                        ratio = _self.img.height / _self.selections[i].height;
                        _self.selections[i].width *= ratio;
                        _self.selections[i].height *= ratio;
                    }
                } else {
                    var width_recalc = _self.selections[i].width * width_ratio;
                    var height_recalc = _self.selections[i].height * height_ratio;
                    if (width_recalc >= _self.selections[i].width && width_recalc < _self.img.width && height_recalc >= _self.selections[i].height && height_recalc < _self.img.height) {
                        _self.selections[i].width = width_recalc;
                        _self.selections[i].height = height_recalc;
                    }
                    var x1 = Math.round(_self.img.width / 2 - _self.selections[i].width / 2);
                    if (x1 < 0) {
                        x1 = 0;
                    }
                    var y1 = Math.round(_self.img.height / 2 - _self.selections[i].height / 2);
                    if (y1 < 0) {
                        y1 = 0;
                    }
                    _self.selections[i].x1 = x1;
                    _self.selections[i].y1 = y1;
                }
            }
        }
        return this;
    };

    this.rotate = function (angle) {
        if (xhr_recrop && xhr_recrop.state() === 'pending') {
            return xhr_recrop;
        }
        var img_path = $('#' + _self.properties.recrop_img_id).attr('src');
        xhr_recrop = $.ajax({
            url: _self.properties.site_url + _self.properties.rotateUrl + angle + '/' + _self.properties.id_user,
            type: 'POST',
            dataType: 'json',
            cache: false,
            success: function (resp) {
                if (resp.status) {
                    if (resp.data.img_url) {
                        $('#' + _self.properties.recrop_img_id).attr('src', resp.data.img_url + '?' + new Date().getTime());
                        _self.index = 1;
                        _self.init_imageareaselect();
                        for (var i in resp.data.thumbs) {
                            $('img[src^="' + resp.data.thumbs[i] + '"]').attr('src', resp.data.thumbs[i] + '?' + new Date().getTime());
                        }
                        _p.image_content_obj.find('[data-area="recrop"]').hide();
                        _p.image_content_obj.find('[data-area="view"]').show();
                        $('[data-section="recrop"]').click();
                        setTimeout(function () {
                            $('[data-section="recrop"]').click();
                        }, 1000);
                    }
                    _self.properties.rand_param = Math.floor((Math.random() * 999999) + 1);
                    _self.properties.rand_param_change = true;
                } else if (resp.errors.length) {
                    _self.properties.errorObj.show_error_block(resp.errors, 'error');
                }
                if (resp.msg.length) {
                    setTimeout(function () {
                        _self.properties.errorObj.show_error_block(resp.msg, 'success');
                    }, 1000);
                }
            }
        });

        return xhr_recrop;
    };

    this.postUploadAvatar = function () {
        setTimeout(function () {
            _self.load_avatar();
            setTimeout(function () {
                $('[data-section="recrop"]').click();
            }, 400);
        }, 400);
    };

    _self.Init(optionArr);

    return this;
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.UsersAvatar = UsersAvatar;
}
