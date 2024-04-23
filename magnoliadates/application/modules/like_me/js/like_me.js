"use strict";
function LikeMe(optionArr)
{

    this.properties = {
        id: 'like_me',
        siteUrl: '',
        likeBlockId: 'like_me-block',
        action_id: 'play_global',
        main_id: 'action-block',
        skip_button_id: 'skip_button',
        like_button_id: 'like_button',
        watch_button_id: 'go-watch_again',
        search_button_id: 'go-search',
        perfect_button_id: 'go-perfect',
        congratulations_id: 'congratulations',
        action_button_block_id: 'action-button',
        keep_playing_button_id: 'keep_playing',
        match_block_id: 'match_block',
        like_me_btn_class: 'like_me-btn',
        id_user: 0,
        min_id: 0,
        last_profile_id: 0,
        get_users_url: 'like_me/ajaxGetUsers',
        set_action_url: 'like_me/ajaxPlayAction',
        congratulations_url: 'like_me/ajaxCongratulations',
        contact_user_url: 'like_me/ajaxContactUser',
        common_ancestor: 'body',
        gotIt: '[data-action="go"]',
        goSearch: '[data-action="search"]',
        langs: {},
        isRegistr: 0,
        isFlippingProfiles: 0,
        class: {
            skip: '.likemecontrols__item_skip'
        },
        data: {
            action: {
                closeBlock: '[data-action="close-block"]'
            }
        },
        windowObj: null,
    };

    var _self = this;
    var _temp_obj = {};

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.init_controls();
        _self.properties.last_profile_id = lightGetCookie('exclude_user_id')
        _self.loadUsers(_self.properties.action_id, 0);
        if (!_self.properties.windowObj) {
            _self.properties.windowObj = new loadingContent({
                loadBlockWidth: '400px',
                closeBtnClass: 'w',
                loadBlockTopType: 'top',
                loadBlockTopPoint: 20,
                blockBody: true,
                showAfterImagesLoad: false
            });
        }
        _self.changeHeader(_self.properties.last_profile_id);
    };

    this.uninit = function () {
        $(_self.properties.common_ancestor)
                .off('click', '#' + _self.properties.skip_button_id)
                .off('click', '#' + _self.properties.like_button_id)
                .off('click', '#' + _self.properties.watch_button_id)
                .off('click', '#' + _self.properties.search_button_id)
                .off('click', '#' + _self.properties.perfect_button_id)
                .off('click', '#' + _self.properties.keep_playing_button_id)
                .off('click', '.' + _self.properties.like_me_btn_class)
                .off('click', '.' + _self.properties.gotIt)
                .off('click', '.' + _self.properties.goSearch);
        return this;
    };

    this.init_controls = function () {
        $(_self.properties.common_ancestor)
                .off('click', '#' + _self.properties.skip_button_id).on('click', '#' + _self.properties.skip_button_id, function () {
                    _self.playAction('skip');
                }).off('click', '#' + _self.properties.like_button_id).on('click', '#' + _self.properties.like_button_id, function () {
                    _self.playAction($(this).attr('data-action'));
                }).off('click', '#' + _self.properties.watch_button_id).on('click', '#' + _self.properties.watch_button_id, function () {
                    _self.loadUsers(_self.properties.action_id, 1);
                }).off('click', '#' + _self.properties.search_button_id).on('click', '#' + _self.properties.search_button_id, function () {
                    _self.exitLikeMe('users/search');
                }).off('click', '#' + _self.properties.perfect_button_id).on('click', '#' + _self.properties.perfect_button_id, function () {
                    _self.exitLikeMe('perfect_match/index');
                }).off('click', '#' + _self.properties.keep_playing_button_id).on('click', '#' + _self.properties.keep_playing_button_id, function (event) {
                    _self.playAction($(this).data('action'));
                }).off('click', '.' + _self.properties.like_me_btn_class).on('click', '.' + _self.properties.like_me_btn_class, function () {
                    _self.deleteMatchBlock(500);
                }).off('click', _self.properties.gotIt).on('click', _self.properties.gotIt, function () {
                    _self.properties.windowObj.hide_load_block();
                }).off('click', _self.properties.goSearch).on('click', _self.properties.goSearch, function () {
                    _self.exitLikeMe('users/search');
                }).off('click', _self.properties.data.action.closeBlock).on('click', _self.properties.data.action.closeBlock, function () {
                    $('#' + _self.properties.like_button_id).remove();
                });
    };

    this.loadUsers = function (id, reload) {
        if (id == "matches") {
            $("body").addClass("mod-likeme-matches");
        }
        let postData = {type: id, reload: reload}
        let isReload = _self.isReloadCongratulationsNotice()
        if (isReload === true) {
            postData.exclude_user_id = _self.properties.last_profile_id;
        }
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: _self.properties.siteUrl + _self.properties.get_users_url,
            data: postData,
            success: function (data) {
                if (typeof data.html !== 'undefined') {
                    data.html = _self.addJSParams(data.html);
                    $('#' + _self.properties.main_id).html(data.html);
                    if (isReload === true) {
                        _self.congratulationsNotice(_self.properties.last_profile_id);
                        lightSetCookie('exclude_user_id', 0);
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
        });
    };

    this.isReloadCongratulationsNotice = function () {
        let isReload = false
        if (document.referrer.match(new RegExp('access_permissions')) && _self.properties.last_profile_id > 0) {
            isReload = true
        }
        return isReload
    }

    this.playAction = function (action) {
        var profile_id = $("[data-profile_id]").data('profile_id');
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: _self.properties.siteUrl + _self.properties.set_action_url,
            data: {type: _self.properties.action_id, action: action, profile_id: profile_id},
            success: function (data) {

                if (typeof data.info.access_denied !== 'undefined' && data.info.access_denied.length > 0) {
                    _self.properties.windowObj
                      .show_load_block(data.info.access_denied);
                    return false;
                } else {
                    if (_self.properties.isFlippingProfiles === 1) {
                        _self.deleteMatchBlock(0);
                    }
                    if (typeof data.html === 'undefined') {
                        lightSetCookie('exclude_user_id', profile_id);
                        _self.congratulationsNotice(profile_id);
                    } else {
                        if (_self.properties.isFlippingProfiles === 1) {
                            locationHref($(_self.properties.class.skip).attr('href'));
                        } else {
                            $('#' + _self.properties.main_id).html(data.html);
                            if (action === 'skip') {
                                _self.properties.windowObj.hide_load_block();
                            }
                        }
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
        });
    };

    this.congratulationsNotice = function (profile_id) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: _self.properties.siteUrl + _self.properties.congratulations_url,
            data: {profile_id: profile_id},
            success: function (data) {
                _self.rebuildStyleCss(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            },
        });
    };

    this.imgHeight = function () {
        if (typeof _temp_obj.img_height === 'undefined') {
            _temp_obj.img_height = parseInt($(window).height() - $("header").height() - $(".pre-main-inner-content").height());
        }
        return _temp_obj.img_height;
    };

    this.imgWidth = function () {
        if (typeof _temp_obj.img_height === 'undefined') {
            _temp_obj.img_height = parseInt($(window).width()) * 70 / 100;
        }
        return _temp_obj.img_height;
    };

    this.exitLikeMe = function (section) {
        locationHref(_self.properties.siteUrl + section);
    };

    this.rebuildStyleCss = function (data) {
        $('#' + _self.properties.like_button_id)
          .toggleClass('likemecontrols__item_like')
          .toggleClass('likemecontrols__item_liked');

        if ($('#' + _self.properties.like_button_id).attr('data-action') == 'like'){
          $('#' + _self.properties.like_button_id).attr('data-action','unlike')
        }else {
          $('#' + _self.properties.like_button_id).attr('data-action','like')
        }


      let promise = new Promise((resolve) => {
        _self.properties.windowObj.changeTemplate('default');
        _self.properties.windowObj.update_css_styles({width: '400px'});
        setTimeout(() => {
          resolve();
        }, 1000);
      });

      promise
        .then(
          () => {
            _self.properties.windowObj.show_load_block(data);
            $('#' + _self.properties.match_block_id).html(data);
          }
        );


        $('.' + _self.properties.like_me_btn_class).css('display', 'block');
        $('.' + _self.properties.like_me_btn_class).find('button').eq(1).hide();
    };

    this.deleteMatchBlock = function (time) {
        if (time === 0) {
            _self.properties.windowObj.hide_load_block();
        } else {
            setTimeout(function () {
                _self.properties.windowObj.hide_load_block();
            }, time);
        }
    };

    this.changeHeader = function () {
        var width = $(window).width();
        var display = (width < 768) ? 'none' : 'block';
        $('header').css('display', display);
        $(window).resize(function () {
            width = $(this).width();
            display = (width < 768) ? 'none' : 'block';
            $('header').css('display', display);
        });
        if (_self.properties.isRegistr === 1) {
            var htmlObj = '<div class="register-header">' + _self.properties.langs.header + '</div>\n\
                <div class="register-actions">\n\
                    <button class="btn btn-primary btn-lg" data-action="go">' + _self.properties.langs.gotItBtn + '</button>\n\
                    <button class="btn btn-primary-inverted btn-lg" data-action="search">' + _self.properties.langs.searchBtn + '</button>\n\
                </div>';
            _self.properties.windowObj.show_load_block(htmlObj);
        }
    };

    this.escapeRegExp = function (str) {
        return str.replace(/[]/g, "\\$&");
    };

    this.addJSParams = function (data) {
        var str = 'siteUrl: site_url,';
        var reg = new RegExp(_self.escapeRegExp(str).replace(/[]/g, '|'), 'gi');
        return data.replace(reg, '$&' + ' singleton: 0,');
    };

    _self.Init(optionArr);

}
;

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.LikeMe = LikeMe;
}
