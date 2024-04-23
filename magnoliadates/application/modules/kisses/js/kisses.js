function Kisses(optionArr)
{
    this.properties = {
        siteUrl: '',
        use_form: true,
        btnForm: 'btn-kisses',
        cFormId: 'kisses_form',
        urlGetForm: '',
        urlSendForm: '',
        id_close: 'btn_send_kisses',
        errorObj: new Errors,
        dataType: 'json',
        messageId: 'message',
        kiss: 'input[name="kiss"]',
        objectId: 'input[name="object_id"]',
        langs: {},
        contentObj: new loadingContent({
            loadBlockWidth: '50%',
            closeBtnClass: 'w',
            scroll: true,
            closeBtnPadding: 5,
            blockBody: true,
        })
    };

    var _self = this;

    this.Init = function (options) {

        _self.properties = $.extend(_self.properties, options);

        $('#' + _self.properties.btnForm).unbind('click').on('click', function (e) {
            e.preventDefault();
            if (_self.properties.use_form) {
                _self.get_form();
            }
        }).show();
    };

    this.get_form = function () {
            $.ajax({
                url: _self.properties.siteUrl + _self.properties.urlGetForm,
                type: 'POST',
                cache: false,
                dataType: _self.properties.dataType,
                success: function (data) {
                    if (typeof data.errors !== 'undefined' && data.errors.length > 0) {
                        _self.properties.errorObj.show_error_block(data.errors, 'error');
                    } else if (typeof data.info.access_denied !== 'undefined' && data.info.access_denied.length > 0) {
                        _self.properties.contentObj
                          .show_load_block(data.info.access_denied);
                        return false;
                    } else {
                        _self.properties.contentObj.show_load_block(data.html);
                        $('#' + _self.properties.id_close).unbind().on('click', function () {
                            _self.clearBox();
                            return false;
                        });
                    }
                }
            });

        return false;
    };

    this.send_form = function (data) {
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.urlSendForm,
            type: 'POST',
            data: data,
            dataType: _self.properties.dataType,
            cache: false,
            success: function (data) {
                if (typeof (data.error) !== 'undefined' && data.error.length > 0) {
                    _self.properties.errorObj.show_error_block(data.error, 'error');
                } else {
                    _self.properties.errorObj.show_error_block(data.success, 'success');
                    _self.properties.contentObj.hide_load_block();
                    sendAnalytics('kisses_send_kiss', 'communication', 'user');
                }
            }
        });

        return false;
    };

    this.clearBox = function () {
        if (typeof ($(_self.properties.kiss+':checked').val()) !== 'undefined') {
            var data = $('#' + _self.properties.cFormId).serialize();
            _self.send_form(data);
        } else {
            _self.properties.errorObj.show_error_block(_self.properties.langs.kiss_empty, 'error');
        }
    };

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.Kisses = Kisses;
}
