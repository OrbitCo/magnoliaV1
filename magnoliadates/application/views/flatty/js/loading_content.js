(function (global) {
    "use strict";
    global.loadingContent = function (optionArr, template) {
        if ( loadingContent.prototype._self ) {
            return loadingContent.prototype._self.addWindow(optionArr, template);
        }

        loadingContent.prototype._self = this;
        loadingContent.prototype.loadedBlock = {};
        loadingContent.prototype.templates = [];
        loadingContent.prototype.template = 'default';
        loadingContent.prototype.isActive = false;

        function Window(options, popupTemplate)
        {
            var randNumber = Math.round(Math.random(1000) * 1000);

            this.properties = {
                loadBlockID: 'user_load_content' + randNumber,
                loadBlockBgID: 'user_load_content_bg' + randNumber,
                loadBlockBgClass: 'load_content_bg',
                loadBlockClass: 'load_content_inner',
                linkerObjID: '',
                loadBlockWidth: '50%',
                loadBlockLeftType: 'center', /// left, right
                loadBlockLeftPoint: 0,
                loadBlockTopType: 'center', /// top, bottom
                loadBlockTopPoint: 0,
                dir: site_rtl_settings, /// rtl
                posPropertyLeft: "left",
                posPropertyRight: "right",
                headline: '',
                blockBody: true,
                closeBtnID: 'user_load_content_close' + randNumber,
                closeBtnClass: 'load_content_close',
                closeBtnUse: true,
                closeBtnPadding: 5,
                draggable: false,
                showAfterImagesLoad: true,
                contentImages: 0,
                contentLoadedImages: 0,
                otherClass: '', //custom class for loadBlockID
              ///// left / right buttons
                leftBtnID: 'user_load_content_left' + randNumber,
                leftBtnClass: 'load_content_left',
                leftBtnFunction: function () {
                },
                leftBtnCreated: false,
                rightBtnID: 'user_load_content_right' + randNumber,
                rightBtnClass: 'load_content_right',
                rightBtnFunction: function () {
                },
                rightBtnCreated: false,
                onClose: function () {
                },
                destroyOnReload: true
            }

            var _self = this;

            this.Init = function (options, template) {
                _self.properties = $.extend(_self.properties, options);
                if (_self.properties.dir == 'rtl') {
                    _self.properties.posPropertyLeft = "right";
                    _self.properties.posPropertyRight = "left";

                    if (_self.properties.loadBlockLeftType != 'center' && _self.properties.linkerObjID) {
                        if (_self.properties.loadBlockLeftType == 'left') {
                              _self.properties.loadBlockLeftType = 'right';
                        } else {
                              _self.properties.loadBlockLeftType = 'left';
                        }
                    }
                }

                _self.create_load_block(template);

                $(global).off('resize.loadblock').on('resize.loadblock', function () {
                    _self.reposition_load_block();
                });

                $(global.document).on('pjax:start', function (e) {
                    if (_self.properties.destroyOnReload) {
                        _self.destroy();
                    } else {
                        _self.hide_load_block();
                    }
                });
                if (options.loadBlockWidth) {
                    $('#' + _self.properties.loadBlockID).css('min-width', _self.properties.loadBlockWidth);
                }
            }

            this.extend_errors = function (errors) {
                _self.errors = $.extend(_self.errors, errors);
            }

            this.destroy = function () {
                _self.hide_load_block();
                $('#pjaxcontainer')
                .find('#' + _self.properties.loadBlockID + ', ' +
                '#' + _self.properties.closeBtnID + ', ' +
                '#' + _self.properties.leftBtnID + ', ' +
                '#' + _self.properties.rightBtnID)
                .remove();
            }

            this.create_load_block = function (template) {
                var content = global.twig({ref: 'popup-template-' + template}).render({
                    block_background_id: _self.properties.loadBlockBgID,
                    block_id: _self.properties.loadBlockID,
                    use_close_button: _self.properties.closeBtnUse,
                    close_button_id: _self.properties.closeBtnID
                });

                $("#pjaxcontainer").append(content);

                if (typeof _self.properties.draggable) {
                    $("#" + _self.properties.loadBlockID).draggable({handle: "h1"});
                }
            }

            this.show_load_block = function (content, animate) {
                animate = animate || false;

                var loaded_block = _self.getLoadedBlock();
                if (!$.isEmptyObject(loaded_block)) {
                    _self.unsetLoadedBlock();
                    loaded_block.show_load_block(content, animate);
                    return;
                }

                _self.setLoadedBlock(_self);
                _self.active_bg();

                if ($("#" + _self.properties.loadBlockBgID).hasClass('gallery-type')) {
                    $('nav.navbar').hide();
                }

                var height_old = $("#" + _self.properties.loadBlockID + '_content').height();
                $("#" + _self.properties.loadBlockID + '_content').html(content);


                var height = $("#" + _self.properties.loadBlockID + '_content').height();
                if (animate && height_old && height) {
                    $("#" + _self.properties.loadBlockID + '_content').stop().css('height', height_old + 'px').animate({'height': height + 'px'}, 100, function () {
                        $(this).css('height', 'auto')
                    });
                }

                _self.reposition_load_block();

                if (_self.properties.showAfterImagesLoad) {
                    _self.properties.contentImages = $("#" + _self.properties.loadBlockID + ' img').length;
                    _self.properties.contentLoadedImages = 0;
                    _self.show_after_load();
                } else {
                    $("#" + _self.properties.loadBlockID).fadeIn();
                    if (_self.properties.closeBtnUse) {
                        _self.active_close();
                    }
                    if (_self.properties.leftBtnCreated) {
                        _self.active_left();
                    }
                    if (_self.properties.rightBtnCreated) {
                        _self.active_right();
                    }
                }

                if (_self.properties.blockBody) {
                    var window_width = $(global).width();
                    $('body').css('overflow', 'hidden');
                    var margin = ($(global).width() - window_width);
                    $('body').css('margin-' + _self.properties.posPropertyRight, margin + 'px');

                    $('#' + _self.properties.loadBlockBgID).css({'overflow-x': 'auto', 'overflow-y': 'scroll'});
                }
                if (_self.properties.otherClass) {
                    $("#" + _self.properties.loadBlockID).addClass(_self.properties.otherClass);
                }

                loadingContent.prototype.isActive = true;

                return _self.properties.loadBlockID;
            }

            this.show_after_load = function () {
                if (_self.properties.contentLoadedImages < _self.properties.contentImages) {
                    $("#" + _self.properties.loadBlockID + ' img').on('load', function () {
                        _self.properties.contentLoadedImages++;
                    });
                    setTimeout(_self.show_after_load, 300);
                } else {
                    _self.reposition_load_block();
                    $("#" + _self.properties.loadBlockID).fadeIn();
                    if (_self.properties.closeBtnUse) {
                        _self.active_close();
                    }
                    if (_self.properties.leftBtnCreated) {
                        _self.active_left();
                    }
                    if (_self.properties.rightBtnCreated) {
                        _self.active_right();
                    }
                }

            }

            this.reposition_load_block = function () {

            }

            this.hide_load_block = function () {
                if ($("#" + _self.properties.loadBlockBgID).hasClass('gallery-type')) {
                    $('nav.navbar').show();
                }
                var loaded_block = _self.getLoadedBlock();
                if (!$.isEmptyObject(loaded_block)) {
                    _self.unsetLoadedBlock();
                    loaded_block.hide_load_block();
                    return;
                }

                if (global.wc_videoStreamUrl) {
                    global.wc_videoStreamUrl = null;
                }
                if (_self.properties.blockBody) {
                    $('body').css('overflow', 'auto').css('margin-' + _self.properties.posPropertyRight, 'auto');
                }
                $("#" + _self.properties.loadBlockBgID).hide();
                if ($("#" + _self.properties.loadBlockID).css('display') == 'none') {
                    return;
                }

                _self.clear_buttons();

                $("#" + _self.properties.loadBlockID).fadeOut(300, function () {
                    $("#" + _self.properties.loadBlockID + '_content').html('');
                    _self.inactive_bg();
                });
                _self.properties.onClose();

                loadingContent.prototype.isActive = false
            }

            this.clear_buttons = function () {
                if (_self.properties.closeBtnUse) {
                    _self.inactive_close();
                }
                if (_self.properties.leftBtnCreated) {
                    _self.inactive_left();
                }
                if (_self.properties.rightBtnCreated) {
                    _self.inactive_right();
                }
            }

            this.active_bg = function () {
                if (!$("#" + _self.properties.loadBlockBgID).hasClass('gallery-type')) {
                    $("#" + _self.properties.loadBlockBgID).css('display', 'flex');
                } else {
                    $("#" + _self.properties.loadBlockBgID).show();
                }
                $("#" + _self.properties.loadBlockBgID).unbind().on('click', function (e) {
                    if ($(e.target).attr('id') == _self.properties.loadBlockBgID) {
                        _self.hide_load_block();
                    }
                });
            }

            this.inactive_bg = function () {
                if ($("#" + _self.properties.loadBlockBgID).css('display') != 'none') {
                    $("#" + _self.properties.loadBlockBgID).fadeOut();
                    $("#" + _self.properties.loadBlockBgID).unbind();
                }
            }

            this.active_close = function () {
                if ($("#" + _self.properties.closeBtnID).css('display') == 'none' || $("#" + _self.properties.closeBtnID).is(':hidden')) {
                    $("#" + _self.properties.closeBtnID).on('click', function () {
                        _self.hide_load_block();
                    });
                    window.addEventListener('keydown', function (e) {
                        if (e.key == 'Escape' || e.key == 'Esc' || e.keyCode == 27) {
                            _self.hide_load_block();
                        }
                    });
                    $("#" + _self.properties.closeBtnID).fadeIn();
                    $("#" + _self.properties.closeBtnID).removeClass('hide');
                }
            }

            this.inactive_close = function () {
                if ($("#" + _self.properties.closeBtnID).css('display') != 'none') {
                    $("#" + _self.properties.closeBtnID).unbind();
                    $("#" + _self.properties.closeBtnID).fadeOut();
                }
            }

            this.position_close = function () {

            }

            this.create_left = function (func) {
                _self.inactive_left();
                $("#" + _self.properties.loadBlockID).append('<div id="' + _self.properties.leftBtnID + '"></div>');
                _self.properties.leftBtnFunction = func;
                _self.properties.leftBtnCreated = true;
                $("#" + _self.properties.leftBtnID)
                .addClass(_self.properties.leftBtnClass)
                .css({
                    'cursor': 'pointer',
                    'position': 'absolute',
                    'display': 'none',
                    'z-index': '1001'
                });
                _self.position_left();
            }

            this.create_right = function (func) {
                _self.inactive_right();
                $("#" + _self.properties.loadBlockID).append('<div id="' + _self.properties.rightBtnID + '"></div>');
                _self.properties.rightBtnFunction = func;
                _self.properties.rightBtnCreated = true;
                $("#" + _self.properties.rightBtnID)
                .addClass(_self.properties.rightBtnClass)
                .css({
                    'cursor': 'pointer',
                    'position': 'absolute',
                    'display': 'none',
                    'z-index': '1001'
                });
                _self.position_right();
            }

            this.active_left = function () {
                _self.position_left();
                $("#" + _self.properties.leftBtnID).unbind('click').on('click', _self.properties.leftBtnFunction).fadeIn();
            }

            this.inactive_left = function () {
                $("#" + _self.properties.leftBtnID).remove();
                _self.properties.leftBtnCreated = false;
            }

            this.active_right = function () {
                _self.position_right();
                $("#" + _self.properties.rightBtnID).unbind('click').on('click', _self.properties.rightBtnFunction).fadeIn();
            }

            this.inactive_right = function () {
                $("#" + _self.properties.rightBtnID).remove();
                _self.properties.rightBtnCreated = false;
            }

            this.position_left = function () {
                var padding = 8;
                var main_window_left = parseInt($("#" + _self.properties.loadBlockID).css(_self.properties.posPropertyLeft));
                var main_window_top = parseInt($("#" + _self.properties.loadBlockID).css('top'));
                var main_window_height = $("#" + _self.properties.loadBlockID).height();
                var x = main_window_left + padding;
                var y = main_window_top + (main_window_height - $("#" + _self.properties.leftBtnID).height()) / 2;
                $("#" + _self.properties.leftBtnID).css(_self.properties.posPropertyLeft, '0px').css('top', '0px');
            }
            this.position_right = function () {
                var padding = 8;
                var main_window_left = parseInt($("#" + _self.properties.loadBlockID).css(_self.properties.posPropertyLeft));
                var main_window_top = parseInt($("#" + _self.properties.loadBlockID).css('top'));
                var main_window_width = $("#" + _self.properties.loadBlockID).width();
                var main_window_height = $("#" + _self.properties.loadBlockID).height();
                var x = main_window_left + main_window_width - $("#" + _self.properties.rightBtnID).width() - padding;
                var y = main_window_top + (main_window_height - $("#" + _self.properties.rightBtnID).height()) / 2;
                $("#" + _self.properties.rightBtnID).css(_self.properties.posPropertyRight, '0px').css('top', '0px');
            }

            this.setOptions = function (options) {
                _self.properties = $.extend(_self.properties, options);
                return this;
            }

            this.changeTemplate = function (template) {
                if ($.inArray(template, loadingContent.prototype.templates) == -1) {
                    global.twig({
                        id: 'popup-template-' + template,
                        href: global.base_url + 'application/views/' +
                        global.theme + '/popup/' + template + '.twig',
                        async: false
                    });

                    loadingContent.prototype.templates.push(template);
                    loadingContent.prototype.template = template
                }

                var content = global.twig({ref: 'popup-template-' + template}).render({
                    block_background_id: _self.properties.loadBlockBgID,
                    block_id: _self.properties.loadBlockID,
                    use_close_button: _self.properties.closeBtnUse,
                    close_button_id: _self.properties.closeBtnID
                });

                $('#' + _self.properties.loadBlockBgID).replaceWith(content);

                if (_self.properties.draggable) {
                    $("#" + _self.properties.loadBlockID).draggable({handle: "h1"});
                }

                return this;
            }

            this.update_css_styles = function (cssArr, target) {
                return this;
            }

            this.setLoadedBlock = function (obj) {
                loadingContent.prototype.loadedBlock = obj;
            }

            this.unsetLoadedBlock = function () {
                loadingContent.prototype.loadedBlock = {};
            }

            this.getLoadedBlock = function () {
                return loadingContent.prototype.loadedBlock;
            }

            _self.Init(options, popupTemplate);

            return _self;
        }

        this.addWindow = function (options, template) {
            template = template || 'default';
            if ($.inArray(template, loadingContent.prototype.templates) == -1) {
                try {
                    global.twig({
                        id: 'popup-template-' + template,
                        href: global.base_url + 'application/views/' +
                        global.theme + '/popup/' + template + '.twig',
                        async: false
                    });
                } catch (e) {
                    console.log(e);
                }

                loadingContent.prototype.templates.push(template);
                loadingContent.prototype.template = template;
            }

            return new Window(options, template);
        }

        return loadingContent.prototype._self.addWindow(optionArr, template);
    }
}(window));

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.loadingContent = loadingContent;
}



