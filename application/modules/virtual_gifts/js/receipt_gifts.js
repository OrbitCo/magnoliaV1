function ReceiptGift(optionArr)
{
    this.properties = {
        siteUrl: '',
        use_form: true,
        btnForm: 'receipt-gift',
        cFormId: 'virtual_gift_form',
        urlGetForm: '',
        urlSendForm: '',
        id_close: 'btn_send_gift',
        errorObj: new Errors,
        dataType: 'html',
        contentObj: '',
        closeCookie: 'gift_opened',
        giftsListId: 'receipt_gifts_list'
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        $('#' + _self.properties.giftsListId).on('click', 'li', function (e) {
            e.preventDefault();
            var gift_id = $(this).find('a').attr('gift-id');
            if (_self.properties.use_form) {
                _self.get_form(gift_id, true);
            }
            return false;
        });

        _self.properties.contentObj = new loadingContent({
            loadBlockWidth: '50%',
            closeBtnClass: 'w',
            scroll: true,
            closeBtnPadding: 5,
            blockBody: true,
            onClose: _self.setCloseCookie
        });
    };

    this.get_form = function (gift_id, status) {
        var isOpen = (typeof status == 'undefined') ? false : true;
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.urlGetForm,
            type: 'POST',
            cache: false,
            data: {'gift_id': gift_id},
            dataType: _self.properties.dataType,
            success: function (data) {
                if (_self.isJson(data)) {
                    var resp = JSON.parse(data);
                    if (resp.errors) {
                        error_object.show_error_block(resp.errors, 'error');
                    } else if (resp.info && (_self.properties.urlGetForm != 'virtual_gifts/ajax_get_receipt_gift' || isOpen === true)) {
                        _self.properties.contentObj.show_load_block(resp.info.access_denied);
                    }
                } else {
                    _self.properties.contentObj.show_load_block(data);
                    $('#' + _self.properties.id_close).unbind().on('click', function () {
                        _self.clearBox();
                        return false;
                    });
                }
            }
        });
        return false;
    };


    this.getCloseCookie = function () {
        return lightGetCookie(_self.properties.closeCookie);
    }

    this.setCloseCookie = function () {
        document.cookie = _self.properties.closeCookie + "=1;path=/";
    }

    this.delCloseCookie = function () {
        var expiresDate = new Date();
        expiresDate.setTime(expiresDate.getTime() - 1);
        document.cookie = _self.properties.closeCookie + "=;path=/;expires=" + expiresDate.toGMTString();
    }

    this.send_form = function (data) {
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.urlSendForm,
            type: 'POST',
            data: data,
            dataType: 'json',
            cache: false,
            success: function (data) {
                if (typeof (data.error) != 'undefined' && data.error != '') {
                    _self.properties.errorObj.show_error_block(data.error, 'error');
                } else {
                    _self.properties.errorObj.show_error_block(data.success, 'success');
                    _self.properties.contentObj.hide_load_block();
                }
            }
        });

        return false;
    }

    this.clearBox = function () {
        var data = $('#' + _self.properties.cFormId).serialize();
        _self.send_form(data);
    }

    this.isJson = function (data) {
        try {
            JSON.parse(data);
        } catch (e) {
            return false;
        }
        return true;
    };

    _self.Init(optionArr);
}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.ReceiptGift = ReceiptGift;
}
