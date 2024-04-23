/* global Storage, site_rtl_settings */
function dashboardAdmin(optionArr)
{
    'use strict';
    this.properties = {
        siteUrl: '/',
        tempScrollTop: 0,
        visibilityDashboard: 'visibility-dashboard',
        cookiePath: '/',
        cookieDomain: '',
        trial: false,
        position: (site_rtl_settings === 'rtl') ? 'left' : 'right',
        id: {
            dashboard: '#dashboard',
            topNav: '#top_nav',
            scrollTop: '#scroll-top',
            eventBlock: '#event-block-',
            dashboardVisibilityBtn: '#dashboard-visibility-btn'
        },
        cssClass: {
            dashboardAction: '.js-dashboard-action',
            dashboardDeployed: '.dashboard-deployed-js',
            dashboardMinimized: '.dashboard-minimized-js',
            quickStats: '.quick-stats-js',
            dashboardVisibilityBtn: '.dashboard-visibility-btn'
        },
        dataAction: {
            event: '[data-action="event"]',
            top: '[data-action="top"]'
        },
        action: false,
        langs: {},
        errorObj: new Errors(),
        contentObj: null
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
        _self.scrollBlock();
        _self.scrollToEventBlock();
        _self.visibilityDashboard();
        $(window).trigger('scroll');
    };

    this.initControls = function () {
        $(document).off('click', _self.properties.cssClass.dashboardAction).on('click', _self.properties.cssClass.dashboardAction, function (e) {
            _self.dashboardAction(e, $(this));
        }).off('click', _self.properties.id.scrollTop).on('click', _self.properties.id.scrollTop, function () {
            _self.scrollToTop();
        }).off('click', _self.properties.cssClass.dashboardVisibilityBtn).on('click', _self.properties.cssClass.dashboardVisibilityBtn, function (e) {
          if($(e.target).closest('.modal').length){
            return false;
          }
            var is_visibility = (_self.getCookie(_self.properties.visibilityDashboard) === '1') ? 0 : 1;
            _self.setCookie(_self.properties.visibilityDashboard, is_visibility, {
                expires: 3600,
                path: _self.properties.cookiePath,
                domain: _self.properties.cookieDomain
            });
            _self.visibilityDashboard();
        }).off('ifChanged', 'input[name="rejection_reason"]').on('ifChanged', 'input[name="rejection_reason"]', function () {
            var key = $(this).val();
            $('.btn-moder-action-js').attr('href', _self.properties.action+key+'/1');
            $('#moderation_block').find('.alert-danger').addClass('hide')
        }).off('click', '.btn-moder-action-js').on('click', '.btn-moder-action-js', function (e) {
            if ( $('input[name="rejection_reason"]').is(":checked") === false) {
                $('#moderation_block').find('.alert-danger').removeClass('hide');
                return false;
            }
            e.preventDefault();
            e.stopPropagation();
            var obj = $(this);
            $.get(obj.prop('href'), {}, function () {
                var id = obj.closest(_self.properties.dataAction.event).data('id');
                if (typeof id !== "undefined") {
                    sessionStorage.eventId = id;
                    location.reload();
                } else {
                    locationHref(_self.properties.siteUrl + 'admin/' + _self.properties.id.eventBlock + id);
                }
            });
        });
    };

    this.dashboardAction = function (e, obj) {
        e.preventDefault();
        e.stopPropagation();
        if (obj.data('moderation') && obj.data('type') != 'network_data') {
            var htmlObj = '<div id="moderation_block">';
                    htmlObj += '<h3>'+ _self.properties.langs.moderation.headerReason +'</h3>';
                    htmlObj += '<div class="load_content">';
                        htmlObj += '<div class="form-group">';
                            htmlObj += '<div>';
            for (var key in _self.properties.langs.moderation.rejectionReason) {
                htmlObj += '<div class="checkbox">';
                    htmlObj += '<input type="radio" value="'+key+'" name="rejection_reason" id="rejection-reason-'+key+'" class="flat"><label for="rejection-reason-'+key+'" class="reason-text"> '+_self.properties.langs.moderation.rejectionReason[key];
                htmlObj += '</label></div>';
            }
                            htmlObj += '</div>';
                        htmlObj += '</div>';
                    htmlObj += '</div>';
                    htmlObj += '<div class="alert alert-danger hide">'+_self.properties.langs.moderation.emptyReason+'</div>';
                htmlObj += '</div>';
            _self.properties.contentObj.show_load_block(htmlObj);
            _self.properties.action = obj.data('href');
            var title = obj.data('title');
            $('.btn-moder-action-js').text(title).attr('href', _self.properties.action);
            return false;
        }
        $.get(obj.prop('href'), {is_not_redirect: 1}, function () {
            var id = obj.closest(_self.properties.dataAction.event).data('id');
            if (typeof id !== "undefined") {
                sessionStorage.eventId = id;
                location.reload();
            } else {
                locationHref(_self.properties.siteUrl + 'admin/' + _self.properties.id.eventBlock + id);
            }
        });
    };

    this.isScrolledIntoView = function (elem) {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();
        var elemTop = $(elem).offset().top;
        var elemBottom = elemTop + $(elem).height();
        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    this.scrollBlock = function () {
        var topMenuHeight = $(_self.properties.id.topNav).height() - 40;

        if (_self.properties.trial === true) {
          //TODO demo content
        }

        var dashboardContentObj = $(_self.properties.id.dashboard + ' .dashboard__content');

        dashboardContentObj.scroll(function () {
            if ($(this).scrollTop() > topMenuHeight) {
                $(_self.properties.id.scrollTop).fadeIn();
            } else {
                $(_self.properties.id.scrollTop).fadeOut();
            }
        });

        $(window).scroll(function () {
            if (_self.isScrolledIntoView('footer')) {
                $(_self.properties.id.dashboard).css('bottom', '20px');
            } else {
                $(_self.properties.id.dashboard).css('bottom', '-10px');
            }

            if ($(this).scrollTop() > topMenuHeight) {
                $(_self.properties.id.dashboard).css('top', '0px');
                dashboardContentObj.css('margin-top', '-' + topMenuHeight + 'px');
            } else {
                if (_self.properties.trial !== false && typeof isFramed !== 'undefined') {
                    if (!isFramed) {
                        if ($('#demo-panel').is(':visible')) {
                            $(_self.properties.id.dashboard).css('top', '167px');
                        } else {
                            $(_self.properties.id.dashboard).css('top', '70px');
                        }
                    } else {
                        $(_self.properties.id.dashboard).css('top', '40px');
                    }
                } else {
                    $(_self.properties.id.dashboard).css('top', '40px');
                }
                dashboardContentObj.css('margin-top', '-' + $(this).scrollTop() + 'px');
            }
        });
    };

    this.scrollToTop = function () {
        $(_self.properties.id.dashboard + ' .dashboard__content').animate({scrollTop: $(_self.properties.dataAction.top).offset().top}, 1000);
    };

    this.scrollToEventBlock = function () {
          if (typeof sessionStorage.eventId !== 'undefined') {
              var id = sessionStorage.eventId;
              var obj = (navigator.userAgent.match(/Firefox/)) ? $('body, html') : $(_self.properties.id.dashboard + ' .dashboard__content');
              obj.animate({scrollTop: $(_self.properties.id.eventBlock + id).offset().top - 50}, 500);
              delete sessionStorage.eventId;
          }
    };

    this.visibilityDashboard = function () {
        var w_width = $(window).width();
        if (_self.getCookie(_self.properties.visibilityDashboard) === '1') {
            $(_self.properties.id.dashboard).css(_self.properties.position, '-350px');
            $(_self.properties.id.dashboard + ' + div').css('padding-'+_self.properties.position, '0');
            $(_self.properties.cssClass.dashboardMinimized).show();
            $(_self.properties.cssClass.dashboardDeployed).hide();
            $(_self.properties.cssClass.quickStats).removeClass('open');
            var b_height = $(_self.properties.cssClass.dashboardMinimized+'>div:first').text().length*8;
            $(_self.properties.id.dashboardVisibilityBtn).css({'position': 'fixed', 'padding-top': b_height+'px'});
            $(_self.properties.id.dashboardVisibilityBtn).css(_self.properties.position, '0');
        } else {
            if (w_width <= '470') {
                var d_width = w_width-120;
                $(_self.properties.id.dashboard).css('width', d_width+'px');
                $(_self.properties.id.dashboardVisibilityBtn).css({'position': 'absolute', 'padding-top': '0'});
                $(_self.properties.id.dashboardVisibilityBtn).css(_self.properties.position, d_width+'px');
                $(_self.properties.id.dashboard + ' + div').css('padding-'+_self.properties.position, d_width+'px');
                $(_self.properties.id.dashboard).find('img').css('width', (d_width-100)+'px');
                $(_self.properties.cssClass.quickStats).removeClass('open');
            } else {
                $(_self.properties.id.dashboardVisibilityBtn).css({'position': 'absolute', 'padding-top': '0'});
                $(_self.properties.id.dashboardVisibilityBtn).css(_self.properties.position, '349px');
                $(_self.properties.id.dashboard + ' + div').css('padding-'+_self.properties.position, '350px');
                $(_self.properties.cssClass.quickStats).addClass('open');
            }
            $(_self.properties.id.dashboard).css(_self.properties.position, '0');
            $(_self.properties.cssClass.dashboardMinimized).hide();
            $(_self.properties.cssClass.dashboardDeployed).show();
        }
    };

    this.setCookie = function (name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires === "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 60 * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    };

    this.getCookie = function (name) {
        var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
                ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    _self.Init(optionArr);

}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.dashboardAdmin = dashboardAdmin;
}
