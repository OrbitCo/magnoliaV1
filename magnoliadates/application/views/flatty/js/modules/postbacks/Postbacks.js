
'use strict';
function Postbacks(optionArr)
{
    this.properties = {
        siteUrl: '/',
        errorObj: new Errors()
    }

    const _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
    }

    this.initControls = function () {
    }

    _self.Init(optionArr);
}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.Postbacks = Postbacks;
}