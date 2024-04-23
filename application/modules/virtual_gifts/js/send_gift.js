function SendGift(optionArr)
{
    this.properties = {
        siteUrl: '',
        use_form: true,
        btnForm: 'btn-virtual_gift',
        cFormId: 'virtual_gift_form',
        urlGetForm: '',
        urlSendForm: '',
        id_close: 'btn_send_gift',
        errorObj: new Errors,
        contentObj: new loadingContent({
            loadBlockWidth: '50%',
            closeBtnClass: 'w',
            scroll: true,
            closeBtnPadding: 5,
            blockBody: true
        })
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        $('#' + _self.properties.btnForm).on('click', function () {
            if (_self.properties.use_form) {
                _self.get_form();
            }
        }).show();
    };

    this.isJson = function (data) {
        try {
            JSON.parse(data);
        } catch (e) {
            return false;
        }
        return true;
    };

    this.get_form = function () {
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.urlGetForm,
            type: 'POST',
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (typeof data.errors !== 'undefined' && data.errors.length > 0) {
                    error_object.show_error_block(data.errors, 'error');
                    return false;
                } else if (typeof data.info.access_denied !== 'undefined' && data.info.access_denied.length > 0) {
                    _self.properties.contentObj.properties.onClose = () => {
                        $("body").removeClass("blur-page fixed-top").find(".pjaxcontainer-inner").removeClass("blur-it");
                    };
                    _self.properties.contentObj
                      .show_load_block(data.info.access_denied);
                    return false;
                } else {
                    _self.properties.contentObj.show_load_block(data.content);
                    $('#' + _self.properties.id_close).unbind().on('click', function () {
                        _self.clearBox();
                    });
                }
            }
        });
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
    }

    this.clearBox = function () {
        var data = $('#' + _self.properties.cFormId).serialize();
        _self.send_form(data);
    }

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.SendGift = SendGift;
}
