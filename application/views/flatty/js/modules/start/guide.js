function guide(optionArr) {
    this.properties = {
        autoshow: false,
        step: 1,
        guide: {},
        labelOf: 'of',
        labelSkip: 'Skip',
        labelNext: 'Next',
        labelBuy: 'Buy',
        windowObjTitle: '',
        callbackShow: function(){}
    };

    var windowObj;

    var total = 0;

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);

        _self.total = Object.keys(_self.properties.guide).length;

        if (_self.properties.autoshow) {
            _self.show();
        }

        $('#guide-btn').on('click', function(e) {
            e.preventDefault();

            var guide_item = _self.properties.guide[_self.properties.step];
            if (guide_item.selector) {
                $(guide_item.selector).removeAttr('style');
            }

            if (guide_item.reset) {
                eval(guide_item.reset);
            }

            if (_self.properties.step == _self.total) {
                _self.properties.step = 1;
            }

            _self.show();
        });

        $(document).off('click', '#guide-next').on('click', '#guide-next', function(e) {
            e.preventDefault();

            var guide_item = _self.properties.guide[_self.properties.step];
            if (guide_item.selector) {
                $(guide_item.selector).removeAttr('style');
            }

            if (guide_item.reset) {
                eval(guide_item.reset);
            }

            _self.properties.step++;

            if (_self.properties.step == _self.total) {
                sendAnalytics('dp_user_end_tutorial', 'tutorial', 'user');
            }

            if (_self.properties.step <= _self.total) {
                _self.show();
            } else if (_self.windowObj) {
                $.get(site_url + 'start/skip_guide');
                _self.windowObj.hide_load_block();
            }
        });

        $(document).off('click', '#guide-skip').on('click', '#guide-skip', function(e) {
            e.preventDefault();

            var guide_item = _self.properties.guide[_self.properties.step];
            if (guide_item.selector) {
                $(guide_item.selector).removeAttr('style');
            }

            if (guide_item.reset) {
                eval(guide_item.reset);
            }

            $.get(site_url + 'start/skip_guide');

            if (_self.windowObj) {
                _self.windowObj.destroy();
                _self.windowObj = null;
            }
        });
    };

    this.uninit = function () {
        if (_self.windowObj) {
            _self.windowObj.destroy();
        }
    };

    this.show = function () {
        if (_self.windowObj) {
            _self.windowObj.destroy();
        }

        var guide_item = _self.properties.guide[_self.properties.step];

        if (guide_item.page ) {
            $.post(site_url + 'start/save_guide', {step: _self.properties.step, page: guide_item.page}, function(data) {
                if (site_url + guide_item.page != location.href) {
                    if (data.status === true) {
                        location.href = site_url + guide_item.page;
                    } else {
                        location.href = site_url + _self.properties.guide[_self.properties.step + 1].page;
                    }
                }
            }, 'json');
            if (site_url + guide_item.page != location.href) {
                return;
            }
        } else {
            $.post(site_url + 'start/save_guide', {step: _self.properties.step, page: ''}, function() {});
        }

        var options = {
            otherClass: 'guide_content col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2',
            draggable: true,
            blockBody: false,
            closeBtnUse: false,
            closeBtnID: 'guide-skip',
            onClose: function () {
              var guide_item = _self.properties.guide[_self.properties.step];
              if (guide_item.selector) {
                  $(guide_item.selector).removeAttr('style');
              }

              if (guide_item.reset) {
                  eval(guide_item.reset);
              }

              $.get(site_url + 'start/skip_guide');
            },
        }

        var footerButtons = '<button type="button" id="guide-skip" class="btn btn-default">' + _self.properties.labelSkip + '</button>';

        if (_self.properties.step < _self.total) {
            footerButtons += '<button class="btn btn-success pull-right" type="button" id="guide-next" name="btn_next">' + _self.properties.labelNext + '</button>';
        } else {
            footerButtons += '<a class="btn btn-success pull-right" href="https://marketplace.datingpro.com/information/pricing/" target="_blank">' + _self.properties.labelBuy + '</a>';
        }

        _self.windowObj = new loadingContent(options);
        var block = _self.windowObj.show_load_block(
          '<div id="guide-content" class="content-block load_content" style="display:table;width:100%;height:100%;table-layout:fixed;">' +
          '  <div style="display:table-row;">' +
          '    <h1 style="display:table-cell;">' + _self.properties.step + ' ' + _self.properties.labelOf + ' ' + _self.total + ': ' + guide_item.title + '</h1>' +
          '  </div>' +
          '  <div style="display:table-row;">' +
          '    <div class="inside" style="display:table-cell;height:100%;">' +
          '      <div style="position:relative;height:100%;">' +
          '        <div style="top:0;left:0;bottom:0;right:0;overflow:auto;">' + guide_item.content + '</div>' +
          '      </div>' +
          '    </div>' +
          '  </div>' +
          '  <div style="display:table-row;">' +
          '    <div class="inside" style="display:table-cell;padding-top:20px;">'+footerButtons+'</div>' +
          '  </div>' +
          '</div>');
        $('#guide-content').parents('.load_content_bg').first().css('background', 'none');

        $('#' + block).attr('style', 'position: absolute;padding: 0;left: 0; right: 0;margin: auto;max-width: 600px; top: 10%');
        $('#' + block).removeClass('load_content_inner');
        var bg_block = block.replace('user_load_content', 'user_load_content_bg');
        $('#' + bg_block).addClass('guide_modal');

        _self.callbackShow();

        if (guide_item.selector) {
            $(guide_item.selector).attr('style', guide_item.attr);
        }

        if (guide_item.function) {
            eval(guide_item.function);
        }
    }

    this.callbackShow = function() {
        _self.properties.callbackShow();
    }

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.guide = guide;
}
