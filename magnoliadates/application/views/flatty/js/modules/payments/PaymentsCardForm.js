'use strict';
function PaymentsCardForm(optionArr)
{

    this.properties = {
        siteUrl: '/'
    };

    const _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
    };

    this.initControls = function () {
        // $(document)
        //     .off('click', _self.properties.data.action.createArchive).on('click', _self.properties.data.action.createArchive, function () {
        //     _self.createArchive($(this));
        // }).off('click', _self.properties.data.action.readyArchive).on('click', _self.properties.data.action.readyArchive, function () {
        //     _self.readyArchive();
        // }).off('click', _self.properties.data.action.deleteArchive).on('click', _self.properties.data.action.deleteArchive, function () {
        //     _self.deleteArchive();
        // }).off('change', _self.properties.data.action.UIChange).on('change', _self.properties.data.action.UIChange, function () {
        //     _self.selectModules();
        // });
    };



    _self.Init(optionArr);
}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.PaymentsCardForm = PaymentsCardForm;
}