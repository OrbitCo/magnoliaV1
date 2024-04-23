/* global autoloc_obj, Storage */
function UsersRegistration(optionArr)
{
    'use strict';
    this.properties = {
        siteUrl: '/',
        id: {
            firstRegistrationPage: '#first-registration-page',
            secondRegistrationPage: '#second-registration-page',
            thirdRegistrationPage: '#third-registration-page',
            fourthRegistrationPage: '#fourth-registration-page',
            email: '#email',
            password: '#password',
            nickname: '#nickname',
            birthDate: '#birth_date',
            gRecaptchaResponse: '#g-recaptcha-response',
            mainMenuContainer: '#main-menu-container',
            bottomBtns: '#bottom-btns',
            pjaxContainer: '#pjaxcontainer',
            datepicker: '#datepicker',
            staticAlertBlock: '#static-alert-block',
            termsAndConditions: '#terms_and_conditions',
            privacyAndSecurity: '#privacy_and_security'
        },
        name: {
            idCountry: 'input[name="id_country"]',
            idRegion: 'input[name="id_region"]',
            idCity: 'input[name="id_city"]',
            lat: 'input[name="lat"]',
            lon: 'input[name="lon"]',
            confirmation: 'input[name="confirmation"]'
        },
        class: {
            registrationBlock: '.registration-block',
            mainBlockPages: '.main-block-pages',
            preMainInnerContent: '.pre-main-inner-content',
            header: '.b-header__topline',
            afterheader: '.b-afterheader',
            features: '.b-features',
            mobile: '.b-mobile',
            footer: '.b-footer',
            pageWraper: '.pages-wraper',
            dropdownLocation: '.dropdown_location'
        },
        data: {
            buttonTypeI: '[data-button_type="i"]',
            buttonTypeLook: '[data-button_type="look"]',
            blockPages: '[data-block="pages"]',
            UserTypeI: '[data-user_type="i"]',
            UserTypeLook: '[data-user_type="look"]',
            selectDay: '[data-handler="selectDay"]',
            selectMonth: '[data-handler="selectMonth"]',
            selectYear: '[data-handler="selectYear"]'
        },
        dataAction: {
            nextPage: '[data-action="next-page"]',
            prevPage: '[data-action="prev-page"]',
            setPage: '[data-action="set-page"]',
            userType: '[data-action="user-type"] li',
            updateProfile: '[data-action="update-profile"]',
            rebuildView: '[data-action="rebuild-view"]',
            showRegistrationBlock: '[data-action="show-registration-block"]'
        },
        url: {
            registration: 'users/registration/',
            photoUpload: 'users/photoUpload/',
            quickPage: 'content/quickPage'
        },
        langs: {},
        user: {},
        errors: {},
        dateFormat: 'yy-mm-dd',
        pages: 4,
        pageBlock: 1,
        isAuth: 0,
        isLink: 0,
        timeout_obj: null,
        timeout: 500,
        errorObj: new Errors(),
        isCouple: false,
        simpleRegPage: false,
        isRegistration: 0,
        usersFieldsValidation: null,
        contentObj: new loadingContent({
            loadBlockWidth: '800px', closeBtnClass: 'w', loadBlockTopType: 'top', loadBlockTopPoint: 20, blockBody: true
        })

    };

    var _self = this;
    var formData = {};
    var fields = {
        1: ['user_type', 'looking_user_type'],
        2: ['email', 'password', 'confirmation'],
        3: ['nickname', 'birth_date', 'captcha_confirmation', 'nickname_couple', 'birth_date_couple']
    };

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
        _self.getPage();
        if (_self.properties.isLink !== 1 && _self.properties.isRegistration !== 1 ) {
            _self.setPage(_self.properties.pageBlock);
            _self.render();
        }
        if (_self.properties.isRegistration === 1 ) {
            _self.showRegistrationBlock();
        }
    };

    this.initControls = function () {
        $(document)
        .off('click', _self.properties.dataAction.userType).on('click', _self.properties.dataAction.userType, function () {
            _self.setUserType(this, true);
        }).off('click', _self.properties.dataAction.nextPage).on('click', _self.properties.dataAction.nextPage, function () {
            _self.navigatingPages(this);
        }).off('click', _self.properties.dataAction.prevPage).on('click', _self.properties.dataAction.prevPage, function () {
            _self.navigatingPages(this);
        }).off('click', _self.properties.dataAction.setPage).on('click', _self.properties.dataAction.setPage, function () {
            _self.navigatingPages(this);
        }).off('click', _self.properties.dataAction.updateProfile).on('click', _self.properties.dataAction.updateProfile, function (e) {
            _self.sendData(e);
        }).off('click', _self.properties.id.termsAndConditions).on('click', _self.properties.id.termsAndConditions, function () {
            _self.quickPage(this);
        }).off('click', _self.properties.id.privacyAndSecurity).on('click', _self.properties.id.privacyAndSecurity, function () {
            _self.quickPage(this);
        }).off('click', _self.properties.dataAction.showRegistrationBlock).on('click', _self.properties.dataAction.showRegistrationBlock, function () {
            _self.showRegistrationBlock();
        }).off('click', _self.properties.class.pageWraper).on('click', _self.properties.class.pageWraper, function (e) {
            if (($(e.target).data('block') !== "pages") || ($(e.target).data('act') !== 'close') || _self.properties.isRegistration === 1) {
                return;
            }
            _self.hideRegistrationBlock();
        });
    };

    this.render = function () {
        $(_self.properties.class.registrationBlock).find('input:not([type="checkbox"])').addClass('input-lg');
    };

    this.navigatingPages = function (obj) {
        var page = parseInt($(obj).data('page'));

        for (var key in fields[page]) {
            if (_self.properties.usersFieldsValidation) {
                if (_self.properties.usersFieldsValidation.properties.fields[fields[page][key]] === false) {
                    if (page == 2 && $(obj).data('action') == 'next-page') {
                        $('#' + fields[page][key]).focusout();
                        $('#' + fields[page][key]).focus();
                    }

                    if (page == 2 && $(obj).data('action') == 'set-page') {
                    } else {
                        return false;
                    }
                }
            }
        }

        if ($(obj).data('action') === 'next-page' && 0 < page < _self.properties.pages) {
            page++;
        } else if ($(obj).data('action') === 'prev-page' && 1 < page <= _self.properties.pages) {
            page--;
        }
        $(_self.properties.data.blockPages).addClass('hide');

        _self.setPage(page);
    };

    this.getPage = function () {
        if (_self.properties.errors !== null && _self.properties.usersFieldsValidation) {
            var methods = _self.properties.usersFieldsValidation.properties.method;

            for (var validateMethod in methods) {
                methods[validateMethod]();
            }
            var count_err = Object.keys(_self.properties.errors).length;
            var curpage = 1;
            for (var field in _self.properties.errors) {
                for (var page in fields) {
                    if ($.inArray(field, fields[page]) != -1) {
                        if (curpage == page) {
                            _self.properties.pageBlock = curpage;
                        }
                        if (curpage > page) {
                            _self.properties.pageBlock = page;
                        }
                        if (curpage < page) {
                            _self.properties.pageBlock = curpage;
                        }
                        if (count_err == 1) {
                            _self.properties.pageBlock = page;
                        }
                            curpage = page;
                    }
                }
            }
        }
    };

    this.setPage = function (p) {
        var page = parseInt(p);
        _self.properties.pageBlock = page;
        switch (page) {
            case 1:
                _self.firstPage();
                break;
            case 2:
                _self.secondPage();
                break;
            case 3:
                _self.thirdPage();
                break;
            case 4:
                _self.fourthPage();
                break;
        }
    };

    this.changePaginator = function (page) {
        if (_self.properties.user.isAuth === '0') {
            var htmlObj = '<div class="paginator">';
            for (var i = 1; i <= _self.properties.pages; i++) {
                if (i === page) {
                    htmlObj += '<i class="fa fa-circle active" data-action="set-page" data-page="' + i + '"></i>';
                } else if (i < page) {
                    htmlObj += '<i class="fa fa-circle" data-action="set-page" data-page="' + i + '"></i>';
                } else {
                    if (_self.properties.isAuth !== 0) {
                        htmlObj += '<i class="far fa-circle" data-page="' + i + '" data-action="set-page"></i>';
                    } else {
                        htmlObj += '<i class="far fa-circle" data-page="' + i + '"></i>';
                    }
                }
            }
            htmlObj += '</div>';
            return htmlObj;
        }
    };

    this.firstPage = function () {
        if ($(window).width() < 768 ) {
            $('body').css('position', 'inherit');
        }
        $('body').css('overflow-y', 'auto');

        $(_self.properties.id.firstRegistrationPage).removeClass('hide');
        if (_self.properties.isLink === 1 || _self.properties.isRegistration === 1) {
            $(_self.properties.class.mainBlockPages).removeClass('hide');
            $('body').css('overflow-y', 'hidden');
        } else {
            $(_self.properties.class.mainBlockPages).addClass('hide');
        }
        if (typeof (formData.user_type) === 'undefined') {
            _self.setUserType($(_self.properties.data.UserTypeI + ' li:eq(0)'), false);
        }
        if (typeof (formData.looking_user_type) === 'undefined') {
            var count_types =  $(_self.properties.data.UserTypeLook + ' li').length;
            if (count_types > 1) {
                _self.setUserType($(_self.properties.data.UserTypeLook + ' li:eq(1)'), false);
            } else if (count_types === 1) {
                _self.setUserType($(_self.properties.data.UserTypeLook + ' li:eq(0)'), false);
            }
        }
        if ((_self.properties.isLink === 1 || _self.properties.isRegistration === 1) &&
                $(_self.properties.id.firstRegistrationPage).find('div').is('.paginator') === false) {
            _self.keyUpNextPage(_self.properties.dataAction.nextPage);
            if ($(window).width() < 768 ) {
                $('body').css('position', 'fixed');
            }
            $('body').css('overflow-y', 'hidden');
            $(_self.properties.class.mainBlockPages).removeClass('hide');
            $(_self.properties.id.firstRegistrationPage + '>div').prepend(
                _self.changePaginator(1)
            );
        }
    };

    this.secondPage = function () {
        if ($(window).width() < 768 ) {
            $('body').css('position', 'fixed');
        }
        $('body').css('overflow-y', 'hidden');
        $(_self.properties.id.secondRegistrationPage).removeClass('hide');
        $(_self.properties.class.mainBlockPages).removeClass('hide');
        if (_self.properties.timeout_obj) {
            clearTimeout(_self.properties.timeout_obj);
        }
        _self.properties.timeout_obj = setTimeout(function () {
            document.getElementById('email').addEventListener('input', function () {
                _self.properties.usersFieldsValidation.fieldValidation(this, 'info');
                return true;
            });
            document.getElementById('password').addEventListener('input', function () {
                _self.properties.usersFieldsValidation.fieldValidation(this, 'info');
                return true;
            });
            document.getElementById('confirmation').addEventListener('input', function () {
                _self.properties.usersFieldsValidation.fieldValidation(this, 'info');
                return true;
            });
        }, _self.properties.timeout);
        if ($(_self.properties.id.secondRegistrationPage).find('div').is('.paginator') === false) {
            if (_self.properties.isLink === 1 || _self.properties.isRegistration === 1) {
                $(_self.properties.id.secondRegistrationPage + '>div').prepend(
                    _self.changePaginator(2)
                );
            } else {
                $(_self.properties.id.secondRegistrationPage + '>div').prepend(
                    _self.changePaginator(2)
                );
            }
        }
        _self.keyUpNextPage(_self.properties.dataAction.nextPage);
    };

    this.thirdPage = function () {
        if (_self.properties.simpleRegPage) {
            _self.formatDPickerField('');
        } else {
            if ($(window).width() < 768 ) {
                $('body').css('position', 'fixed');
            }
            $('body').css('overflow-y', 'hidden');
            $(_self.properties.id.thirdRegistrationPage).removeClass('hide');
            $(_self.properties.class.mainBlockPages).removeClass('hide');
            if ($(_self.properties.id.thirdRegistrationPage).find('div').is('.paginator') === false) {
                if (_self.properties.isLink === 1) {
                    $(_self.properties.id.thirdRegistrationPage + '>div').prepend(
                        _self.changePaginator(3)
                    );
                } else {
                    $(_self.properties.id.thirdRegistrationPage + '>div').prepend(
                        _self.changePaginator(3)
                    );
                }
                _self.formatDPickerField('');
                _self.properties.usersFieldsValidation.birthDateValidation();
                _self.geoData();
                 _self.scaleCaptcha();
                 $(_self.properties.class.pageWraper).scroll(function () {
                    var top = $('input[name="region_name"]').offset().top + 45;
                    $(_self.properties.class.dropdownLocation).css('top', top);
                 });
                $(window).resize(function () {
                    var top = $('input[name="region_name"]').offset().top + 45;
                    var left = $('input[name="region_name"]').offset().left;
                    var width = $('input[name="region_name"]').closest('.input-autocomplete').width();
                    $(_self.properties.class.dropdownLocation).css({'top': top, 'left': left, 'width': width});
                    _self.scaleCaptcha();
                });
            }
        }
        _self.keyUpNextPage(_self.properties.dataAction.updateProfile);

    };

    this.fourthPage = function () {
        if (_self.properties.isAuth === 1) {
            $(_self.properties.id.pjaxcontainer).hide('overflow-y', 'hidden');
            $(_self.properties.id.fourthRegistrationPage).removeClass('hide');
            $(_self.properties.class.mainBlockPages).removeClass('hide');
            if ($(_self.properties.id.fourthRegistrationPage).find('div').is('.paginator') === false) {
                $(_self.properties.id.fourthRegistrationPage + '>div').prepend(
                    _self.changePaginator(4)
                );
            }
            $("#bottom-btns").addClass('hide');
            $("#pjaxcontainer").addClass("blur-page").find(".pjaxcontainer-inner").addClass("blur-it");
        } else {
            _self.thirdPage();
        }
    };

    this.sendData = function (e) {
        e.preventDefault();
        var isSend = true;
        for (var key in _self.properties.usersFieldsValidation.properties.fields) {
            if (_self.properties.usersFieldsValidation.properties.fields[key] === false) {
                _self.properties.usersFieldsValidation.fieldValidation(document.getElementById(key), 'info');
                isSend = false;
            }
        }
        if (isSend === true) {
            _self.query(
                _self.properties.url.registration,
                $(_self.properties.class.registrationBlock).find('form').serialize(),
                'json',
                function (data) {
                    if (typeof data.errors !== 'undefined' && data.errors.length > 0) {
                        if (typeof data.error.name !== 'undefined') {
                            _self.properties.usersFieldsValidation.fieldValidation(document.getElementById(data.error.name), 'info');
                        }
                    } else {
                        if (typeof data.redirect !== 'undefined') {
                            locationHref(data.redirect,true);
                        }
                    }
                }
            );
        }
    };

    this.setUserType = function (obj, change) {
        if ($(obj).closest('ul').data('user_type') === 'i') {
            if ($('input[name="data[user_type]"]').val() === '' || change === true) {
                $(_self.properties.data.buttonTypeI + '>span:first').text($(obj).text());
                formData.user_type = $(obj).data('type');
                $('input[name="data[user_type]"]').val($(obj).data('type'));
            }
        } else {
            if ($('input[name="data[looking_user_type]"]').val() === '' || change === true) {
                $(_self.properties.data.buttonTypeLook + '>span:first').text($(obj).text());
                formData.looking_user_type = $(obj).data('type');
                $('input[name="data[looking_user_type]"]').val($(obj).data('type'));
            }
        }
    };

    this.geoData = function () {
        if (navigator.geolocation && typeof (autoloc_obj) !== 'undefined') {
            navigator.geolocation.getCurrentPosition(function (position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                if (typeof (Storage) !== "undefined") {
                    var userLocation = latitude + ";" + longitude;
                    if (localStorage.getItem("userLocation") !== userLocation) {
                        localStorage.setItem("userLocation", userLocation);
                    }
                }
                autoloc_obj.identifyLocation();
            });
        }
    };

    this.formatDPickerField = function (postfix) {
        var now = new Date();
        var yr = (new Date(now.getFullYear() - _self.properties.user.age_max, 0, 1).getFullYear()) + ':' +
        (new Date(now.getFullYear() - _self.properties.user.age_min, 0, 1).getFullYear());
        $(_self.properties.id.datepicker + postfix).datepicker({
            dateFormat: _self.properties.dateFormat,
            changeYear: true,
            changeMonth: true,
            yearRange: yr
        });
        new DatepickerDropdownTemplate({
            setDate: _self.properties.user.setDate,
            dateFormat: _self.properties.user.dateFormat,
            inputName: 'data[birth_date' + postfix + ']',
            postfix: postfix,
            langs: {
                defaultDay: _self.properties.langs.defaultDay,
                defaultMonth: _self.properties.langs.defaultMonth,
                defaultYear: _self.properties.langs.defaultYear
            }
        });
        $(_self.properties.data.selectDay).attr({'data-field': 'birth_date' + postfix, 'data-action': 'validation'});
        $(_self.properties.data.selectMonth).attr({'data-field': 'birth_date' + postfix, 'data-action': 'validation'});
        $(_self.properties.data.selectYear).attr({'data-field': 'birth_date' + postfix, 'data-action': 'validation'});
    };

    this.quickPage = function (item) {
        _self.query(
            _self.properties.url.quickPage,
            {gid: $(item).data('gid')},
            'json',
            function (data) {
                _self.properties.contentObj.show_load_block(data.data);
                $('.load_content_bg').css('overflow-y', 'auto');
            }
        );
    };

    this.scaleCaptcha = function () {
        var reCaptchaWidth = 304;
        var containerWidth = $('.captcha-block>div').width();
        var captchaScale = containerWidth / reCaptchaWidth;
        $('.g-recaptcha').css({
            'transform':'scale(' + captchaScale + ', 1)'
         });
    };

    this.showRegistrationBlock = function () {
        if ($(_self.properties.dataAction.showRegistrationBlock).data('gotoform') == 1) {
            $('html, body').animate({
                scrollTop: $(_self.properties.id.firstRegistrationPage).offset().top + 'px'
            }, 'fast');
        }
        _self.setPage(_self.properties.pageBlock);
    };

    this.getFormData = function (field) {
        return formData[field];
    };

    this.hideRegistrationBlock = function () {
        $('body').css('overflow-y', 'auto');
        if (_self.properties.isLink === 1 || _self.properties.isRegistration === 1) {
            $(_self.properties.class.mainBlockPages).addClass('hide');
        } else {
            $(_self.properties.id.firstRegistrationPage).removeClass('hide');
            $(_self.properties.class.mainBlockPages).addClass('hide');
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

    this.keyUpNextPage = function (block) {
        $(document).keydown(function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                event.stopPropagation();

                $(block).each(function () {
                    if ($(this).is(":visible")) {
                        $(this).click();
                        return false;
                    }
                })

                return false;
            }
        });
    };
    _self.Init(optionArr);

    return this;

};

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.UsersRegistration = UsersRegistration;
}
