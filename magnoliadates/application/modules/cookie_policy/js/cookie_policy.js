function cookiePolicy(optionArr)
{
    this.properties = {
        siteUrl: '',
        blockId: 'cookie_policy_block',
        linkId: 'cookie_policy_link',
        closeId: 'cookie_policy_close',
        name: 'cookie_policy',
        expires: 604800,
        path: '/',
        domain: '',
        secure: false,
    };

    const _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);

        if (typeof _self.properties.expires == "number" && _self.properties.expires) {
            var d = new Date();
            d.setTime(d.getTime() + _self.properties.expires * 1000);
            _self.properties.expires = _self.properties.expires = d;
        }
        if (_self.properties.expires && _self.properties.expires.toUTCString) {
            _self.properties.expires = _self.properties.expires.toUTCString();
        }

        $(document)
            .off('click', '#' + _self.properties.linkId).on('click', '#' + _self.properties.linkId, function () {
                _self.set_cookie();
            }).off('click', '#' + _self.properties.closeId).on('click', '#' + _self.properties.closeId, function () {
                _self.set_cookie();
            });
    }

    this.set_cookie = function () {
        lightSetCookie(_self.properties.name, 1, _self.properties.expires)
        $('#' + _self.properties.blockId).hide();
    }

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.cookiePolicy = cookiePolicy;
}
