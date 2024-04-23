function GuidedSetup(optionArr)
{
    this.properties = {
        siteUrl: '',
        btnGuidePage: '#btn-guide_page',
        urlGetMainPage: 'admin/guided_setup/ajaxGetMain',
        urlGetGuidePage: 'admin/guided_setup/ajaxGetGuidePage',
        urlPageConfigure: 'admin/guided_setup/ajaxPageConfigure',
        navBlock: '.guided-navigation',
        currentPage: 'guided-current-page',
        guidedMenuId: null,
        useFrame: 1,
        frameName: '',
        frameObj: '',
        navScroll: {
            top: null,
            left: null,
        },
        navIndex: null,
        popoverObj: '',
        page_id: null,
        navHeight: '600px',
        contentHeight: '444px',
        errorObj: new Errors,
        contentObj: new loadingContent({
            loadBlockWidth: '50%',
            closeBtnClass: 'close_window',
            scroll: false,
            closeBtnPadding: 20,
            blockBody: true,
            loadBlockTopType: 'bottom',
            loadBlockSize: 'big',
            loadBlockLgClass: 'modal fade bs-example-modal-lg guided-popup'
        })
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);

        $(_self.properties.btnGuidePage).on('click', function () {
            _self.getMainPage();
        });
        $(document).on('click','#guided_close_page', function () {
          _self.properties.contentObj.hide_load_block();
        });
    };

    this.getMainPage = function () {
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.urlGetMainPage,
            type: 'POST',
            data: {
                'menu_id': _self.properties.guidedMenuId,
                'menu_gid': _self.properties.frameName,
                is_frame: _self.properties.useFrame,
            },
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.content) {
                    _self.properties.contentObj.show_load_block(data.content);
                    _self.properties.navHeight = $('#guided-navigation').css("height");
                    _self.properties.contentHeight = $('.iframe-block').css("height");
                    _self.setFrame();
                    _self.setNavigation();
                }
            }
        });
    }

    this.getGuidePage = function (page_id) {
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.urlGetGuidePage + '/' + page_id,
            type: 'POST',
            cache: false,
            dataType: 'html',
            success: function (data) {
                if (data) {
                    $('#guided_content').html(data);
                }
            }
        });
    }

    this.setFrame = function () {
        _self.properties.frameObj = $('iframe[name=' + _self.properties.frameName + ']');
        $(_self.properties.frameObj).load(function () {
            _self.loadFrame();
        });

        _self.setPopover();
    }

    this.setPopover = function () {
        _self.properties.popoverObj = $('#guided_popover');

        _self.properties.popoverObj.popover().on('shown.bs.popover', function () {
            $('#guided_popover_configure').off().on('click', function () {
                _self.closePopover();
                var page = $('[data-page_id="' + _self.properties.page_id + '"]');
                var is_configured = parseInt(page.attr('data-page_configured'));
                if (!is_configured) {
                    $.ajax({
                        url: _self.properties.siteUrl + _self.properties.urlPageConfigure + '/' + _self.properties.page_id,
                        type: 'POST',
                        cache: false,
                        dataType: 'json',
                        success: function (data) {
                            if (data.success) {
                                if (data.success) {
                                    _self.properties.errorObj.show_error_block(data.success, 'success');
                                }
                                page.children('.page-configured').removeClass('invisible hide');
                                page.attr('data-page_configured', "1");
                                $('#progress_text').text(data.progress_bar.text_setup_indicator);
                                $('#progress_value').width(data.progress_bar.percent + '%');
                            }
                        }
                    });
                }
            });

            $('#hide_guided_popover').off().on('click', function () {
                _self.closePopover();
            });
        });
    }

    this.setPopoverContent = function () {
        var content = $('#guided-navigation').children('li').eq(_self.properties.navIndex).children('.guided-description').html();
        content = $.trim(content);
        if (content) {
            $('#guided_popover').show();
        } else {
            $('#guided_popover').hide();
        }

        _self.properties.popoverObj.data('bs.popover').options.content = content;
    }

    this.showPopover = function () {
        if (_self.properties.popoverObj.data('bs.popover').options.content) {
            _self.properties.popoverObj.popover('show');
        }
    }

    this.closePopover = function () {
        _self.properties.popoverObj.popover('hide');
    }

    this.setNavigation = function () {
        _self.properties.page_id = $('.' + _self.properties.currentPage).attr('data-page_id');

        $('#guided-navigation').slimScroll({height: _self.properties.navHeight, allowPageScroll: true});

        if (!_self.properties.useFrame) {
            $('#guided_content').slimScroll({height: _self.properties.contentHeight, color: 'rgba(170, 170, 170, 0.4)'});
        }

        $(_self.properties.navBlock).on('click', 'li', function () {
            _self.closePopover();
            _self.hideFrameBlock();
            _self.showLoadingBlock();
            _self.setActiveNav(this);

            var page_link = $(this).attr('data-page_link');
            $('#guided_page_link').attr('href', page_link);

            var page_id = $(this).attr('data-page_id');
            _self.properties.page_id = page_id;

            if (_self.properties.useFrame) {
                $(_self.properties.frameObj).attr('src', page_link);
            } else {
                _self.getGuidePage(page_id);
            }
        });

        $('#guided_prev_page').off().on('click', function () {
            _self.goPrevPage();
        });

        $('#guided_next_page').off().on('click', function () {
            _self.goNextPage();
        });
    }

    this.setBeforeUnload = function () {
        var x = document.getElementById("guided_frame");
        var y = (x.contentWindow || x.contentDocument);
        $(y).off().on('unload', function () {
            _self.hideFrameBlock();
        });

    }

    this.setActiveNav = function (elem) {

        $(_self.properties.navBlock + ' > li').removeClass(_self.properties.currentPage);
        _self.properties.navIndex = $(elem).index();

        $(_self.properties.navBlock).each(function (index, block) {
            $(block).children('li').eq(_self.properties.navIndex).addClass(_self.properties.currentPage);
        });

        let current_page = $(elem).data('page_id');
        let first_page = 1;
        let last_page = $(_self.properties.navBlock + ' > li:last').data('page_id');

        if (current_page > first_page) {
          $('#guided_prev_page').removeClass('hide')
        } else {
          $('#guided_prev_page').addClass('hide')
        }
        if (current_page < last_page) {
          $('#guided_next_page').removeClass('hide')
          $('#guided_close_page').addClass('hide');
        } else {
          $('#guided_next_page').addClass('hide')
          $('#guided_close_page').removeClass('hide');
        }

        _self.scrollNavBlock();
    }

    this.loadFrame = function () {
        _self.setBeforeUnload();
        _self.setPopoverContent();

        var iframe = _self.properties.frameObj.contents();
        _self.formatFrame(iframe);

        _self.hideLoadingBlock();
        _self.showFrameBlock();

        $('html', iframe).addClass('customscrollbar');

        $('html', iframe).find('#btn-show-help').off('click').on('click',function(){
          if (!$(this).closest('.instruction-block').hasClass('popover_info')){
            $(this).closest('.instruction-block').addClass('popover_info');
          }
        });

        var page = $('[data-page_id="' + _self.properties.page_id + '"]');
        var is_configured = parseInt(page.attr('data-page_configured'));
        if (!is_configured) {
            _self.showPopover();
        }
    }

    this.formatFrame = function (iframe) {
        $('#top_nav, footer, .back', iframe).remove();

        //network
        $('.networkinkg-status', iframe).attr('target', '_blank');
    }

    this.scrollNavBlock = function () {
        $(_self.properties.navBlock).each(function (index, block) {

          let offsetHeight = block.querySelectorAll('li')[_self.properties.navIndex].offsetTop - 5; // 5 px отсупа с верху. (для красоты)

          $(block).animate({scrollTop: offsetHeight }, 500, 'swing',()=>{
            $(block).slimScroll({scrollTo: offsetHeight});
          });

        });
    }

    this.goPrevPage = function () {
        $('.' + _self.properties.currentPage).prev('li').click();
    }

    this.goNextPage = function () {
        $('.' + _self.properties.currentPage).next('li').click();
    }

    this.showLoadingBlock = function () {
        if (_self.properties.useFrame) {
            $('#guided_loading_block').show();
        }
    }

    this.hideLoadingBlock = function () {
        $('#guided_loading_block').hide();
    }

    this.hideFrameBlock = function () {
        $(_self.properties.frameObj).css('visibility', 'hidden');
    }

    this.showFrameBlock = function () {
        $(_self.properties.frameObj).css('visibility', 'visible');
    }

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.GuidedSetup = GuidedSetup;
}
