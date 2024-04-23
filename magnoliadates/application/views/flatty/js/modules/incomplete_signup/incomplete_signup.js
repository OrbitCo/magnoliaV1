function registerFormInput(optionArr)
{
    this.properties = {
        siteUrl: '',
        send_form_data: 'incomplete_signup/ajaxGetRegisterFormData/',
        timeout: 15000,
        intervalid: '',
        fieldsName: {
            user_type: 'data[user_type]',
            looking_user_type: 'data[looking_user_type]',
            email: 'data[email]',
            nickname: 'data[nickname]',
            birth_date: 'data[birth_date]',
            id_country: 'data[id_country]',
            id_region: 'data[id_region]',
            id_city: 'data[id_city]',
            fname: 'data[fname]',
            sname: 'data[sname]',
            user_logo: 'data[user_logo]'
        }
    };

    this.fields = {
        user_type: '',
        looking_user_type: '',
        email: '',
        nickname: '',
        birth_date: '',
        id_country: '',
        id_region: '',
        id_city: '',
        fname: '',
        sname: '',
        user_logo: ''
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.properties.intervalid = setInterval(function () {
            _self.fields.email = $("input[name='" + _self.properties.fieldsName.email + "']").val();
            if (_self.IsEmail(_self.fields.email)) {
                _self.fields.user_type = $("input[name='" + _self.properties.fieldsName.user_type + "']").val();
                _self.fields.looking_user_type = $("input[name='" + _self.properties.fieldsName.looking_user_type + "']").val();
                _self.fields.nickname = $("input[name='" + _self.properties.fieldsName.nickname + "']").val();
                _self.fields.birth_date = $("input[name='" + _self.properties.fieldsName.birth_date + "']").val();
                _self.fields.id_country = $("input[name='" + _self.properties.fieldsName.id_country + "']").val();
                _self.fields.id_region = $("input[name='" + _self.properties.fieldsName.id_region + "']").val();
                _self.fields.id_city = $("input[name='" + _self.properties.fieldsName.id_city + "']").val();
                _self.fields.fname = $("input[name='" + _self.properties.fieldsName.fname + "']").val();
                _self.fields.sname = $("input[name='" + _self.properties.fieldsName.sname + "']").val();
                _self.fields.user_logo = $("input[name='" + _self.properties.fieldsName.user_logo + "']").val();
                if (_self.fields.user_type === 'couple') {
                    _self.fields.nickname_couple = $("input[name='data[nickname_couple]']").val();
                    _self.fields.birth_date_couple = $("input[name='data[birth_date_couple]']").val();
                }
                $.ajax({
                    url: _self.properties.siteUrl + _self.properties.send_form_data,
                    type: 'POST',
                    data: {'data_fields': _self.fields},
                    cache: false
                });
            }
            return false;
        }, _self.properties.timeout);
    };

    this.IsEmail = function (email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    };

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.registerFormInput = registerFormInput;
}
