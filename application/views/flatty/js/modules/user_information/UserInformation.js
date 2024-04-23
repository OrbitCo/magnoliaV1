'use strict';
function UserInformation(optionArr)
{
    this.properties = {
        siteUrl: '/',
        id: {
            descriptionBlock: '#ui-description_block'
        },
        class: {
            UIModulesList: '.ui-modules_list',
            contentPage: '.content-page'
        },
        data:{
            action: {
                createArchive: '[data-action="create-archive"]',
                duringArchive: '[data-action="during-archive"]',
                readyArchive: '[data-action="ready-archive"]',
                deleteArchive: '[data-action="delete-archive"]',
                UIChange: '[data-action="ui_change"]'
            }
        },
        url: {
            create: 'user_information/create/',
            delete: 'user_information/delete/',
            download: 'user_information/download/',
            page: 'users/settings/download_my_data'
        },
        lang: {
            systemError: 'System error!'
        },
        errorObj: new Errors()
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
    };

    this.initControls = function () {
        $(document)
           .off('click', _self.properties.data.action.createArchive).on('click', _self.properties.data.action.createArchive, function () {
            _self.createArchive($(this));
           }).off('click', _self.properties.data.action.readyArchive).on('click', _self.properties.data.action.readyArchive, function () {
            _self.readyArchive();
           }).off('click', _self.properties.data.action.deleteArchive).on('click', _self.properties.data.action.deleteArchive, function () {
            _self.deleteArchive();
           }).off('change', _self.properties.data.action.UIChange).on('change', _self.properties.data.action.UIChange, function () {
            _self.selectModules();
           });
    };
    
    this.selectModules = function () {
        var countModules = $(_self.properties.data.action.UIChange + ':checked').length;
        if (countModules === 0) {
            $(_self.properties.data.action.createArchive).prop('disabled', true);
        } else {
            $(_self.properties.data.action.createArchive).prop('disabled', false);
        }
    };

    this.createArchive = function (obj) {
        var countModules = $(_self.properties.data.action.UIChange + ':checked').length;
        if (countModules !== 0) {
            var checked = [];
            $(_self.properties.data.action.UIChange + ':checked').each(function () {
                checked.push($(this).data('module'));
            });
            _self.query(
                _self.properties.url.create,
                {create: 1, modules: checked},
                'json',
                function (data) {
                    if (typeof (data.error) === 'undefined' || data.error.length === 0) {
                        obj.attr({'data-action': 'during-archive', 'data-status': 'during'})
                           .removeClass('btn-primary')
                           .addClass('btn-default')
                           .html('<i class="fa fa-spinner" aria-hidden="true"></i> ' + _self.properties.lang.btnDuring);
                           $(_self.properties.id.descriptionBlock).html('<div class="well">' + _self.properties.lang.descriptionPrepared + '</div>');
                    }
                }
            );
        }
    };
    
    this.readyArchive = function () {
        location.href = _self.properties.siteUrl + _self.properties.url.download;
    };
    
    this.deleteArchive = function () {
        _self.query(
            _self.properties.url.delete,
            {delete: 1},
            'json',
            function (data) {
                if (typeof (data.error) === 'undefined' || data.error.length === 0) {
                    locationHref(_self.properties.siteUrl + _self.properties.url.page);
                }
            }
        );
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
                if (typeof (data.info) !== 'undefined' && data.info.length > 0) {
                    _self.properties.errorObj.show_error_block(data.info, 'info');
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
    exports.UserInformation = UserInformation;
}
