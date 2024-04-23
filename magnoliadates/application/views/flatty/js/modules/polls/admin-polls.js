function adminPolls(optionArr)
{

    this.properties = {
        siteUrl: ''
    }

    var _self = this;

    this.errors = {
    }

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        $('div.row:odd').addClass('zebra');
        $('.datepicker').datepicker({dateFormat:'dd-mm-yy'});
    }

    this.bind_events = function () {
        $('#use_expiration').on('click', function () {
            if (this.checked) {
                $('#date_end').removeAttr('disabled');
            } else {
                $('#date_end').attr('disabled', 'disabled');
            }
        });
        $('#poll_language').change(function () {
            if ($(this).val() > 0) {
                $('.question').hide();
                $('#question_' + $(this).val()).show();
            } else {
                $('.question').show();
            }
        });
    }

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.adminPolls = adminPolls;
}
