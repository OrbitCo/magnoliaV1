function SendVip(optionArr)
{

    this.properties = {
        siteUrl: '',
        reloadTimeout: 600,
        idTransaction: 0,
        rand: 0,
        user_id: 0,
        urlDecline: 'send_vip/ajaxDecline/',
        urlApprove: 'send_vip/ajaxApprove/',
        urlValidateTransaction: 'send_vip/ajaxValidateTransaction/',
        urlGetSendVipBlock: 'send_vip/ajaxGetSendVipBlock/',
        contentObj: new loadingContent({
            loadBlockWidth: '400px',
            loadBlockLeftType: 'right',
            loadBlockTopType: 'bottom',
            closeBtnClass: 'w'
        })
    };

    const _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);

        $(document).off('click', '#donate_link_send_vip').on('click', '#donate_link_send_vip', function () {
            _self.getSendVipBlock();
        });
    };

    this.getSendVipBlock = function () {
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.urlGetSendVipBlock + _self.properties.user_id,
            cache: false,
            dataType: 'JSON',
            success: function (data) {
                if (typeof data.errors !== 'undefined' && data.errors.length > 0) {
                    error_object.show_error_block(data.errors, 'error');
                } else {
                    _self.properties.contentObj.show_load_block(data.html);
                }
            }
        });
    }

    this.declineVipTransaction = function (idTransaction, rand) {
        $.ajax({
            type: 'POST',
            url: _self.properties.siteUrl + _self.properties.urlDecline + idTransaction,
            data: {'id_transaction': idTransaction},
            success: function (data) {
                if (data) {
                    error_object.show_error_block(data, 'success');
                    $('#status_' + rand).html('<font class="donate decline">' + data + '</font>');
                } else {
                    console.log('return error');
                }
            }
        });
    };

    this.approveVipTransaction = function (idTransaction, rand) {
        $.ajax({
            type: 'POST',
            url: _self.properties.siteUrl + _self.properties.urlApprove + idTransaction,
            data: {'id_transaction': idTransaction},
            success: function (data) {
                if (data) {
                    error_object.show_error_block(data, 'success');
                    $('#status_' + rand).html('<font class="donate approve">' + data + '</font>');
                    sendAnalytics('send_membership_approved', 'communication', 'user');
                } else {
                    console.log('return error');
                }
            }
        });
    };

    this.validateTransaction = function () {
        $('#send_vip').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: _self.properties.siteUrl + _self.properties.urlValidateTransaction,
                data: $('#send_form').serialize(),
                dataType: 'json',
                success: function (data) {
                    if (typeof (data.errors) !== 'undefined' && data.errors.length > 0) {
                        error_object.show_error_block(data.errors, 'error');
                    } else {
                        $('#send_form').submit();
                    }
                }
            });
        });
    };

    _self.Init(optionArr);
};


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.SendVip = SendVip;
}
