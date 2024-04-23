'use strict';
function UsersFieldsValidation(optionArr)
{

    this.properties = {
        siteUrl: '/',
        objBtnDisabled: false,
        url: {
            validation: 'users/fieldValidation/'
        },
        ages: {},
        langs: {},
        rules: {},
        fields: {},
        data: {
            actionValidationChange: '[data-action="validation"]:checkbox',
            actionValidationFocus: '[data-action="validation"]:not(checkbox)',
            actionValidationClick: 'li[data-action="validation"]',
            actionValidationKeyUp: '[data-action="validation-keyup"]'
        },
        class: {
            status: {
                success: 'has-success',
                warning: 'has-warning',
                error: 'has-error'
            }
        },
        errorObj: new Errors(),
        method: {
            email: function (data) {
                _self.emailValidation(data);
            },
            password: function (data) {
                _self.passwordValidation(data);
            },
            nickname: function () {
                _self.nicknameValidation();
            },
            birth_date: function () {
                _self.birthDateValidation();
            },
            confirmation: function (data) {
                _self.confirmationValidation(data);
            }
        }
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
        _self.setData();
    };

    this.initControls = function () {
        $(document)
                .off('focusout', _self.properties.data.actionValidationFocus).on('focusout', _self.properties.data.actionValidationFocus, function () {
                    _self.fieldValidation(this);
                }).off('change', _self.properties.data.actionValidationChange).on('change', _self.properties.data.actionValidationChange, function () {
                    _self.fieldValidation(this);
                }).off('click', _self.properties.data.actionValidationClick).on('click', _self.properties.data.actionValidationClick, function () {
                    _self.fieldValidation(this);
                }).off('keyup', _self.properties.data.actionValidationKeyUp).on('keyup', _self.properties.data.actionValidationKeyUp, function () {
                    _self.fieldValidation(this);
                });
    };

    this.setData = function () {
        for (var field in _self.properties.fields) {
            _self.properties.data[field + 'Field'] = '[data-field="' + field + '"]';
        }
    };

    this.fieldValidation = function (item, status_class) {
        if (typeof _self.properties.method[$(item).data('field')] !== 'undefined') {
            return _self.properties.method[$(item).data('field')](status_class);
        }
    };

    this.emailValidation = function (status_class) {
        var val = $(_self.properties.data.emailField).val();
        if (_self.properties.rules.email.test(val)) {
            _self.query(
                    _self.properties.url.validation,
                    {data: {field: 'email', value: val}},
                    'json',
                    function (data) {
                        _self.isValidate(
                            'email',
                            data.error.email
                        );
                    }
            );
        } else {
            _self.isValidate(
                'email',
                _self.properties.langs.errors.email,
                status_class
            );
        }
    };

    this.confirmationValidation = function () {
        var val = ($(_self.properties.data.confirmationField).prop('checked') === true) ? 1 : 0;
        if (_self.properties.rules.confirmation.test(val)) {
            _self.isValidate('confirmation');
        } else {
            _self.isValidate(
                'confirmation',
                _self.properties.langs.errors.confirmation
            );
        }
        return this;
    };
    
    this.nicknameValidation = function () {
        var val = $(_self.properties.data.nicknameField).val();
        if (_self.properties.rules.nickname.test(val)) {
            _self.query(
                    _self.properties.url.validation,
                    {data: {field: 'nickname', value: val}},
                    'json',
                    function (data) {
                        _self.isValidate(
                            'nickname',
                            data.error.nickname
                        );
                    }
            );
        } else {
            _self.isValidate(
                'nickname',
                _self.properties.langs.errors.nickname
            );
        }
    };

    this.passwordValidation = function (status_class) {
        var val = $(_self.properties.data.passwordField).val();
        if (_self.properties.rules.password.test(val)) {
            _self.query(
                    _self.properties.url.validation,
                    {data: {field: 'password', value: val}},
                    'json',
                    function (data) {
                        _self.isValidate(
                            'password',
                            data.error.password
                        );
                    }
            );
        } else {
            _self.isValidate(
                'password',
                _self.properties.langs.errors.password,
                status_class
            );
        }
    };
    
    this.birthDateValidation = function () {
        var val = $('#birth_date').val();
        var age = _self.birthDateToAge(val);
        if (age >= _self.properties.ages.age_min || age <= _self.properties.ages.age_max) {
            _self.query(
                    _self.properties.url.validation,
                    {data: {field: 'birth_date', value: val}},
                    'json',
                    function (data) {
                        _self.isValidate(
                            'birth_date',
                            data.error.birth_date
                        );
                    }
            );
        } else {
            var errorInfo = _self.properties.langs.errors.birth_date.replace('[min_age]', _self.properties.ages.age_min);
            errorInfo = errorInfo.replace('[max_age]', _self.properties.ages.age_max);
            _self.isValidate(
                'birth_date',
                errorInfo
            );
        }
    };
    
    this.birthDateToAge = function (data) {
        var n = new Date();
        var b = new Date(data),
        age = n.getFullYear() - b.getFullYear();
        return n.setFullYear(1972) < b.setFullYear(1972) ? age - 1 : age;
    };

    this.isValidate = function (field, data, status_class) {
        _self.properties.fields[field] = false;
        $(_self.properties.data[field + 'Field']).next('.tooltip').remove();
        if (typeof (data) !== 'undefined' && data !== 0) {
            $(_self.properties.data[field + 'Field']).after(function () {
                return  '<div class="tooltip">' + data + '</div>';
            }).closest('div')
                    .removeClass(_self.properties.class.status.success)
                    .addClass(function () {
                        if (typeof status_class === 'undefined') {
                             return _self.properties.class.status.error;
                        }
                    });
        } else {
            _self.properties.fields[field] = true;
            $(_self.properties.data[field + 'Field']).closest('div')
                    .removeClass(_self.properties.class.status.error)
                    .addClass(_self.properties.class.status.success);
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
                if (typeof (cb) !== 'undefined') {
                    cb(data);
                }
            }
        });
        return false;
    };

    _self.Init(optionArr);
    
    return this;

}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.UsersFieldsValidation = UsersFieldsValidation;
}
