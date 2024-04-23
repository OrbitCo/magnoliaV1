function InstallLocations(optionArr)
{
    'use strict';
    this.properties = {
        siteUrl: null,
        data: {
            action: {
                checkAll: '[data-action="check-all"]',
                btnInstall: '[data-action="btn-install"]',
                getRegions: '[data-action="get-regions"]'
            }
        },
        url: {
            installRegions: 'admin/countries/ajax_install_regions/',
            getRegions: 'admin/countries/ajax_get_regions/'
        },
        lang:{},
        errorObj: new Errors(),
        contentObj: null
    }

    const _self = this;
    const _p = {};
    const request = new XMLHttpRequest();

    this.Init = (options) => {
        _self.properties = $.extend(_self.properties, options);
        _self.initControls();
        _self.map();
        _self.properties.contentObj = new loadingContent({
            loadBlockWidth: '800px',
            closeBtnClass: 'w',
            loadBlockTopType: 'top',
            loadBlockTopPoint: 20,
            blockBody: true,
            footerButtons: '<a class="btn btn-primary" data-action="btn-install" href="javascript:void(0)">' + _self.properties.lang.field.countriesInstallLink + '</a>',
        })
    }

    this.initControls = () => {
        $(document)
            .off('change', _self.properties.data.action.checkAll).on('change', _self.properties.data.action.checkAll, function () {
                _self.checkRegion(this);
            }).off('click', _self.properties.data.action.btnInstall).on('click', _self.properties.data.action.btnInstall, function () {
                _self.installRegions(this);
            }).off('click', _self.properties.data.action.getRegions).on('click', _self.properties.data.action.getRegions, function () {
                let country = $(this).data('country');
                _self.getRegions(country, true);
            });
    }

    this.checkRegion = (obj) => {
        if ($(obj).is(':checked')) {
            $('.grouping').iCheck('check');
        } else {
            $('.grouping').iCheck('uncheck');
        }
    }

    this.installRegions = () => {
        if ($('.grouping:checked').length === 0) {
            _self.properties.errorObj.show_error_block(_self.properties.lang.error.headerRegionSelect, 'error');
            return false;
        }
        let country = '', region = [];
        $('.region-js').each((index, value) => {
            if ($(value).is(':checked')) {
                country = $(value).data('country');
                let id_region = $(value).val();
                region.push(id_region);
            }
        });
        _p.query(
            _self.properties.url.installRegions,
            {country_code: country, region: region},
            'json',
            (data) => {
                for (let i in data.install_regions) {
                    if (data.install_regions[i]['status']) {
                        //$('#item_' + country + '_' + data[i]['id']).remove();
                        $('#item_' + country + '_' + data.install_regions[i]['id'] + ' .icheckbox_flat-green').remove();
                        $('#item_' + country + '_' + data.install_regions[i]['id']).append('<i class="fa fa-check green lg"></i>');
                        let region_name = $('#item_' + country + '_' + data.install_regions[i]['id'] + ' .region_name').text();
                        _self.properties.errorObj.show_error_block(region_name + ' - ' + _self.properties.lang.field.countryInstalled, 'info');
                    }
                }
                //$('#country_' + country).find('.fa-plus').removeClass('fa-plus').addClass('fa-check');
                //console.log( Object.keys(data.install_regions).length)
                if ($('.grouping').length === 0) {
                    //$('.regions_install').html('<div class="text-center">' + _self.properties.lang.field.countryInstalled + '</div>');
                    _self.properties.contentObj.hide_load_block();
                    _self.properties.errorObj.show_error_block($('[data-country="' + country + '"] .country_name').text() + ' - ' +  _self.properties.lang.field.countryInstalled, 'success');
                    $('[data-country="' + country + '"]').attr('data-action', '');
                    $('[data-country="' + country + '"]' + ' .sparkline_discreet').hide();
                    $('[data-country="' + country + '"]' + ' .sparkline_discreet').before('<i class="fa fa-check green lg"></i>')
                }
            }
        );
    }

    this.getRegions = (country, is_select) => {
        if (is_select === true) {
            $('#vmap').vectorMap('select', country);
        }
        let formData = {country_code: country};
        _p.query(
            _self.properties.url.getRegions,
            formData,
            'JSON',
            function (data) {
                _self.properties.contentObj.show_load_block(data.content);
            }
        );
    }

    this.map = () => {
        if (typeof ($.fn.vectorMap) === 'undefined') {
            return;
        }

        if ($('#vmap').length) {
            $('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#32b44a',
                enableZoom: false,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#E6F2F0', '#149B7E'],
                normalizeFunction: 'polynomial',
                onRegionClick: function (element, code, region) {
                    _self.getRegions(code.toUpperCase(), false);
                }
            });
        }
    }

    _p.query = (url, data, dataType, cb) => {
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
                if (typeof (cb) !== 'undefined') {
                    cb(data);
                }
            }
        });
        return false;
    };

    _self.Init(optionArr);

    return this;
}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.InstallLocations = InstallLocations;
}
