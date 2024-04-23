'use strict';
function UsersPayments(optionArr)
{
    this.properties = {
        siteUrl: '/',
        id: {
            paySystemsList: '#payment-list',
            deficitFunds: '#deficit-funds',
            userPayData: '#user-pay-data',
            addFunds: '#add-funds',
            useSystemGid: '#use-system_gid',
            savePaymentForm: '#save_payment-form'
        },
        class: {},
        dataAction: {
            paymentList: '[data-action="payment-list"]',
            setPaymentSystem: '[data-action="set-payment-system"]',
            updatePaymentSystem: '[data-action="update-payment-system"]',
            addPayment: '[data-action="add-payment"]',
            closeBtn: '[data-action="close"]'
        },
        url: {
            addFunds: 'users_payments/addFunds/',
        },
        lang: {
            systemError: 'System error!'
        },
        errorObj: new Errors(),
        contentObj: new loadingContent({
            loadBlockWidth: '400px',
            loadBlockLeftType: 'center',
            loadBlockTopType: 'top',
            loadBlockTopPoint: 100,
            draggable: true,
            closeBtnUse: true,
            closeBtnClass: 'btn-close'
        })
    };

    var _self = this;
    var _tempData = {};

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
        $(_self.properties.id.addFunds).focus();
    };

    this.initControls = function () {
        $(document)
           .off('click', _self.properties.dataAction.paymentList).on('click', _self.properties.dataAction.paymentList, function () {
            _self.paymentSystemsToggle($(this));
           }).off('click', _self.properties.dataAction.setPaymentSystem).on('click', _self.properties.dataAction.setPaymentSystem, function () {
            _self.setPaymentSystems($(this));
           }).off('click', _self.properties.dataAction.updatePaymentSystem).on('click', _self.properties.dataAction.updatePaymentSystem, function () {
            _self.updatePaymentSystem($(this));
           }).off('click', _self.properties.dataAction.addPayment).on('click', _self.properties.dataAction.addPayment, function () {
            _self.addPayment();
           }).off('click', _self.properties.dataAction.closeBtn).on('click', _self.properties.dataAction.closeBtn, function () {
            _self.properties.contentObj.hide_load_block();
           }).on('input paste change blur focus keyup select', _self.properties.id.addFunds, function () {
            _self.changeAddPaymentBtnStatus();
           });
    };

    this.paymentSystemsToggle = function () {
        $(_self.properties.id.paySystemsList).toggle();
    };

    this.setPaymentSystems = function (obj) {
        _self.query(
                _self.properties.url.addFunds,
                {system: obj.data('gid'), price: obj.data('price'), send: 1},
                'json',
                function (data) {
                    if (obj.data('gid')) {
                        $(_self.properties.id.deficitFunds).html(data.html);
                        _tempData.paymentSystem = obj.data('gid');
                    } else {
                        _self.properties.contentObj.show_load_block(data.html);
                    }
                }
        );
    };

    this.updatePaymentSystem = function (obj) {
        $(_self.properties.id.userPayData).find('img').attr('src', obj.data('img'));
        $(_self.properties.id.useSystemGid).val(obj.data('gid'));
        $('.b-billing-systems__link').removeClass('active');
        obj.addClass('active');
    };

    this.addPayment = function () {
        if ($(_self.properties.id.addFunds).val() !== '' && $(_self.properties.id.addFunds).val() > 0) {
            $(_self.properties.id.savePaymentForm).submit();
        }
    };

    this.changeAddPaymentBtnStatus = function () {
        if ($(_self.properties.id.addFunds).val() !== '' && $(_self.properties.id.addFunds).val() > 0) {
            $(_self.properties.dataAction.addPayment).prop('disabled', false);
        } else {
            $(_self.properties.dataAction.addPayment).prop('disabled', true);
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
                if (typeof (data.error) !== 'undefined' && data.error.length > 0) {
                    _self.properties.errorObj.show_error_block(data.error, 'error');
                }
                if (typeof data.info.access_denied !== 'undefined' && data.info.access_denied.length > 0) {
                    _self.properties.contentObj
                      .show_load_block(data.info.access_denied);
                }
                if (typeof (data.success) !== 'undefined' && data.success.length > 0) {
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
};

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.UsersPayments = UsersPayments;
}
