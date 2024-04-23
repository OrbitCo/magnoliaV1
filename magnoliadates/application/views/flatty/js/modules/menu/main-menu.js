'use strict'
function mainMenu(optionArr)
{
    
    this.properties = {
        siteUrl: '',
        slidemenu: '#slidemenu',
        slidemenuId: '#slidemenu-outer',
        closeBtnId: '#slidemenu-close',
        pjaxcontainer: '#pjaxcontainer',
        buttonDropdownMenu: 'button.dropdown-toggle',
        dropdownMenu: '.dropdown-menu',
        dataSlidemenu: '[data-slidemenu="#slidemenu"]'
    };
    
    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);

        if (lightGetCookie('statusMainMenu') === 'open') {
            $(_self.properties.slidemenu).show();
            $(_self.properties.slidemenuId).show();
        }
        
        $(document).off('click', _self.properties.pjaxcontainer).on('click', _self.properties.pjaxcontainer, function (event) {
            if ($(event.target).closest(_self.properties.slidemenu).length === 0 &&
                    $(event.target).closest(_self.properties.slidemenuId).length === 0&&
                    $(event.target).closest(_self.properties.dataSlidemenu).length === 0) {
                _self.hideMainMenu();
            }
        }).off('click', _self.properties.buttonDropdownMenu).on('click', _self.properties.buttonDropdownMenu, function () {
            _self.dropdownPosition($(this));
        }).off('click', _self.properties.dataSlidemenu).on('click', _self.properties.dataSlidemenu, function () {
            _self.showMainMenu();
        }).off('click', _self.properties.closeBtnId).on('click', _self.properties.closeBtnId, function () {
            _self.hideMainMenu();
        });
    };
    
    this.uninit = function () {
        $(document)
                .off('click', _self.properties.buttonDropdownMenu)
                .off('click', _self.properties.dataSlidemenu)
                .off('click', _self.properties.closeBtnId);
        return this;
    };
    
    this.showMainMenu = function () {
        $(_self.properties.slidemenu).show();
        $(_self.properties.slidemenuId).show();
        _self.delMenuCookie();
        //lightSetCookie('statusMainMenu', 'open');
        return this;
    };
    
    this.hideMainMenu = function () {
        $(_self.properties.slidemenuId).hide();
        _self.delMenuCookie();
        //lightSetCookie('statusMainMenu', 'closed');
        return this;
    };
    
    this.dropdownPosition = function (obj) {
        var indent = parseInt($(window).height() - ($(obj).offset().top - $(window).scrollTop()));
        var heightEl = parseInt($(obj).siblings(_self.properties.dropdownMenu).height());
        if (indent < heightEl) {
            var marginTop = heightEl + 50;
            $(obj).siblings(_self.properties.dropdownMenu).css('margin-top', '-' + marginTop + 'px');
        } else {
            $(obj).siblings(_self.properties.dropdownMenu).css('margin-top', '2px');
        }
        return this;
    };
    
    this.delMenuCookie = function () {
        var expiresDate = new Date();
        expiresDate.setTime(expiresDate.getTime() - 1);
        document.cookie = "statusMainMenu=;expires=" + expiresDate.toGMTString();
    }
    
    _self.Init(optionArr);

    return _self;
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.mainMenu = mainMenu;
}
