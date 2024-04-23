'use strict';
function AdminAccessPermissions(optionArr)
{

    this.properties = {
        siteUrl: '/',
        groups: false,
        dataAction: {
            add: '[data-action="add"]',
            addPeriod: '[data-action="add-period"]',
            edit: '[data-action="edit"]',
            delete: '[data-action="delete"]',
            save: '[data-action="save"]',
            status: '[data-action="status"]',
            changePermissions: '[data-action="change_permissions"]',
            membershipChange: '[data-action="membership-change"]',
            addMembership: '[data-action="add-membership"]',
            changeMembership: '[data-action="change-membership"]'
        },
        url: {
            saveSubscriptionType: 'admin/access_permissions/saveSubscriptionType/',
            loadSubscriptionForm: 'admin/access_permissions/loadSubscriptionForm/',
            editSubscription: 'admin/access_permissions/editSubscription/',
            deleteSubscription: 'admin/access_permissions/deleteSubscription/',
            statusSubscription: 'admin/access_permissions/statusSubscription/',
            loadPermissionsList: 'admin/access_permissions/loadPermissionsList/',
            loadPeriodForm: 'admin/access_permissions/loadPeriodForm/',
            membershipChange: 'admin/access_permissions/membershipChange/',
            addMembership: 'admin/access_permissions/addMembership/',
            reloadSubscriptionType: {
                all_users: 'admin/access_permissions/registered/',
                user_types: 'admin/access_permissions/userTypes/'
            }
        },
        id: {
            accessContent: '#access-content',
            addSubscriptionType: '#add-subscription-type',
            myTab: '#myTab',
            saveForm: '#save_form',
            permissionsList: '#permissions-list',
            periodsList: '#periods-list',
            sidebarMenu: '#sidebar-menu',
            userMembershipStr: '#user_membership_str-',
            userMembershipChoise: '#user_membership_choise'
        },
        class: {
            membershipChangeList: '.membership_change_list',
            grouping: '.grouping'
        },
        saveSubscriptionClass: '.subscription_type-js',
        scrollToBlock: 'scrollToBlock',
        errorObj: new Errors(),
        lang: {
            expires: 'Expires'
        },
        contentObj: new loadingContent({
            loadBlockWidth: '680px',
            closeBtnClass: 'load_content_controller_close',
            closeBtnPadding: 15,
            loadBlockSize: 'lg',
            footerButtons: '<input type="button" data-action="save" value="Save" class="btn btn-primary">'
        })
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
        _self.scrollToBlock();
        _self.renderPage();
    };

    this.renderPage = function () {
        var mainWidth = $(window).width() - $(_self.properties.id.sidebarMenu).width();
        var permissionsListWidth = $(_self.properties.id.permissionsList).width();
        if (mainWidth < permissionsListWidth) {
            var rowWidth = (mainWidth - 500) / $(_self.properties.id.permissionsList).find('th').length;
            $(_self.properties.id.permissionsList).find('th>div:not(:first)').width(rowWidth + 'px').addClass('text-ellipsis');
            $(_self.properties.id.periodsList).find('th>div:not(:first)').width(rowWidth + 'px').addClass('text-ellipsis');
        }
    };

    this.initControls = function () {
        $(document)
                .off('change', _self.properties.saveSubscriptionClass).on('change', _self.properties.saveSubscriptionClass, function () {
                    _self.setSubscriptionType($(this));
                }).off('click', _self.properties.dataAction.add).on('click', _self.properties.dataAction.add, function () {
                    _self.loadSubscriptionForm($(this));
                }).off('click', _self.properties.dataAction.edit).on('click', _self.properties.dataAction.edit, function () {
                    _self.loadSubscriptionForm($(this));
                }).off('click', _self.properties.dataAction.delete).on('click', _self.properties.dataAction.delete, function () {
                    _self.deleteSubscription($(this));
                }).off('click', _self.properties.dataAction.save).on('click', _self.properties.dataAction.save, function () {
                    _self.saveSubscription();
                }).off('ifChanged', _self.properties.dataAction.status).on('ifChanged', _self.properties.dataAction.status, function () {
                    $(this).trigger('change');
                    _self.statusSubscription($(this));
                }).off('click', _self.properties.dataAction.changePermissions).on('click', _self.properties.dataAction.changePermissions, function () {
                    _self.changePermissionsForm($(this));
                }).off('click', _self.properties.dataAction.addPeriod).on('click', _self.properties.dataAction.addPeriod, function () {
                    _self.loadPeriodForm($(this));
                }).off('click', _self.properties.dataAction.membershipChange).on('click', _self.properties.dataAction.membershipChange, function () {
                    _self.membershipChange($(this));
                }).off('click', _self.properties.dataAction.addMembership).on('click', _self.properties.dataAction.addMembership, function () {
                    _self.addMembership($(this));
                }).off('click', _self.properties.dataAction.changeMembership).on('click', _self.properties.dataAction.changeMembership, function () {
                    _self.changeMembership($(this));
                }).off('click', _self.properties.id.userMembershipChoise).on('click', _self.properties.id.userMembershipChoise, function () {
                    _self.choiseMembership($(this));
                });
    };

    this.setSubscriptionType = function (obj) {
        $(_self.properties.saveSubscriptionClass).prop('checked', false).parent().removeClass('checked');
        var user_type = (typeof (obj.data('user_type')) !== 'undefined') ? obj.data('user_type') : 0;
        _self.query(
            _self.properties.url.saveSubscriptionType,
            {type: obj.data('type'), data: 1, user_type: user_type, send: 1},
            'json',
            function (data) {
                if (data) {
                    obj.prop('checked', true).addClass('checked');
                    $(_self.properties.id.accessContent).html(data.html).find('input').iCheck({checkboxClass: 'icheckbox_flat-green'});
                    $(_self.properties.id.myTab).find('li:eq(0)').addClass('active');
                    locationHref(_self.properties.siteUrl + _self.properties.url.reloadSubscriptionType[obj.data('type')]);
                } else {
                    locationHref(_self.properties.siteUrl + _self.properties.url.reloadSubscriptionType.all_users);
                }
            }
        );
    };

    this.loadSubscriptionForm = function (obj) {
        _self.query(
            _self.properties.url.loadSubscriptionForm,
            {id: obj.data('id'), send: 1},
            'json',
            function (data) {
                _self.properties.contentObj.show_load_block(data.html);
            }
        );
    };

    this.deleteSubscription = function (obj) {
        if (typeof (obj.data('id')) !== 'undefined' && obj.data('id') > 0) {
            _self.query(
                _self.properties.url.deleteSubscription,
                {id: obj.data('id'), gid: obj.data('gid'), send: 1},
                'json',
                function (data) {
                    if (data.is_delete !== 0) {
                        obj.closest('tr').remove();
                        $('[data-group_actions="' + obj.data('gid') +  '"]').remove();
                    }
                }
            );
        }
    };

    this.saveSubscription = function () {
        var formObj = $(_self.properties.id.saveForm);
        for (let input of formObj[0]){
          if (typeof input.value == 'number' && input.value < 1){
            input.value = 1;
          }
        }
        _self.query(
            formObj.attr('action'),
            formObj.serialize(),
            'json',
            function (data) {
              if (data.error.length){
                return false;
              }
                if (typeof (data.url_reload) !== 'undefined') {
                    lightSetCookie(
                        _self.properties.scrollToBlock,
                        _self.getBodyScrollTop()
                    );
                    _self.properties.contentObj.hide_load_block();
                     setTimeout(()=>{locationHref(data.url_reload)},2000);
                }
            }
        );
    };

    this.statusSubscription = function (obj) {
        if (typeof (obj.data('id')) !== 'undefined' && obj.data('id') > 0) {
            _self.query(
                _self.properties.url.statusSubscription,
                {
                    id: obj.data('id'),
                    gid:  obj.data('gid'),
                    status: (obj.find('input').prop('checked') === true) ? 1 : 0,
                    send: 1
                    },
                'json'
            );
        }
    };

    this.changePermissionsForm = function (obj) {
        if (typeof (obj.data('module_gid')) !== 'undefined' && typeof (obj.data('access')) !== 'undefined') {
            _self.query(
                _self.properties.url.loadPermissionsList,
                {
                    module_gid: obj.data('module_gid'),
                    method: obj.data('method'),
                    access: obj.data('access'),
                    user_type: obj.data('user_type'),
                    send: 1
                    },
                'json',
                function (data) {
                    _self.properties.contentObj.show_load_block(data.html);
                }
            );
        }
    };

    this.loadPeriodForm = function (obj) {
        _self.query(
            _self.properties.url.loadPeriodForm,
            {id: obj.data('id'), user_type: obj.data('user_type'), send: 1},
            'json',
            function (data) {
                _self.properties.contentObj.show_load_block(data.html);
            }
        );
    };

    this.scrollToBlock = function () {
        let scroll = 0;
        if (typeof lightGetCookie !== 'undefined') {
            scroll = lightGetCookie(_self.properties.scrollToBlock);
        }
        if (scroll > 0) {
            _self.clearBodyScrollTop();
            $('html,body').animate({scrollTop: scroll}, 100);
        }
    };

    this.getBodyScrollTop = function () {
        return _self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
    };

    this.clearBodyScrollTop = function () {
        lightSetCookie(_self.properties.scrollToBlock, 0);
    };

    this.getMemberships = function () {
        if (_self.properties.groups == false) {
            _self.query(
                _self.properties.url.membershipChange,
                {},
                'json',
                function (data) {
                    _self.properties.groups = data.groups;
                    return data.groups;
                }
            );
        } else {
            return _self.properties.groups;
        }
    };

    this.membershipChange = function (obj) {
        var days = parseInt(obj.data('days'));
        var groups = _self.getMemberships();
        var user_groups = obj.data('groups').split(',');
        if (groups) {
            var htmlObj = '<div class="list-group membership_change_list">';
            if (typeof groups.short_by_type !== 'undefined') {
                for (var key in groups.short_by_type[obj.data('user_type')]) {
                    if ($.inArray(groups.full[key]['group_gid'], user_groups) !== -1 || groups.full[key]['group_gid'] === user_groups) {
                        htmlObj += '<a data-action="add-membership" data-id_user="' + obj.data('id_user') + '" data-gid="' + key + '" data-membership="' + groups.full[key]['group_gid'] + '" data-period="' + groups.full[key]['period']['id'] + '" data-user_type="' + obj.data('user_type') + '" class="list-group-item active">' + groups.short_by_type[obj.data('user_type')][key]['title'] + '</a>';
                    } else {
                        htmlObj += '<a data-action="add-membership" data-id_user="' + obj.data('id_user') + '" data-gid="' + key + '" data-membership="' + groups.full[key]['group_gid'] + '" data-period="' + groups.full[key]['period']['id'] + '" data-user_type="' + obj.data('user_type') + '" class="list-group-item">' + groups.short_by_type[obj.data('user_type')][key]['title'] + '</a>';
                    }
                }
            } else {
                var count_days = 0;
                var block_id = '';
                for (var key in groups.short) {
                    if ($.inArray(groups.full[key]['group_gid'], user_groups) !== -1 || groups.full[key]['group_gid'] === user_groups) {
                        if (groups.full[key]['period']['count'] <= days || !count_days) {
                            count_days = groups.full[key]['period']['count'];
                            block_id = '#membership-' + key + '-' + groups.full[key]['group_gid'];
                        }
                        htmlObj += '<a id="membership-' + key + '-' + groups.full[key]['group_gid'] + '" data-action="add-membership" data-id_user="' + obj.data('id_user') + '" data-gid="' + key + '" data-membership="' + groups.full[key]['group_gid'] + '" data-period="' + groups.full[key]['period']['id'] + '" class="list-group-item">' + groups.short[key]['title'] + '</a>';
                    } else {
                        htmlObj += '<a data-action="add-membership" data-id_user="' + obj.data('id_user') + '" data-gid="' + key + '" data-membership="' + groups.full[key]['group_gid'] + '" data-period="' + groups.full[key]['period']['id'] + '" class="list-group-item">' + groups.short[key]['title'] + '</a>';
                    }
                }
            }
            htmlObj += '</div>';
            _self.properties.contentObj.update_css_styles({width: '400px', margin: '0 auto'});
            _self.properties.contentObj.show_load_block(htmlObj);
            var percent = days / count_days * 100;
            percent = percent > 100 ? 100 : percent;
            $(block_id).append('<div class="selected" style="width: ' + percent + '%"><span class="badge">' + obj.data('days') + '</span></div>');
        }
    };

    this.addMembership = function (obj) {
        $(_self.properties.dataAction.addMembership).removeClass('active');
        obj.addClass('active');
    };

    this.changeMembership = function () {
        var obj = $(_self.properties.class.membershipChangeList).find('a.active');
        var user_ids = (obj.data('id_user') !== '') ? [obj.data('id_user')] : _self.getSelectedUsers();
        _self.query(
            _self.properties.url.addMembership,
            {
                user_ids: user_ids,
                gid: obj.data('gid'),
                user_type: obj.data('user_type'),
                membership: obj.data('membership'),
                period: obj.data('period'),
                send: 1
            },
            'json',
            function (data) {
                _self.properties.contentObj.hide_load_block();

                for (var id in data.group) {
                    $('div' + _self.properties.dataAction.membershipChange + '[data-id_user="' + id + '"]')
                        .html(data.group[id].data.current_name
                            + '<div class="date-expires">' + _self.properties.lang.expires + ' <div>'
                            + data.group[id].date_expired
                            + '</div></div>');
                    $(_self.properties.dataAction.membershipChange + '[data-id_user="' + id + '"]').each(function (index) {
                        $(this).data('groups', data.group[id].group_gid);
                        $(this).data('days', data.group[id].left_str);
                    });

                }
            }
        );
    };

    this.choiseMembership = function (obj) {
        _self.membershipChange(obj);
    };

    this.getSelectedUsers = function () {
        var data = [];
        $(_self.properties.class.grouping + ':checked').each(function (i) {
            data[i] = $(this).val();
        });
        return data;
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

}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.AdminAccessPermissions = AdminAccessPermissions;
}
