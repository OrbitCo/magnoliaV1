/* global site_url */
function guide(optionArr) {
    this.properties = {
        autoshow: true,
        step: 1,
        guide: {},
        labelOf: 'of',
        labelSkip: 'Skip',
        labelNext: 'Next',
        labelBuy: 'Buy',
        windowObjTitle: '',
        isModuleInstructions: false,
        module: '',
        id: {
            btnGuide: '#guide-btn',
            nextGuide: '#guide-next',
            skipGuide: '#guide-skip'
        },
        btn: {
            btnGuide: 'guide-btn',
            nextGuide: 'guide-next',
            skipGuide: 'guide-skip'
        },
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

        $(_self.properties.id.btnGuide).on('click', function(e) {
            e.preventDefault();
            _self.properties.isModuleInstructions = false;
            var guide_item = _self.properties.guide[_self.properties.step];
            if (guide_item.selector) {
                $(guide_item.selector).removeAttr('style');
            }
            if (_self.properties.step === _self.total) {
                _self.properties.step = 1;
            }

            _self.show();

        });

        $(document).off('click', _self.properties.id.nextGuide).on('click',_self.properties.id.nextGuide, function(e) {
            e.preventDefault();
            _self.properties.isModuleInstructions = false;
            var guide_item = _self.properties.guide[_self.properties.step];
            if (guide_item.selector) {
                $(guide_item.selector).removeAttr('style');
            }

            _self.properties.step++;
            if (_self.properties.step === _self.total) {
                sendAnalytics('dp_admin_end_tutorial', 'tutorial', 'admin');
            }
            if (_self.properties.step <= _self.total) {
                _self.show();
            } else if (_self.windowObj) {
                $.get(site_url + 'admin/start/skip_guide/' + _self.properties.module);
                _self.windowObj.hide_load_block();
            }
        });

        $(document).off('click', _self.properties.id.skipGuide).on('click', _self.properties.id.skipGuide, function(e) {
            e.preventDefault();
            _self.properties.isModuleInstructions = false;
            var guide_item = _self.properties.guide[_self.properties.step];
            if (guide_item.selector) {
                $(guide_item.selector).removeAttr('style');
            }

            $.get(site_url + 'admin/start/skip_guide/' + _self.properties.module);
            if (_self.windowObj) {
                _self.windowObj.destroy();
                _self.windowObj = null;
            }
        });
        if (_self.properties.isModuleInstructions === true) {
            _self.closeUp();
        }
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

        if (guide_item.page && site_url + guide_item.page !== location.href) {
            $.post(site_url + 'admin/start/save_guide/' + _self.properties.module, {step: _self.properties.step, page: guide_item.page}, function(data) {
                if (data.status === true) {
                    location.href = site_url + guide_item.page;
                } else {
                    location.href = site_url + _self.properties.guide[_self.properties.step + 1].page;
                }
            }, 'json');
            return;
        }

        var options = {
            loadBlockTitle: _self.properties.step + ' ' + _self.properties.labelOf + ' ' + _self.total + ': ' + guide_item.title,
            loadBlockSize: 'small',
            draggable: false,
            blockBody: false,
            closeBtnUse: false,
            closeBtnLabel: _self.properties.labelSkip,
            closeBtnID: _self.properties.btn.skipGuide,
            loadBlockSmClass: 'modal fade bs-example-modal-sm guide-modal'
        };

        if (_self.properties.step < _self.total) {
            options.footerButtons = '<button class="btn btn-success pull-right" type="button" id="' + _self.properties.btn.nextGuide + '" name="btn_next">' + _self.properties.labelNext + '</button>';
        } else if (_self.properties.isModuleInstructions === false) {
            options.footerButtons = '<a class="btn btn-success pull-right" href="https://marketplace.datingpro.com/information/pricing/" target="_blank">' + _self.properties.labelBuy + '</a>';
        }

        _self.windowObj = new loadingContent(options);
        _self.windowObj.show_load_block(guide_item.content);
        _self.callbackShow();

        if (guide_item.selector) {
            $(guide_item.selector).attr('style', guide_item.attr);
        }
    };

    this.callbackShow = function() {
        _self.properties.callbackShow();
    };

    this.closeUp = function () {
        setTimeout(function (){
            if (_self.properties.isModuleInstructions) {
                _self.properties.isModuleInstructions = false;
                if (_self.properties.autoshow) {
                    $('.modal-content').effect('transfer', { to: _self.properties.id.btnGuide, className: 'modal-content'}, 1000);
                    if (_self.windowObj) {
                        _self.windowObj.destroy();
                    }
                }
            }
        }, 5000);

    };

    _self.Init(optionArr);
}
