"use strict";
function mobileTopMenu(optionArr)
{

    this.properties = {
        siteUrl: '',
        offScroll: '',
        mMenu: '.mobile-top-menu',
        mobileMenu: '.mobile-menu-wrapper',
        mobileMenuItem: '.mobile-menu-item',
        scrollToTop: '.scroll-to-top',
        siteheader: 'header',
        mainMenu: '#main-menu-container',
        demoPromoBlock: '.demo-promo-block-js',
        tempScrollTop: 0,
        fixedMenuScroll: 10
    };
     

    var _self = this;
    var _objEl = [
        'h1',
        '.title-block',
        '.footer-menu-title-block',
        '#activities_chatbox_item_xs'
    ];

    this.scroll_top_fast = false;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.init_controls();
        _self.buildMenu();
        let scrollPos = 0;

        $(window).resize(function () {
            let top = $(document).scrollTop();
            if ($('.mobile-menu-wrapper').is(':visible')) {  
                $('.magazine-profile__media').css('top', '0px');
            } else {
                if (!top) {
                    $('.magazine-profile__media').css('top', '47px');
                }
            }
        });
        $(window).scroll(function () {
            var isSlickLoaded = (typeof $.fn.slick !== 'undefined');
            if (isSlickLoaded) {
                $('.mobile-menu-wrapper').slick('slickGoTo', 0, true);
            }
            
            let top = $(document).scrollTop();
            if ($(_self.properties.demoPromoBlock).is(':visible')) {
                _self.properties.fixedMenuScroll = 150;
            } else {
                _self.properties.fixedMenuScroll = 10;
            }
            if (!_self.properties.offScroll) {
                if (top < scrollPos) {
                    $('nav').css({display: 'block'});
                    $(_self.properties.mMenu).css({top: '46px', position: 'fixed', display: 'block'});

                    if ($('.magazine-profile__media').length > 0) {
                        if (!$('.mobile-menu-wrapper').is(':visible')) {
                            $('.magazine-profile__media').css('top', '47px');
                        } else {
                            $('.magazine-profile__media').css('top', '0px');
                        }
                    }

                    $(_self.properties.mainMenu).css({'position': 'relative'});
                } else if (top > _self.properties.fixedMenuScroll+100) {
                    $('nav').css({display: 'none'});
                    if ($('.magazine-profile__media').length > 0) {
                        $('.magazine-profile__media').css('top', '0px');
                    }
                    $(_self.properties.mMenu).css({display: 'none'});
                } else {
                    $(_self.properties.mMenu).css({display: 'none'});
                    $(_self.properties.mainMenu).css({'position': 'fixed'});
                }

                if (top == 0) {
                    $(_self.properties.mMenu).css({top: '0', position: 'relative', display: 'block'});
                }
            }
            scrollPos = top;
        });
        _self.scrollToTop();
    };

    this.uninit = function () {
         $(document)
            .off('click', _self.properties.mobileMenuItem)
            .off('focus keypress keyup change blur', 'textarea, input[type=text]');
        return this;
    };

    this.init_controls = function () {
        $(document)
          .off('click', _self.properties.mobileMenuItem).on('click', _self.properties.mobileMenuItem, function () {
            _self.scrollToBlock($(this));
          }).off('focus keypress keyup change blur', 'textarea, input[type=text]').on('focus keypress keyup change blur', 'textarea, input[type=text]', function () {
            _self.textBoxFocus();
          });
    };
    
    this.buildMenu = function () {
        $('div').find(_objEl.join()).each(function () {
            if (location.href.includes('chatbox') && $(this).prop('id').includes('chatbox')) {
                return;
            }
            var menuTitle = $(this).data('title');
            var idBlock = $(this).data('id');
            var link = $(this).prop('href');
            if (typeof link !== 'undefined') {
                if (typeof idBlock == 'undefined') {
                    idBlock = $(this).prop('id');
                }
                if (typeof menuTitle == 'undefined') {
                    menuTitle = $(this).html();
                }
            }
            if (typeof menuTitle !== 'undefined' && typeof idBlock !== 'undefined') {
                _self.createMenu(menuTitle, idBlock, link);
            }
        });
        $(_self.properties.mobileMenu).slick({
            accessibility: false,
            dots: false,
            infinite: true,
            speed: 0,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: false,
            nextArrow: false,
            rtl: (site_rtl_settings === 'rtl') ? true : false
        });
    };

    this.createMenu = function (menuItem, idBlock, link) {
        if (link) {
            menuItem = '<a href="' + link + '">' + menuItem + '</a>';
        }
        $(_self.properties.mobileMenu).append('<div class="mobile-menu-item" data-id="' + idBlock + '">' + menuItem + '<s data-mblock-id="' + idBlock + '"></s></div>');
    };
    
    this.scrollToBlock = function (obj) {
        _self.scroll_top_fast = true;
        var idBlock = $(obj).data('id');
        var slideIndex = 0;
        if (idBlock != 'pjaxcontainer') {
            slideIndex = parseInt($(obj).index()) - 4;
        } else {
            slideIndex = parseInt($(obj).index()) - 3;
        }
        $('.mobile-menu-wrapper').slick('slickGoTo', slideIndex, true);
        $('html, body').animate({scrollTop: ($('#' + idBlock).offset().top - $('.main-inner-content').offset().top)}, 800);
    };
    
    this.scrollToTop = function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() == 0) {
                _self.scroll_top_fast = false;
            }
            if ($(this).scrollTop() > 150 && $(this).width() < 768) {
                if (_self.properties.tempScrollTop > $(this).scrollTop()) {
                    if (!_self.scroll_top_fast) {
                        if (!$(_self.properties.scrollToTop).is(':visible')) {
                            $(_self.properties.scrollToTop).fadeIn();
                        }
                    } else {
                        $(_self.properties.scrollToTop).fadeOut();
                    }
                    if ($('#cookie_policy_block').is(':visible')) {
                        $(_self.properties.scrollToTop).css('bottom', '0px');
                    }
                } else {
                    $(_self.properties.scrollToTop).fadeOut();
                }
            } else {
                $(_self.properties.scrollToTop).fadeOut();
            }
            _self.properties.tempScrollTop = $(this).scrollTop();
        });
    };
    
    this.textBoxFocus = function () {
        $(_self.properties.scrollToTop).fadeOut();
    };

    _self.Init(optionArr);

}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.mobileTopMenu = mobileTopMenu;
}
