function Landings(optionArr)
{
    this.properties = {
        siteUrl: '',
        ajax_delete_select_url: 'admin/landings/ajaxDeleteSelect/',
        index_page_url: 'admin/landings/index/',
        id_upload_delete: 'landing_upload_delete',
        id_grouping_all: 'landing_grouping_all',
        id_delete_all: 'landings_link_delete',
        id_landing_file: 'landing_file',
        lang_data: {},
        error_object: new Errors(),
    };

    var _self = this;

    this.Init = function (options) {
        _self.prop = $.extend(_self.properties, options);
        _self.bindEvents();
    }

    this.bindEvents = function () {
        $(document).off('click', '#' + _self.prop.id_upload_delete).on('click', '#' + _self.prop.id_upload_delete, function () {
            _self.deleteLandingUpload($(this).prop('checked'));
        });

        $(document).off('click', '#' + _self.prop.id_grouping_all).on('click', '#' + _self.prop.id_grouping_all, function () {
            _self.groupingLandings($(this).prop('checked'));
        });

        $(document).off('click', '#' + _self.prop.id_delete_all).on('click', '#' + _self.prop.id_delete_all, function () {
            _self.deleteSelected();
        });
    }

    this.deleteSelected = function () {
        var data = new Array();

        $('input[type=checkbox]:checked:not(#landing_grouping_all)').each(function (i) {
            data[i] = $(this).val();
        });

        if (!confirm(_self.prop.lang_data.btn_delete_confirm)) {
            return false;
        }

        $.ajax({
            url: _self.prop.siteUrl + _self.prop.ajax_delete_select_url,
            data: {landings_ids: data},
            type: "POST",
            dataType: "json",
            cache: false,
            success: function (data) {
                error_object.show_error_block(data.message, data.status);
                if (data.status != 'error') {
                    location.href = _self.prop.siteUrl + _self.prop.index_page_url;
                }
            }
        });
    }

    this.deleteLandingUpload = function (is_delete_upload) {
        if (is_delete_upload == true) {
            $('#' + _self.prop.id_landing_file).prop('disabled', 'disabled');
        } else {
            $('#' + _self.prop.id_landing_file).prop('disabled', '');
        }
    }

    this.groupingLandings = function (is_checked) {
        if (is_checked) {
            $('input[type=checkbox]').prop('checked', true);
        } else {
            $('input[type=checkbox]').prop('checked', false);
        }
    }

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.Landings = Landings;
}
