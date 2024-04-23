function Companions(optionArr)
{
    this.properties = {
        siteUrl: '',
        request_id: 0,
        sendResponseLink: 'companions/ajaxAddResponse/',
        deleteResponseLink: 'companions/ajaxDeleteResponse/',
        message_form_link: 'companions/ajaxGetMessageForm/',
        answer_form_link: 'companions/ajaxGetAnswerForm/',
        error_object: error_object,
        content_obj: new loadingContent({
            loadBlockWidth: '550px',
            loadBlockLeftType: 'center',
            loadBlockTopType: 'top',
            loadBlockTopPoint: 100,
            closeBtnClass: 'w',
            draggable: true
                    })
    };

    var _self = this;

    this.Init = function (options) {
        _self.prop = $.extend(_self.properties, options);
        _self.sendResponse();
    }

    this.sendResponse = function () {
        $('#js_send_response').off('click').on('click', function () {
            $.ajax({
                //url: _self.prop.siteUrl + _self.prop.message_form_link + _self.prop.request_id,
                url: _self.prop.siteUrl + _self.prop.sendResponseLink + _self.prop.request_id,
                dataType: 'json',
                cache: false,
                success: function (data) {
                    if (data.success) {
                        error_object.show_error_block(data.success, 'success');
                        locationHref(_self.prop.siteUrl + 'companions/viewRequest/' + _self.prop.request_id);
                    } else if (data.errors) {
                        error_object.show_error_block(data.errors, 'error');
                    }
                }
            });
        });

        $('.js_accept_response').off('click').on('click', function () {
            var response_id = $(this).attr('data-id');
            $.ajax({
                url:  _self.prop.siteUrl + _self.prop.answer_form_link + response_id + '/accept',
                dataType: 'html',
                cache: false,
                success: function (data) {
                    if (data) {
                        _self.prop.content_obj.show_load_block(data);
                    }
                }
            });
        });

        $('.js_decline_response').off('click').on('click', function () {
            var response_id = $(this).attr('data-id');
            $.ajax({
                url: _self.prop.siteUrl + _self.prop.answer_form_link + response_id  + '/decline',
                dataType: 'html',
                cache: false,
                success: function (data) {
                    if (data) {
                        _self.prop.content_obj.show_load_block(data);
                    }
                }
            });
        });

                $('#js_delete_response').off('click').on('click', function () {
                    $.ajax({
                        url: _self.prop.siteUrl + _self.prop.deleteResponseLink + _self.prop.request_id,
                        dataType: 'json',
                        cache: false,
                        success: function (data) {
                            if (data.success) {
                                error_object.show_error_block(data.success, 'success');
                                locationHref(_self.prop.siteUrl + 'companions/viewRequest/' + _self.prop.request_id);
                            } else if (data.errors) {
                                error_object.show_error_block(data.errors, 'error');
                            }
                        }
                    });
                });
    }

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.Companions = Companions;
}
