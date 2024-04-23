"use strict";

function NearestUsers(optionArr)
{

    this.properties = {
        siteUrl: '',
        hide_map: 0,
        map_height: 400,
        id_map_form: 'nearest_users_map_form',
        id_show_map_link: 'show_map_link',
        id_hide_map_link: 'hide_map_link',
        ajax_save_map_view_url: 'nearest_users/ajaxSaveMapView/',
    };

    var _self = this;

    this.Init = function (options) {
        _self.prop = $.extend(_self.properties, options);

        if (_self.prop.hide_map == 1) {
            $('#' + _self.prop.id_map_form).hide();
        }

        _self.init_controls();
    };

    this.init_controls = function () {

        $('#' + _self.prop.id_show_map_link).on('click', function () {
            _self.showMap();
        });

        $('#' + _self.prop.id_hide_map_link).on('click', function () {
            _self.hideMap();
        });
    };

    this.showMap = function () {
        $('#' + _self.prop.id_map_form).show();
        $('#' + _self.prop.id_show_map_link).addClass("hide");
        $('#' + _self.prop.id_hide_map_link).removeClass("hide");
        _self.prop.hide_map = 0;

        $.ajax({
            type: 'POST',
            url: site_url + _self.prop.ajax_save_map_view_url + _self.prop.hide_map,
            success: function (data) {
            }
        });
    }

    this.hideMap = function () {
  //      $('#' + _self.prop.id_map_form).height(0);
        $('#' + _self.prop.id_map_form).hide();
        $('#' + _self.prop.id_hide_map_link).addClass("hide");
        $('#' + _self.prop.id_show_map_link).removeClass("hide");
        _self.prop.hide_map = 1;

        $.ajax({
            type: 'POST',
            url: site_url + _self.prop.ajax_save_map_view_url + _self.prop.hide_map,
            success: function (data) {
            }
        });
    }

    _self.Init(optionArr);

}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.NearestUsers = NearestUsers;
}
