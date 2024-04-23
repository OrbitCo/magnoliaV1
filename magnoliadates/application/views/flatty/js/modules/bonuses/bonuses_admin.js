'use strict';

function BonusesAdmin(optionArr)
{

    this.properties = {
        siteUrl: ''
    }

    const _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);

        $(document).off('change', 'select[name="bonus_module"]').on('change', 'select[name="bonus_module"]', function () {
            _self.changePrize();
        }).off('change', 'select[name="action"]').on('change', 'select[name="action"]', function () {
            _self.initActionsType(false);
        });

    }

    this.showLangs = function (divId) {
        $('#' + divId).slideToggle();
    }

    this.refreshSelectors = function (config, is_edit) {
        _self.changePeriods(config.available_period);
        _self.changeAmount(config.once);
        _self.changeUnit(config.is_percent, is_edit);
    }

    this.changePrize = function () {
        const cur_prize = $('select[name="bonus_module"]').val();
        if (cur_prize == 'fill_bonus_account') {
            $("#fill_bonuses_amount").show();
            $("#account_days").hide();
        }
        if (cur_prize == 'get_premium_account') {
            $("#fill_bonuses_amount").hide();
            $("#account_days").show();
        }
    }

    this.changeUnit = function (flag, no_change_val) {
        if (flag === 1) {
            $('input[name="repetition"]').val('100');
            $('input[name="repetition"]').show();
            $('#bonus_percent').show();
            $('input[name="repetition"]').prop('max', '100');
            $("#bonus_times").hide();
        } else {
            if (!no_change_val) {
                $('input[name="repetition"]').val('1');
            }
            $('#bonus_percent').hide();
            $('input[name="repetition"]').prop('max', '1000');
        }
    }

    this.changeAmount = function (flag) {
        if (flag == 1) {
            $('input[name="repetition"]').val('1');
            $('input[name="repetition"]').hide();
            $("#bonus_times").hide();
        } else {
            $("#bonus_times").show();
            $('input[name="repetition"]').show();
        }
    }

    this.changePeriods = function (per) {
        var periods = JSON.parse(per);
        if (periods[0] == 'all') {
            $('select[name="period_type"]').find('option').each(function () {
                const value = $(this).val().toString();
                $('option[value="' + value + '"]').show();
            });
        } else {
            $('select[name="period_type"]').find('option').each(function () {
                const value = $(this).val().toString();
                if (-1 != $.inArray(value, periods)) {
                    $('option[value="' + value + '"]').show();
                } else {
                    $('option[value="' + value + '"]').hide();
                }
            });
        }
        $('select[name="period_type"]').find('option').each(function () {
            const value = $(this).val().toString();
            if ($('option[value="' + value + '"]').css('display') != 'none') {
                $('option[value="' + value + '"]').attr('selected', true);
                return false;
            }
        });
    }

    this.initActionsType = function (is_edit) {
        const cur_action = $('select[name="action"]').val();
        const config = JSON.parse($("#bonus_actions_config").attr('data'));
        for (conf in config) {
            if (config[conf]['action'] == cur_action) {
                _self.refreshSelectors(config[conf], is_edit);
            }
        }
    }

    _self.Init(optionArr);
}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.BonusesAdmin = BonusesAdmin;
}
