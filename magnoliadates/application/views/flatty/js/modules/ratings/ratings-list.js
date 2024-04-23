function RatingsList(optionArr)
{
    this.properties = {
        siteUrl: '',
        listAjaxUrl: 'ratings/ajax_get_ratings',
        listBlockId: 'ratings_list',
        replyAjaxUrl: 'ratings/ajax_reply/',
        order: 'date_add',
        orderDirection: 'DESC',
        page: 1,
        replySuccessCallback: null,
        replyFormClass: 'ratings-reply-form',
        errorObj: null,
        tIds: [],
    }

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);

        if (!_self.properties.errorObj) {
            _self.properties.errorObj = new Errors();
        }

        $(document).off('submit', '.' + _self.properties.replyFormClass)
                .on('submit', '.' + _self.properties.replyFormClass, function () {
                    _self.reply_form($(this));
                    return false;
                });

        _self.init_links();
    }

    this.init_links = function () {
        if (_self.properties.tIds.length) {
            for (var index in _self.properties.tIds) {
                var id = _self.properties.tIds[index];
                $(document).on('change', '#' + id + ' select', function () {
                    _self.properties.order = $(this).val();
                    _self.loading_block();
                    return false;
                });
                $(document).on('click', '#' + id + ' [name=sorter_btn]', function () {
                    if (_self.properties.orderDirection == 'ASC') {
                        _self.properties.orderDirection = 'DESC';
                    } else {
                        _self.properties.orderDirection = 'ASC';
                    }
                    _self.loading_block();
                    return false;
                });
                $(document).on('click', '#' + id + '>.pages a[data-page]', function () {
                    _self.properties.page = $(this).attr('data-page');
                    _self.loading_block();
                    return false;
                });
            }
        }
    }

    this.loading_block = function (url) {
        if (!url) {
            url = _self.properties.siteUrl + _self.properties.listAjaxUrl + '/' +
                    _self.properties.order + '/' + _self.properties.orderDirection + '/' +
                    _self.properties.page;
        }
        $.ajax({
            url: url,
            type: 'GET',
            cache: false,
            success: function (data) {
                $('#' + _self.properties.listBlockId).html(data);
            }
        });
    }

    this.reply_form = function (el) {
        var id = el.data('id');
        var data = el.serialize();

        $.ajax({
            url: _self.properties.siteUrl + _self.properties.replyAjaxUrl + id,
            type: 'POST',
            cache: false,
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    if (_self.properties.replySuccessCallback) {
                        _self.properties.replySuccessCallback(el, data);
                    }
                    _self.properties.errorObj.show_error_block(data.success, 'success');
                } else {
                    _self.properties.errorObj.show_error_block(data.error, 'error');
                }
                return false;
            }
        });
    }

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.RatingsList = RatingsList;
}
