function available_view(optionArr) {

    this.properties = {
        siteUrl: '/',
        checkAvailableAjaxUrl: 'users_services/ajax_available_contact/',
        paymentFormUrl: 'services/ajaxForm/',
        buyAbilityAjaxUrl: 'users_services/ajax_activate_contact/',
        buyAbilityFormId: 'ability_form',
        buyAbilitySubmitId: 'ability_form_submit',
        formType: 'list',
        alert_ok_button: 'Ok',
        alert_cancel_button: 'Cancel',
        lang_delete_confirm: '',
        alert_type: '',
        paymentObj: 'services',
        paymentGid: '',
        success_request: function (message) {},
        fail_request: function (message) {},
        windowObj: new loadingContent({loadBlockWidth: '520px', closeBtnClass: 'w'})
    };

    var _p = {};
    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initServiceControls();
    };

    this.check_users_services = function () {

    };

    this.check_available = function (id) {
        id = id || '';
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.checkAvailableAjaxUrl + id,
            type: 'POST',
            dataType: "json",
            cache: false,
            success: function (data) {
                if (data.display_login == 1) {
                    error_object.errors_access();
                } else if (_self.properties.alert_type) {
                    alerts.show({
                        text: _self.properties.lang_delete_confirm,
                        type: 'confirm',
                        ok_button: _self.properties.alert_ok_button,
                        cancel_button: _self.properties.alert_cancel_button,
                        ok_callback: function () {
                            if (data.available == 1) {
                                _self.properties.success_request(data);
                            } else {
                                _self.getPaymentForm(data.gid);
//								_self.properties.windowObj.show_load_block(data.content);
                            }
                        }
                    });
                } else {
                    if (data.available == 1) {
                        if (typeof data.info !== 'undefined') {
                            _self.properties.success_request(data.info);
                        }
                    } else {
                        //console.log(data);
                        _self.getPaymentForm(data.gid);
//						_self.properties.windowObj.show_load_block(data.content);
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    };

    this.init_ability_form = function () {
        if (_self.properties.formType === 'select') {
            $('#' + _self.properties.buyAbilitySubmitId).unbind('click').on('click', function () {
                var id_user_service = $('#' + _self.properties.buyAbilityFormId + ' select[name="id_user_service"]').val();
                if (id_user_service) {
                    _p.activate_request(id_user_service);
                }
            });
        } else if (_self.properties.formType === 'list') {
            $('#' + _self.properties.buyAbilityFormId).find('input[type="button"][data-value]').unbind('click').on('click', function () {
                var id_user_service = parseInt($(this).data('value'));
                var alert = $(this).data('alert').replace(/<br>/g, '\n');
                if (!id_user_service) {
                    return false;
                }
                if (alert) {
                    alerts.show({
                        text: alert,
                        type: 'confirm',
                        ok_callback: function () {
                            _p.activate_request(id_user_service);
                        }
                    });
                } else {
                    _p.activate_request(id_user_service);
                }
            });
        }

        _self.initServiceControls();
    };

    _p.activate_request = function (id_user_service) {
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.buyAbilityAjaxUrl + id_user_service,
            type: 'GET',
            dataType: "json",
            cache: false,
            success: function (data) {
                if (data.status == 1) {
                    _self.properties.success_request(data.message);
                } else {
                    _self.properties.fail_request(data.message);
                }
                _self.properties.windowObj.hide_load_block();
            }
        });
    };

    this.set_properties = function (properties) {
        _self.properties = $.extend(_self.properties, properties);
    };

    this.getPaymentForm = function (gid, data) {
        _self.properties.paymentGid = gid;

        $.ajax({
            url: _self.properties.siteUrl + _self.properties.paymentFormUrl + _self.properties.paymentGid,
            type: 'POST',
            data: data,
            dataType: "json",
            cache: false,
            success: function (data) {
                if (data.content != 'undefined' && data.content) {
                    _self.properties.windowObj.show_load_block(data.content);
                    _self.initPaymentControls();
                    _self.init_ability_form();
                } else {
                    _self.properties.windowObj.hide_load_block();

                    if (data.success !== 'undefined' && data.success.length > 0) {
                        error_object.show_error_block(data.success, 'success');
                    } else {
                        error_object.show_error_block(data.error, 'error');
                    }

                    if (data.redirect) {
                        locationHref(data.redirect);
                    }
                }
            }
        });
    }

    this.initServiceControls = function () {
        $('.get-service-form').off().on('click', function () {
            var gid = $(this).attr("data-gid");
            _self.getPaymentForm(gid);
        });
    }

    this.initPaymentControls = function (gid) {
        $('#btn_account').off().on('click', function () {
            var data = '&btn_account=1';
            var form_data = $('#service_buy_form').serialize() + data;

            _self.getPaymentForm(_self.properties.paymentGid, form_data);
        });

        $('.btn_system').off().on('click', function () {
            var system_gid = $(this).attr('data-payment-gid');
            $('#payment_method').attr('name', 'btn_system');
            $('[name="system_gid"]').val(system_gid);
            $('#service_buy_form').submit();
        });
    }

    this.initAccountControls = function () {
        $('#cancel_payment').off().on('click', function () {
            _self.getPaymentForm(_self.properties.paymentGid);
        });
    }

    _self.Init(optionArr);
}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.available_view = available_view;
}
