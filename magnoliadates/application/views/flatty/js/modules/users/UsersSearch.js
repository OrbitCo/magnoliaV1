function UsersSearch(optionArr)
{
    'use strict';
    this.properties = {
        siteUrl: '/',
        loadOnScroll: true,
        sort: 'date_created',
        users: {
            countAll: null,
            countPage: null
        },
        page: {
            count: 1,
            previous: 0,
            current: 1,
            next: 2
        },
        scrollPage:{},
        id: {
            mainUsersResults: '#main_users_results',
            formButton: '#main_search_button',
            formId: '#main_search_form'
        },
        dataAction: {
            showMore: '[data-action="show-more"]',
            showPrevious: '[data-action="show-previous"]',
            sortBy: '[data-action="sort-by"]',
            sendSearchForm: '[data-action="send_search_form"]',
            setPage: '[data-action="set-page"]',
            scrollToTop: '[data-action="scroll-to-top"]'
        },
        url: {
            search: 'users/search/',
            ajaxSearch: 'users/ajax_search/search/',
            ajaxLoadUsers: 'users/ajaxLoadUsers/'
        },
        langs: {},
        tempScrollTop: 0
    };

    var _self = this;
    var _temp = {
        lastUrl: null
    };

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
        _self.scrollPage();
    };
    
    this.uninit = function () {
        $(document)
                .off('click', _self.properties.dataAction.showMore)
                .off('click', _self.properties.dataAction.showPrevious)
                .off('click', _self.properties.dataAction.sortBy)
                .off('click', _self.properties.dataAction.scrollToTop);
        return this;
    };

    this.initControls = function () {
        $(document)
                .off('click', _self.properties.dataAction.showMore).on('click', _self.properties.dataAction.showMore, function () {
                    _self.getUsers($(this), 'next');
                }).off('click', _self.properties.dataAction.showPrevious).on('click', _self.properties.dataAction.showPrevious, function () {
                    _self.getUsers($(this), 'previous');
                }).off('click', _self.properties.dataAction.sortBy).on('click', _self.properties.dataAction.sortBy, function () {
                    _self.sortUsers($(this));
                }).off('click', _self.properties.dataAction.scrollToTop).on('click', _self.properties.dataAction.scrollToTop, function () {
                    $('html, body').animate({ scrollTop: 0 }, "slow");
                });
    };

    this.getUsers = function (obj, dir) {
        obj.closest('.tac').remove();
        var hide_dir = 'next';
        if (dir === 'next') {
            hide_dir = 'previous';
            _self.properties.page[dir] = _self.properties.page.next;
        } else {
            _self.properties.page[dir] = _self.properties.page.previous;
        }
        _self.query(
                _self.properties.url.ajaxLoadUsers + _self.properties.sort,
                {page: _self.properties.page[dir], hide_dir: hide_dir},
                'json',
                function (data) {
                    if (data.content) {
                        if (dir === 'next') {
                            $(_self.properties.id.mainUsersResults).append(data.content);
                            _self.properties.page.current = _self.properties.page.next;
                            _self.properties.page.next = _self.properties.page.next +1;
                        } else {
                            window.history.pushState(null, null, _self.properties.siteUrl + _self.properties.url.search+_self.properties.sort+'/desc/'+_self.properties.page[dir]);
                            _self.properties.page.current = _self.properties.page.previous;
                            _self.properties.page.previous = _self.properties.page.previous - 1;
                            $(_self.properties.id.mainUsersResults).prepend(data.content);
                            _self.scrollPage();
                        }
                        _self.properties.scrollPage[_self.properties.page.current] = $('[data-page="'+_self.properties.page.current+'"]').offset().top;
                        $('html, body').animate({ scrollTop: _self.properties.scrollPage[_self.properties.page.current] - 150}, "slow");
                    } else {
                        $(_self.properties.id.mainUsersResults).append(_self.properties.langs.usersNotFound);
                    }
                }
        );
    };
    
    this.sortUsers = function (sort) {
        $(_self.properties.dataAction.sortBy).removeClass('active');
        sort.addClass('active');
        _self.resetPage();
        _self.properties.sort = sort.data('sort');
        window.history.pushState(null, null, _self.properties.siteUrl + _self.properties.url.search +_self.properties.sort + '/desc/' + _self.properties.page.current);
        _self.query(
                _self.properties.url.ajaxSearch + 'search/' + _self.properties.sort + '/desc/' + _self.properties.page.current,
                {},
                'html',
                function (data) {
                    $(_self.properties.id.mainUsersResults).html(data);
                }
        );
    };
    
    this.resetPage = function () {
        _self.properties.page.previous = 0;
        _self.properties.page.current = 1;
        _self.properties.page.next = 2;
    };
    
    this.reset = function () {
        _self.resetPage();
        window.history.pushState(null, null, _self.properties.siteUrl + _self.properties.url.search);
    };
    
    this.scrollPage = function () {
        var lastScrollTop = 0;
        _self.properties.scrollPage = {};
        $(_self.properties.dataAction.setPage).each(function (i, element) {
            _self.properties.scrollPage[$(element).data('page')] = $(element).offset().top;
        });
        window.addEventListener("popstate", function (e) {
            if (window.location.href.indexOf(_self.properties.siteUrl+ 'users/search') !== -1) {
                locationHref(window.location.href);
            }
        });
        if (window.location.href.indexOf(_self.properties.siteUrl+ 'users/search') !== -1) {
            $(window).scroll(function () {
                 var offsetPage = $(this).scrollTop();
                if (lastScrollTop < offsetPage) {
                    if (_self.properties.scrollPage[_self.properties.page.current] < offsetPage && _self.properties.scrollPage[_self.properties.page.current+1] > offsetPage) {
                        _self.properties.page.current = _self.properties.page.current+1;
                    }
                } else if (lastScrollTop > offsetPage) {
                    if (_self.properties.scrollPage[_self.properties.page.current]  > offsetPage && _self.properties.scrollPage[_self.properties.page.current-1]  < offsetPage) {
                        _self.properties.page.current = _self.properties.page.current-1;
                    }
                }
                if (window.location.href.indexOf(_self.properties.siteUrl+ 'users/search') > -1) {
                    if (_temp.lastUrl !== _self.properties.siteUrl +  'users/search/' +_self.properties.sort + '/desc/' + _self.properties.page.current) {
                        _temp.lastUrl = _self.properties.siteUrl +  'users/search/' +_self.properties.sort + '/desc/' + _self.properties.page.current;
                         window.history.pushState(null, null, _temp.lastUrl);
                    }
                }
                 lastScrollTop = offsetPage;
                 _self.scrollToTop(offsetPage);
            });
        }
    };
    
    this.scrollToTop = function (offsetPage) {
        if (offsetPage > 150) {
            $(_self.properties.dataAction.scrollToTop).fadeIn("fast");
        } else {
            $(_self.properties.dataAction.scrollToTop).fadeOut("fast");
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
                if (typeof (data.error) !== 'undefined' && data.error.length !== 0) {
                    _self.properties.errorObj.show_error_block(data.error, 'error');
                }
                if (typeof (data.info) !== 'undefined' && data.info.length !== 0) {
                    _self.properties.errorObj.show_error_block(data.info, 'info');
                }
                if (typeof (data.success) !== 'undefined' && data.success.length !== 0) {
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
    
    return this;

};


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.UsersSearch = UsersSearch;
}
