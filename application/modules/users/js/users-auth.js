function UsersAuth(optionArr)
{
    'use strict';
    this.properties = {
        siteUrl: '/',
        loginBtnId: 'ajax_login_link',
        content: null,
    }

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);

        $(document)
                .off('click', '#' + _self.properties.loginBtnId).on('click', '#' + _self.properties.loginBtnId, function () {
                    _self.login();
                })
    }

    this.uninit = function () {
        return this;
    };

    this.login = function () {
        $.ajax({
            url: _self.properties.siteUrl + 'users/ajax_login_form',
            cache: false,
            dataType: 'html',
            success: function (data) {
                if (_self.properties.content == null) {
                    _self.properties.content = new loadingContent({loadBlockWidth: '500px', closeBtnClass: 'w', loadBlockTopType: 'bottom', loadBlockTopPoint: 20, blockBody: true, showAfterImagesLoad: false});
                }
                _self.properties.content.unsetLoadedBlock();
                _self.properties.content.show_load_block(data);
            }
        });
    }

    _self.Init(optionArr);

    return this;
}



if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.UsersAuth = UsersAuth;
}
