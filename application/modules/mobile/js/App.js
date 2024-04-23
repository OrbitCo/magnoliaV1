'use strict';
function App(optionArr)
{
    this.properties = {
        siteUrl: '/',
        statusAppBanner: 'mobile_app_banner',
        class: {
            appTopBanner: '.app-top-banner-js'
        },
        os_tags: ['ios', 'android'],
        data: {
            action: {
                closeBanner: '[data-action="close-app_banner"]',
                installApp: '[data-action="install-app"]'
            }
        }
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
        _self.getStatusBanner();
        _self.initActions();
    };

    this.initActions = function () {
        if (typeof analyticsEvents !== 'undefined') {
            var analytics_action = {'Personal Demo' : {}};
            $.each(_self.properties.os_tags, function (index, value) {
                analytics_action['Personal Demo']['banner-' + value] = 'banner-install';
                $.extend(true, analyticsEvents, analytics_action);
            });
        }
    };

    this.initControls = function () {
        $(document)
           .off('click', _self.properties.data.action.closeBanner).on('click', _self.properties.data.action.closeBanner, function () {
            _self.closeBanner();
           }).off('click', _self.properties.data.action.installApp).on('click', _self.properties.data.action.installApp, function () {
            _self.installApp(this);
           });
    };
    
    this.getStatusBanner = function () {
        if (lightGetCookie(_self.properties.statusAppBanner) !== 'closed') {
            $(_self.properties.class.appTopBanner).removeClass('hide');
        }
       
        $('.app-top-banner-js').prependTo('#pjaxcontainer');
    };

    this.installApp = function (el) {
        var tag = $(el).data('tag');
        var category = 'Personal Demo';
        if (typeof analyticsEvents !== 'undefined') {
            sendAnalytics('banner-install', category, 'banner-' + tag);
        }
    }
    
    this.closeBanner = function () {
        $(_self.properties.class.appTopBanner).addClass('hide');
        //lightSetCookie(_self.properties.statusAppBanner, 'closed');
        if (typeof isFramed !== 'undefined') {
            if (!isFramed) {
                if (!$('.app-top-banner-js').is(':visible')) {
                    $('#frame-wrapper').css('height', '');
                }
            }
        }
    };

    this.query = function (url, data, dataType, cb) {
        if (!/^(f|ht)tps?:\/\//i.test(url)) {
            url = _self.properties.siteUrl + url;
        }
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: data,
            dataType: dataType,
            success: function (data) {
                if (typeof (data.error) !== 'undefined' && data.error.length > 0) {
                    _self.properties.errorObj.show_error_block(data.error, 'error');
                }
                if (typeof (data.info) !== 'undefined' && data.info.length > 0) {
                    _self.properties.errorObj.show_error_block(data.info, 'info');
                }
                if (typeof (data.success) !== 'undefined' && data.success.length > 0) {
                    _self.properties.errorObj.show_error_block(data.success, 'success');
                }
                if (typeof (cb) !== 'undefined') {
                    cb(data);
                }
            }
        });
        return false;
    };

    _self.Init(optionArr);
};


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.App = App;
}
