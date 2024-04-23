/* global site_rtl_settings */
function usersSettings(optionArr)
{
    'use strict';
    this.properties = {
        siteUrl: '',
        guest_view_profile_allow_id: '#guest_view_profile_allow',
        guest_view_profile_allow: {},
        guest_view_profile_limit_id: '#guest_view_profile_limit',
        guest_view_profile_limit: {},
        guest_view_profile_num_id: '#guest_view_profile_num',
        guest_view_profile_num: {},
        servicesMenuTemplate: '#services-menu_template',
        availableData: '',
        getChangeLocationForm: 'users/getChangeLocationForm',
        setChangeLocationForm: 'users/setChangeLocationForm',
        getAvailableActivation: 'users/getAvailableActivation/',
        setUserIds: 'users/set_user_ids',
        dataChangeProfile: '[data-change=profile]',
        dataChangeLocation: '[data-change=location]',
        dataChangeAvatar: '[data-change=user-avatar]',
        changeUserPhotoBlock: '#user_photo_block',
        changeLocationBlock: '#change-location-block',
        saveLocationBlock: '#save-location-block',
        fieldInfo: '.owner-actions .field-block',
        iAgreeTerms: '#i_agree_terms',
        servicesMenu: '#services-menu',
        customSelect: '.custom-select',
        errorObj: new Errors,
        avatarObj: '',
        class:{
            dropdown: '.dropdown',
            popover: '.popover',
            loadContentBg: '.load_content_bg',
            staticAlertBlock: '.static-alert-block',
            availableBlock: '.available-block',
            wrapBlock: '.wrap-block',
            fixOverflow: '.fix-overflow-js',
            scrollToTop: '.scroll-to-top'
        },
        user: {},
        url: {
            getUserField: 'users/getUserField',
            setUserField: 'users/setUserField',
            isActiveService: 'users/isActiveService',
            profileEdit: 'users/profile/personal',
            iAgreeTerms: 'users/i_agree_terms',
            removeAvatar: 'users/upload_avatar',
        },
        langs: {},
        data: {
            fieldActionChange: '[data-fieldaction="change"]',
            fieldActionClick: '[data-fieldaction="click"]',
            fieldLocation: '[data-field="location"]',
            fieldIdCountry: '[data-change="id_country"]',
            fieldIdRegion: '[data-change="id_region"]',
            changeField: '[data-action="change-field"]',
            profileAvailable: '[data-action="profile_available"]',
            activateProfile: '[data-block="activate-profile"]',
            actions: {
                setUserIds: '[data-action="set_user_ids"]',
                setUserMenuActions: '[data-action="set-user_menu_actions"]',
                removeAvatar: '[data-action="remove-avatar"]'
            }
        },
        availableActivationData: {
            birth_date: 'data-change="profile"',
            location: 'data-change="location"',
            id_country: 'data-change="id_country"',
            id_region: 'data-change="id_region"',
            nickname: 'data-change="profile"',
            user_logo: 'data-change=user-avatar',
            user_type: 'data-change="profile"',
            looking_user_type: 'data-change="profile"',
        },
        contentObj: new loadingContent({
            loadBlockWidth: '400px',
            loadBlockLeftType: 'center',
            loadBlockTopType: 'top',
            loadBlockTopPoint: 100,
            closeBtnClass: 'w'
        })
    };

    var _self = this;
    var _offsetData = [
        'col-xs-12 col-sm-12 col-md-12 col-lg-12',
        'col-xs-12 col-sm-6 col-md-6 col-lg-6',
        'col-xs-12 col-sm-6 col-md-4 col-lg-4',
        'col-xs-12 col-sm-6 col-md-4 col-lg-3',
        'col-xs-12 col-sm-6 col-md-4 col-lg-3'
    ];
    let temp = {};


    var getObjects = function () {
        _self.properties.guest_view_profile_allow = $(_self.properties.guest_view_profile_allow_id);
        _self.properties.guest_view_profile_limit = $(_self.properties.guest_view_profile_limit_id);
        _self.properties.guest_view_profile_num = $(_self.properties.guest_view_profile_num_id);
    };

    var guestOptionsState = function () {
        if (_self.properties.guest_view_profile_allow.is(':checked')) {
            _self.properties.guest_view_profile_limit
                    .attr('disabled', null);
        } else {
            _self.properties.guest_view_profile_limit
                    .attr('disabled', 'disabled')
                    .attr('checked', null);
        }
        if (_self.properties.guest_view_profile_limit.is(':checked')) {
            _self.properties.guest_view_profile_num
                    .attr('disabled', null);
        } else {
            _self.properties.guest_view_profile_num
                    .attr('disabled', 'disabled')
                    .val(0);
        }
    };

    var bindEvents = function () {
        _self.properties.guest_view_profile_allow.on('change', function () {
            guestOptionsState();
        });
        _self.properties.guest_view_profile_limit.on('change', function () {
            guestOptionsState();
        });
        if (_self.properties.servicesMenu.length > 0) {
            if (typeof ($.fn.popover) == 'undefined') {
                //$('head').append('<script type="text/javascript" src="' + site_url + 'application/js/bootstrap/bootstrap.min.js"></script>');
            }

            $(_self.properties.servicesMenu).popover({
                placement: 'bottom',
                html: true,
                content: function () {
                    if (typeof temp.servicesMenuClone === 'undefined') {
                        temp.servicesMenuClone = $($('#services-menu_template .menu-actions')).clone(true);
                    }

                    return temp.servicesMenuClone
                }
            });
            $(_self.properties.servicesMenu).on('show.bs.popover', function () {
                $(_self.properties.class.fixOverflow).removeClass('media');
                $('.photo-action-js').width('');
                $(_self.properties.class.scrollToTop).hide().css('bottom', '25px');
            });
            $(_self.properties.servicesMenu).on('hide.bs.popover', function () {
                $(_self.properties.class.fixOverflow).addClass('media');
                $(_self.properties.class.scrollToTop).css('bottom', '0px');
            });
        }
    };

  this.customSelectEvent = function (){

    setTimeout(()=>{
      $(_self.properties.customSelect+ ' input').off().on('click', function () {
        let label = $(this).closest('label');
        if (this.checked){
          label.addClass('label-active')
        }else {
          label.removeClass('label-active')
        }

      });
    },0);

  }

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.init_controls();
        if (typeof available_view !== 'undefined') {
            _self.properties.usersProfileAvailableView = new available_view({
                siteUrl: site_url
            });
        }
        getObjects();
        bindEvents();
        guestOptionsState();
    };

    this.uninit = function () {
        $(document)
                .off('click', '.' + _self.properties.dataChangeLocation)
                .off('click', '.' + _self.properties.saveLocationBlock)
                .off('click', _self.properties.fieldInfo)
                .off('click', _self.properties.data.fieldActionChange)
                .off('click', _self.properties.data.fieldActionClick)
                .off('click', _self.properties.servicesMenu);
        return this;
    };

    this.init_controls = function () {
        $(document).off('mouseup', 'body').on('mouseup', 'body', function (e) {
            _self.closeFields(e);
        }).off('click', _self.properties.dataChangeLocation).on('click', _self.properties.dataChangeLocation, function () {
            _self.changeLocation();
        }).off('click', _self.properties.saveLocationBlock).on('click', _self.properties.saveLocationBlock, function () {
            _self.saveLocation();
        }).off('click', _self.properties.data.changeField).on('click', _self.properties.data.changeField, function () {
            _self.changeFieldInfo(this);
        }).off('change', _self.properties.data.fieldActionChange).on('change', _self.properties.data.fieldActionChange, function () {
            _self.saveFieldInfo(this, true);
        }).off('click', _self.properties.data.fieldActionClick).on('click', _self.properties.data.fieldActionClick, function () {
            _self.saveFieldInfo(this, true);
        }).off('click', _self.properties.data.fieldLocation + ' i').on('click', _self.properties.data.fieldLocation + ' i', function () {
            _self.saveFieldInfo(this, true);
        }).off('click', _self.properties.servicesMenu).on('click', _self.properties.servicesMenu, function () {
            _self.servicesMenuToogle(this);
        }).off('click', _self.properties.data.profileAvailable).on('click', _self.properties.data.profileAvailable, function () {
            _self.changeProfileAvailable(this);
        }).off('click', _self.properties.dataChangeProfile).on('click', _self.properties.dataChangeProfile, function () {
            locationHref(_self.properties.siteUrl + _self.properties.url.profileEdit);
        }).off('click', _self.properties.dataChangeAvatar).on('click', _self.properties.dataChangeAvatar, function () {
            _self.loadAvatar();
        }).off('click', _self.properties.data.fieldIdCountry).on('click', _self.properties.data.fieldIdCountry, function () {
            _self.changeLocation();
        }).off('click', _self.properties.data.fieldIdRegion).on('click', _self.properties.data.fieldIdRegion, function () {
            _self.changeLocation();
        }).off('click', _self.properties.iAgreeTerms).on('click', _self.properties.iAgreeTerms, function () {
            _self.iAgreeTerms();
        }).off('mouseenter', _self.properties.changeUserPhotoBlock).on('mouseenter', _self.properties.changeUserPhotoBlock, function () {
            $(_self.properties.dataChangeAvatar).removeClass('hide');
            $(_self.properties.data.actions.removeAvatar).removeClass('hide');
        }).off('mouseleave', _self.properties.changeUserPhotoBlock).on('mouseleave', _self.properties.changeUserPhotoBlock, function () {
            $(_self.properties.dataChangeAvatar).addClass('hide');
            $(_self.properties.data.actions.removeAvatar).addClass('hide');
        }).off('click', _self.properties.data.actions.setUserIds).on('click', _self.properties.data.actions.setUserIds, function (e) {
            _self.setUserIds(this, e);
        }).off('click', _self.properties.data.actions.setUserMenuActions).on('click', _self.properties.data.actions.setUserMenuActions, function () {
            _self.setUserMenuActions();
        }).off('click', _self.properties.data.actions.removeAvatar).on('click', _self.properties.data.actions.removeAvatar, function () {
            _self.removeAvatar();
        });
    };

    this.removeAvatar = function () {
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.url.removeAvatar,
            type: 'POST',
            data: {user_icon_delete: 1},
            dataType: 'json',
            cache: false,
            success: function (resp) {
                if (typeof resp.errors !== 'undefined' && resp.errors.length) {
                    _self.properties.errorObj.show_error_block(resp.errors, 'error');
                } else {
                    $(_self.properties.data.actions.removeAvatar).remove();
                    $('#user_photo').html('<img src="' + resp.logo.file_url + '">');
                }
            }
        });
    };

    this.setUserMenuActions = function () {
            $(_self.properties.servicesMenu).click();
    };

    this.setUserIds = function (obj, e) {
        e.preventDefault();
        var gid = $(obj).data('gid');
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.setUserIds,
            type: 'POST',
            cache: false,
            data: {gid: gid},
            dataType: 'json',
            success: function () {
                locationHref($(obj).data('href'));
            }
        });
    };

    this.closeFields = function (event) {
        if ($(event.target).closest(_self.properties.data.changeField).length === 0 &&
                $(event.target).closest(_self.properties.class.dropdown).length === 0 &&
                $(event.target).closest(_self.properties.class.loadContentBg).length === 0) {
            $('.edit-field-js').each(function () {
                _self.saveFieldInfo($(this).find('.field-info'), false);
            });
        }
    };

    this.servicesMenuToogle = function (item) {
        const shift = $('div.popover').css('left');
        if (site_rtl_settings === 'rtl') {
            $('div.popover').css({'right': shift, 'left':'0'});
        }
    };

    this.saveFieldInfo = function (item, save) {
        if (typeof $(item).closest('.edit-field-js').data('field') == 'undefined') {
            return;
        }
        let data = $(item).closest('.edit-field-js').find('input[name],select[name],textarea[name]').serialize();

        const field_name = $(item).closest('.edit-field-js').data('field');
        data += (save === true) ? '&save=1' : '&save=0';
        data += '&field_name=' + field_name;

        $.ajax({
            url: _self.properties.siteUrl + _self.properties.url.setUserField,
            type: 'post',
            cache: false,
            data: data,
            dataType: 'json',
            success: function (data) {
                if (typeof data.errors !== 'undefined' && data.errors.length !== 0) {
                    _self.properties.errorObj.show_error_block(data.errors, 'error');
                    return false;
                }
                if (typeof data.data !== 'undefined') {
                    sendAnalytics('dp_user_profile_btn_edit_field', 'my_profile', 'user');
                    $(item).closest('.edit-field-js').removeClass('edit-field-js');
                    $(item).closest('.field-info').html(function () {
                        if (data.data === null) {
                            data.data = '';
                        }
                        if (data.data === '') {
                            data.data = '<p class="example-fields">' + data.example + '</p>';
                        }
                        if (typeof data.couple !== 'undefined') {
                            return data.data + '&nbsp;|&nbsp;' + data.couple + '<i class="fas fa-pencil-alt"></i>';
                        } else {
                            if (field_name === 'location') {
                                $(_self.properties.dataChangeLocation).html(function () {
                                    var loc_val = (data.data.length !== 0) ? data.data : _self.properties.langs.link_select_region;
                                    return'<i class="fas fa-map-marker-alt"></i>&nbsp;' + loc_val;
                                });
                            }
                            return data.data + '<i class="fas fa-pencil-alt"></i>';
                        }
                    });
                } else if (typeof data.couple !== 'undefined' && data.couple.length !== 0) {
                    $(item).closest('.edit-field-js').removeClass('edit-field-js');
                    $(item).closest('.field-info').html(function () {
                        if (typeof data.couple !== 'undefined') {
                            return data.couple + '<i class="fas fa-pencil-alt"></i>';
                        }
                    });
                }


                if (typeof data.status !== 'undefined') {
                    _self.properties.errorObj.show_error_block(data.msg, data.status);
                }
            }
        });
    };

    this.changeFieldInfo = function (item) {
        if ($(item).hasClass('edit-field-js') === false) {
            _self.queryField(item);
        }
    };

    this.createElement = function (item, obj) {
        $(item).find('.field-info').html(function (index, oldhtml) {
            $(item).addClass('edit-field-js');
            var htmlObj = '<div class="hide">' + oldhtml + '</div>';
            if (obj.type === 'text') {
                if (typeof obj.data.couple !== 'undefined') {
                    htmlObj += '<div class="col-xs-6">' + _self.inputText($(item).data('field'), obj.data.value) + '</div>';
                    htmlObj += '<div class="col-xs-6">' + _self.inputText($(item).data('field') + '_couple', obj.data.couple.value) + '</div>';
                } else {
                    htmlObj += '<div class="col-xs-12">' + _self.inputText($(item).data('field'), obj.data.value) + '</div>';
                }
            } else if (obj.type === 'text|text') {
                if (Object.keys(obj.data).length == 1) {
                    for (var key in obj.data) {
                        if (typeof obj.data[key].couple !== 'undefined') {
                            htmlObj += '<div class="col-xs-6">\n\
                                                <label>' + obj.data[key].name + ':</label>'
                                                + _self.inputText(obj.data[key].field, obj.data[key].value) + '</div>';
                            htmlObj += '<div class="col-xs-6">\n\
                                                <label>' + obj.data[key].couple.name + ':</label>'
                                                + _self.inputText(obj.data[key].couple.field, obj.data[key].couple.value) + '</div>';
                        } else {
                            htmlObj += '<div class="col-xs-12">\n\
                                                <label>' + obj.data[key].name + ':</label>'
                                                + _self.inputText(obj.data[key].field, obj.data[key].value) + '</div>';
                        }
                    }
                } else {
                    htmlObj += '<div class="input__input-group">';
                    for (var key in obj.data) {
                        if (typeof obj.data[key].couple !== 'undefined') {
                            htmlObj += '<div class="col-xs-6">\n\
                                                <label>' + obj.data[key].name + ':</label>'
                                                + _self.inputText(obj.data[key].field, obj.data[key].value, 0) + '</div>';
                            htmlObj += '<div class="col-xs-6">\n\
                                                <label>' + obj.data[key].couple.name + ':</label>'
                                                + _self.inputText(obj.data[key].couple.field, obj.data[key].couple.value, 0) + '</div>';
                        } else {
                            htmlObj += '<div class="col-xs-12">\n\
                                                <label>' + obj.data[key].name + ':</label>'
                                                + _self.inputText(obj.data[key].field, obj.data[key].value, 0) + '</div>';
                        }
                    }
                    htmlObj += '<div class="col-xs-12 mt5">' + _self.inputTextBtn() + '</div></div>';
                }
            } else if (obj.type === 'autocomplete') {
                htmlObj += '<div class="col-xs-12">' + _self.inputTextAutocomplete($(item).data('field'), obj.data.value) + '</div>';
            } else if (obj.type === 'select') {
                if (Object.keys(obj.data.value).length == 1) {
                    for (var key in obj.data.value) {
                        if (key === 'age_min' || key === 'age_max') {
                            htmlObj += '<div class="col-xs-6">';
                        } else {
                            htmlObj += '<div class="col-xs-12 mb5">';
                        }
                        let setting = obj.data.settings ? obj.data.settings[key] : null;
                        htmlObj += _self.selectElement(key, obj.data.value[key], obj.data.option[key], false, 1, obj.data.sort,undefined,setting) + '</div>';
                    }
                } else {
                    htmlObj += '<div class="select__input-group">';
                    for (var key in obj.data.value) {
                        if (key === 'age_min' || key === 'age_max') {
                            htmlObj += '<div class="col-xs-6">';
                        } else {
                            htmlObj += '<div class="col-xs-12 mb5">';
                        }
                        htmlObj += _self.selectElement(key, obj.data.value[key], obj.data.option[key], false, 0) + '</div>';
                    }
                    htmlObj += '<div class="col-xs-12 mt5">' + _self.selectElementBtn(false) + '</div></div>';
                }
            } else if (obj.type === 'multiselect') {
                if (typeof obj.data.couple !== 'undefined') {
                    for (var key in obj.data.couple.value) {
                        htmlObj += '<div class="col-xs-12 mb5">';
                        htmlObj += _self.selectElement(key + '[]', obj.data.couple.value[key], obj.data.couple.option[key], 'multiple', 1, obj.data.sort, obj.view_type);
                        htmlObj += '</div>';
                    }
                } else {
                    for (var key in obj.data.value) {
                        htmlObj += '<div class="col-xs-12 mb5">';
                        htmlObj += _self.selectElement(key + '[]', obj.data.value[key], obj.data.option[key], 'multiple', 1, obj.data.sort, obj.view_type);
                        htmlObj += '</div>';
                    }
                }
            } else if (obj.type === 'textarea') {
                if (typeof obj.data.couple !== 'undefined') {
                    htmlObj += '<div class="col-xs-6">' + _self.textArea($(item).data('field'), obj.data.value) + '</div>';
                    htmlObj += '<div class="col-xs-6">' + _self.textArea($(item).data('field') + '_couple', obj.data.couple.value) + '</div>';
                } else {
                    htmlObj += '<div class="col-xs-12">' + _self.textArea($(item).data('field'), obj.data.value) + '</div>';
                }
            } else if (obj.type === 'datepicker') {
                if (typeof obj.data.couple !== 'undefined') {
                    htmlObj += '<div class="col-xs-12">' + _self.datePicker($(item).data('field'), obj.data.value) + '</div>';
                    htmlObj += '<div class="col-xs-12">' + _self.datePicker($(item).data('field') + '_couple', obj.data.couple.value, '_couple') + '</div>';
                } else {
                    htmlObj += '<div class="col-xs-12">' + _self.datePicker($(item).data('field'), obj.data.value) + '</div>';
                }
            } else if (obj.type === 'checkbox') {
                if (typeof obj.data.couple !== 'undefined') {
                    htmlObj += '<div class="col-xs-6">' + _self.checkbox($(item).data('field'), obj.data.value) + '</div>';
                    htmlObj += '<div class="col-xs-6">' + _self.checkbox($(item).data('field') + '_couple', obj.data.couple.value) + '</div>';
                } else {
                    htmlObj += '<div class="col-xs-12">' + _self.checkbox($(item).data('field'), obj.data.value) + '</div>';
                }
            } else if (obj.type === 'range') {
                if (typeof obj.data.couple !== 'undefined') {
                    htmlObj += '<div class="col-xs-12">' + _self.range($(item).data('field'), obj.data.value) + '</div>';
                    htmlObj += '<div class="col-xs-12">' + _self.range($(item).data('field') + '_couple', obj.data.couple.value) + '</div>';
                } else {
                    htmlObj += '<div class="col-xs-12">' + _self.range($(item).data('field'), obj.data.value) + '</div>';
                }
            }
            return htmlObj;
        });
        if (obj.type === 'datepicker') {
            if (typeof obj.data.couple !== 'undefined') {
                _self.formatDPickerField(obj.data.value);
                _self.formatDPickerField(obj.data.couple.value, '_couple');
            } else {
                _self.formatDPickerField(obj.data.value);
            }
        }
    };

    this.datePicker = function (name, value, postfix) {
        postfix = (typeof postfix === 'undefined') ? '' : postfix;
        var htmlObj = '<div class="input-group">\n\
                                    <div id="datepicker' + postfix + '" class="hidden"></div>\n\
                                    <input type="text" value="' + value + '" name="' + name + '" class="form-control hidden">\n\
                                    <button class="btn btn-default" type="button" data-fieldaction="click">' + _self.properties.langs.save + '</button>\n\
                                </div>';
        return htmlObj;
    };

    this.range = function (name, value) {
        return '<div class="input-group">\n\
                        <div class="col-xs-12 col-sm-9">\n\ ' + value + '</div>\n\
                        <div class="col-xs-12 col-sm-3">\n\
                            <button class="btn btn-default" type="button" data-fieldaction="click">' + _self.properties.langs.save + '</button>\n\
                        </div>\n\
                    </div>';
    };

    this.formatDPickerField = function (value, postfix) {
        postfix = (typeof postfix === 'undefined') ? '' : postfix;
        var now = new Date();
        var yr = (new Date(now.getFullYear() - _self.properties.user.age_max, 0, 1).getFullYear()) + ':' +
        (new Date(now.getFullYear() - _self.properties.user.age_min, 0, 1).getFullYear());
        $("#datepicker" + postfix).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            yearRange: yr
        });
        new DatepickerDropdownTemplate({
            setDate: value,
            dateFormat: _self.properties.user.dateFormat,
            inputName: 'birth_date' + postfix,
            postfix: postfix
        });
    };

    this.selectElement = function (name, value, options, multiple, saveBtn, sort, view_type,settings) {

        let emptyOption = (settings && settings.empty_option != undefined)  ? settings.empty_option : null;
        let isSelected;
        if (saveBtn == undefined) {
            saveBtn = 1;
        }
        let sort_opt = {};
        for (let key in sort) {
            sort_opt[key] = options[sort[key]];
        }

        if (name.indexOf('field') !== -1) {
            options = sort_opt;
        }

        let htmlObj = '<div class="input-group">';
        if (view_type != undefined && view_type == 'checkbox') {
            htmlObj += '<input type="hidden" name="' + name + '" value="0"/>';
            for (let key in options) {
                isSelected = '';
                if (Array.isArray(value) === true) {
                    for (let k in value) {
                        if (value[k] == sort[key]) {
                            isSelected = 1;
                        }
                    }
                } else {
                    if (name.indexOf('field') !== -1) {
                        isSelected = (value == sort[key]) ? 1 : '';
                    } else {
                        isSelected = (value == key) ? 1 : '';
                    }
                }

                let val = null;

                if (name.indexOf('field') !== -1) {
                     val = sort[key];
                } else {
                     val = key;
                }

                let field_name = name.replace('[]', '_');
                htmlObj += _self.multiCheckbox(name, isSelected, options[key], val);
            }
        } else {
          if (multiple == 'multiple'){

            htmlObj += '<div class="custom-select"><input type="hidden" name="' + name + '" value="0"/>';

            for (let key in options) {
              isSelected = '';
              if (Array.isArray(value) === true) {
                for (let k in value) {
                  if (value[k] == sort[key]) {
                    isSelected = 1;
                  }
                }
              } else {
                if (name.indexOf('field') !== -1) {
                  isSelected = (value == sort[key]) ? 1 : '';
                } else {
                  isSelected = (value == key) ? 1 : '';
                }
              }
              let val = '';
              if (name.indexOf('field') !== -1) {
                val = sort[key];
              } else {
                val = key;
              }

              let isChecked = (isSelected ===  1) ? 'checked' : '';
              let isClass = (isSelected ===  1) ? 'label-active' : '';
              htmlObj +=  '<label class="'+isClass+'" for="'+name + val + '">' +
                '<input  id="' + name + val + '" type="checkbox" name="' + name + '" value="' + val + '" ' + isChecked + '>' + options[key] + '</label>';
            }
            htmlObj += '</div>';

          }else {
            htmlObj += '<select name="' + name + '" class="form-control">';
            if (emptyOption && !multiple) {
              htmlObj += '<option  value=" ">...</option>';
            }
            for (let key in options) {
              isSelected = '';
              if (Array.isArray(value) === true) {
                for (let k in value) {
                  if (value[k] == sort[key]) {
                    isSelected = 'selected';
                  }
                }
              } else {
                if (name.indexOf('field') !== -1) {
                  isSelected = (value == sort[key]) ? 'selected' : '';
                } else {
                  isSelected = (value == key) ? 'selected' : '';
                }
              }

              let val
              if (name.indexOf('field') !== -1) {
                val = sort[key];
              } else {
                val = key;
              }

              if (name === 'age_min' || name === 'age_max') {
                isSelected = (value == options[key]) ? 'selected' : '';
                val = options[key];
              }
              htmlObj += '<option ' + isSelected + ' value="' + val + '">' + options[key] + '</option>';
            }
            htmlObj += '</select>';
          }
        }

        if (saveBtn === 1) {
            if (multiple !== 'multiple') {
                htmlObj += '<span class="input-group-btn">\n\
                    <button class="btn btn-default"  type="button" data-fieldaction="click">' + _self.properties.langs.save + '</button>\n\
               </span>';
            } else {
                if (view_type != undefined && view_type == 'checkbox') {
                    htmlObj += '<span data-fieldaction="click" class="mt10 btn btn-default">' + _self.properties.langs.save + '</span>';
                } else {
                    htmlObj += '<span data-fieldaction="click" class="input-group-addon btn btn-default">' + _self.properties.langs.save + '</span>';
                }
            }
        }

        htmlObj += '</div>';
          _self.customSelectEvent(this);
        return htmlObj;
    };

    this.selectElementBtn = function (multiple) {
        var htmlObj = '';
        if (multiple !== 'multiple') {
            htmlObj += '<button class="btn btn-default" type="button" data-fieldaction="click">' + _self.properties.langs.save + '</button>';
        } else {
            htmlObj += '<span data-fieldaction="click" class="input-group-addon btn btn-default">' + _self.properties.langs.save + '</span>';
        }
        return htmlObj;
    };

    this.inputTextAutocomplete = function (name, value) {
        return value;
    };

    this.inputText = function (name, value, saveBtn) {
        if (saveBtn === undefined) {
            saveBtn = 1;
        }
        var htmlObj = '<div class="input-group">\n\
                        <input type="text" name="' + name + '" value="' + value + '" class="form-control">';
        if (saveBtn === 1) {
            htmlObj += '<span class="input-group-btn">\n\
                            <button class="btn btn-default" type="button" data-fieldaction="click">' + _self.properties.langs.save + '</button>' +
                        '</span>';
        }
        htmlObj += '</div>';
        return htmlObj;
    };

    this.inputTextBtn = function () {
        return '<button class="btn btn-default" type="button" data-fieldaction="click">' + _self.properties.langs.save + '</button>';
    };

    this.textArea = function (name, value) {
        return  '<div class="input-group">\n\
                        <textarea name="' + name + '" class="form-control custom-control" rows="3">' + value + '</textarea>\n\
                        <span data-fieldaction="click" class="input-group-addon btn btn-default">' + _self.properties.langs.save + '</span>\n\
                    </div>';
    };

    this.checkbox = function (name, value) {
        var isChecked = (value === '1') ? 'checked' : '';
        return  '<div class="input-group">\n\
                        <input type="hidden" name="' + name + '" value="0"/>\n\
                        <input type="checkbox" name="' + name + '" value="1" ' + isChecked + '>\n\
                        <span data-fieldaction="click" class="btn btn-default">' + _self.properties.langs.save + '</span>\n\
                    </div>';
    };

    this.multiCheckbox = function (name, value, option_name, option_val, field_name) {
        var isChecked = (value ===  1) ? 'checked' : '';
        return  '<div><input id="' + field_name + option_val + '" type="checkbox" name="' + name + '" value="' + option_val + '" ' + isChecked + '>\n\
        <label for="'+ field_name + option_val +'">'+ option_name +'</label></div>';
    };

    this.queryField = function (item) {
        $.ajax({
            url: _self.properties.siteUrl + _self.properties.url.getUserField,
            type: 'post',
            cache: false,
            data: {field: $(item).data('field')},
            dataType: 'json',
            success: function (data) {
                if (typeof data.errors !== 'undefined' && data.errors.length !== 0) {
                    _self.properties.errorObj.show_error_block(data.errors, 'error');
                    return false;
                }
                _self.createElement(item, data);
            }
        });
        return false;
    };

    this.changeLocation = function () {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: _self.properties.siteUrl + _self.properties.getChangeLocationForm,
            success: function (content) {
                if (typeof (content) !== 'undefined') {
                    _self.properties.contentObj.show_load_block(content);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            }
        });
    };

    this.saveLocation = function () {
        var post_data = {
            id_country: $(_self.properties.changeLocationBlock).find('[name=id_country]').val(),
            id_region: $(_self.properties.changeLocationBlock).find('[name=id_region]').val(),
            id_city: $(_self.properties.changeLocationBlock).find('[name=id_city]').val(),
            lat: $(_self.properties.changeLocationBlock).find('[name=lat]').val(),
            lon: $(_self.properties.changeLocationBlock).find('[name=lon]').val()
        };
        $.ajax({
            type: 'POST',
            data: post_data,
            dataType: 'JSON',
            url: _self.properties.siteUrl + _self.properties.setChangeLocationForm,
            success: function (data) {
                if (typeof (data.errors) != 'undefined' && data.errors != '') {
                    _self.properties.errorObj.show_error_block(data.errors, 'error');
                } else if (typeof (data.success) != 'undefined' && data.success != '') {
                    _self.properties.errorObj.show_error_block(data.success, 'success');
                    var locationName = $(_self.properties.changeLocationBlock).find('[name=region_name]').val() || ((typeof data.location !== 'undefined') ? data.location : _self.properties.langs.link_select_region);
                    $(_self.properties.dataChangeLocation).html('<i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;' + locationName);
                    $(_self.properties.data.fieldLocation + '>.field-info').html(locationName + '<i class="fas fa-pencil-alt"></i>');

                    if (data.data.id_region) {
                        _self.rebuild('location');
                    }
                }
                _self.properties.contentObj.hide_load_block();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (typeof (console) !== 'undefined') {
                    console.error(errorThrown);
                }
            }
        });
    };

    this.isTerms = function (terms) {
        var htmlObj = '<h1>' + _self.properties.langs.welcome + '</h1>';
        htmlObj += '<div class="form-group">' + terms + '</div>';
        htmlObj += '<div class="form-group"><button id="i_agree_terms" class="btn btn-primary">' + _self.properties.langs.btnIAgree + '</button></div>';
        _self.properties.contentObj.show_load_block(htmlObj);
    };

    this.iAgreeTerms = function () {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            data: {agree: 1},
            url: _self.properties.siteUrl + _self.properties.url.iAgreeTerms,
            success: function (data) {
                if (typeof data.success !== 'undefined') {
                    _self.properties.contentObj.hide_load_block();
                    _self.properties.errorObj.show_error_block(data.success, 'success');
                }
            }
        });
    }

    this.availableActivation = function () {
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: _self.properties.siteUrl + _self.properties.getAvailableActivation,
            success: function (data) {
                if (!$.isEmptyObject(data)) {
                    var obj = [
                        '<button type="button" class="close" data-action="close" data-cookie="available_activation" aria-hidden="true">&times;</button>',
                        '<h3>' + data.info.title + '</h3><div>' + data.info.subtitle + '</div>'
                    ];
                    if (typeof data.info.items !== 'undefined') {
                        var countBlocks = Object.keys(data.info.items).length;
                        var htmlObj = '';
                        for (var key in data.info.items) {
                            htmlObj += '<div class="' + _offsetData[countBlocks - 1] + ' wrap-block">' + _self.activationBlock(data.info.items[key], key) + '</div>';
                        }
                        htmlObj += '<div class="clearfix"></div>';
                        obj.push(htmlObj);
                        _self.properties.errorObj.showStaticErrorsblock(obj, 'info');
                    }
                }
            }
        });
    };

    this.activationBlock = function (data, field) {
        var htmlObj = "<div data-available='" + field + "' class='available-block'>";
              htmlObj += "<div><i class='fas fa-times-circle'></i></div>";
              htmlObj += "<div>" + data.text + "</div>";
        if (typeof data.button !== 'undefined' && data.button.length !== 0) {
            htmlObj += "<button " + _self.properties.availableActivationData[field] + " class='btn btn-primary'>" + data.button + "</button>";
        }
              htmlObj += "</div>";
              return htmlObj;
    };

    this.changeProfileAvailable = function (item) {
        _self.isActiveService(
            $(item).data('service'),
            function () {
                $(_self.properties.data.activateProfile).hide();
            },
            function () {
                _self.properties.usersProfileAvailableView.getPaymentForm(
                    $(item).data('service')
                );
            }
        );
    };

    this.isActiveService = function (gid, active, inactive) {
        $.ajax({
            type: 'POST',
            data: {gid: gid},
            dataType: 'JSON',
            url: _self.properties.siteUrl + _self.properties.url.isActiveService,
            success: function (data) {
                if (data.status === 0) {
                    active();
                    _self.properties.errorObj.show_error_block(data.success, 'success');
                } else {
                    inactive();
                }
            }
        });
    };

    this.loadAvatar = function () {
        if (typeof _self.properties.avatarObj.load_avatar !== 'undefined') {
            _self.properties.avatarObj.load_avatar(1);
        } else {
            $('.change-photo-button').trigger('click');
        }
    };

    this.rebuild = function (gid) {
        $('[data-available="' + gid + '"]').closest(_self.properties.class.wrapBlock).remove();
        var countBlocks = $(_self.properties.class.staticAlertBlock).find('.available-block').length;
        if (countBlocks === 0) {
            $(_self.properties.class.staticAlertBlock).remove();
        } else {
            $(_self.properties.class.wrapBlock).removeClass().addClass('wrap-block ' + _offsetData[countBlocks - 1]);
        }
    };

    _self.Init(optionArr);

}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.usersSettings = usersSettings;
}
