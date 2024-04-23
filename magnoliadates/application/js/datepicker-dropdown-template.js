'use strict';
function DatepickerDropdownTemplate(optionArr)
{

    this.properties = {
        id: {
            datepicker: '#datepicker',
            selectDay: '#daySelect',
            selectMonth: '#monthSelect',
            selectYear: '#yearSelect'
        },
        dataId: {
            datepicker: 'datepicker',
            selectDay: 'daySelect',
            selectMonth: 'monthSelect',
            selectYear: 'yearSelect'
        },
        langs: {
            defaultDay: 'Day',
            defaultMonth: 'Month',
            defaultYear: 'Year'
        },
        dataAction: {
            change: '[data-action="change-datepicker"]'
        },
        calendar: {
            day: false,
            month: false,
            year: false
        },
        postfix: '',
        selectBlock: 'datepicker-dropdown-template',
        dayObj: '',
        monthObj: '',
        yearObj: '',
        setDate: '',
        inputName: ''
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.initProperties();
        _self.initControls();
        _self.setDatepickerOptions();
        _self.initSelectors();
    };

    this.initProperties = function () {
        _self.properties.id.datepicker = _self.properties.id.datepicker + _self.properties.postfix;
        _self.properties.id.selectYear = _self.properties.id.selectYear + _self.properties.postfix;
        _self.properties.id.selectMonth = _self.properties.id.selectMonth + _self.properties.postfix;
        _self.properties.id.selectDay = _self.properties.id.selectDay + _self.properties.postfix;
        _self.properties.dataId.datepicker = _self.properties.dataId.datepicker + _self.properties.postfix;
        _self.properties.dataId.selectYear = _self.properties.dataId.selectYear + _self.properties.postfix;
        _self.properties.dataId.selectMonth = _self.properties.dataId.selectMonth + _self.properties.postfix;
        _self.properties.dataId.selectDay = _self.properties.dataId.selectDay + _self.properties.postfix;
    };

    this.initControls = function () {
        $(document)
                .off('click', _self.properties.dataAction.change).on('click', _self.properties.dataAction.change, function () {
                    _self.changeDropdown(this);
                });
    };

    this.changeDropdown = function (item) {
        _self.properties.id.datepicker = '#' + $(item).closest('div').data('datepicker');
        _self.properties.inputName = $(item).closest('div').data('input');
        var dropdown = $(item).closest('li').data('handler');
        switch (dropdown) {
            case 'selectDay':
                _self.properties.calendar.day = $(item).data('value');
                $(item).closest('div').find('span:first').text($(item).text());
                break;
            case 'selectMonth':
                _self.properties.calendar.month = $(item).data('value');
                $(item).closest('div').find('span:first').text($(item).text());
                break;
            case 'selectYear':
                _self.properties.calendar.year = $(item).data('value');
                $(item).closest('div').find('span:first').text($(item).text());
                break;
        }
        _self.setCalendarDate({day: _self.properties.calendar.day, month: _self.properties.calendar.month, year: _self.properties.calendar.year});
    };

    this.setDatepickerOptions = function () {
        if (_self.properties.setDate) {
            $(_self.properties.id.datepicker).datepicker("setDate", _self.properties.setDate);
            _self.setInputDate();
        }
        var options = {
            onChangeMonthYear: function () {
                var curr_day = _self.properties.dayObj.children('a').find('span:first').text();
                _self.setDays();
                _self.setSelectDay(curr_day);
                _self.setCalendarDate(false);
            }
        };
        $(_self.properties.id.datepicker).datepicker("option", options);
    };

    this.initSelectors = function () {
        var dp_elem = $(_self.properties.id.datepicker);
        var selectBlock = $('<div class="' + _self.properties.selectBlock + '"></div>').insertBefore(dp_elem);
        _self.properties.dayObj = $('<div id="' + _self.properties.dataId.selectDay + '" data-datepicker="' + _self.properties.dataId.datepicker + '" data-input="' + _self.properties.inputName + '" data-id="' + _self.properties.dataId.selectDay + '" class="col-xs-12 col-sm-4 datepicker-dropdown-template-item">' + _self.getDropdown(_self.properties.langs.defaultDay) + '</div>').appendTo(selectBlock);
        _self.properties.monthObj = $('<div id="' + _self.properties.dataId.selectMonth + '" data-datepicker="' + _self.properties.dataId.datepicker + '" data-input="' + _self.properties.inputName + '" data-id="' + _self.properties.dataId.selectMonth + '" class="col-xs-12 col-sm-4 datepicker-dropdown-template-item">' + _self.getDropdown(_self.properties.langs.defaultMonth) + '</div>').appendTo(selectBlock);
        _self.properties.yearObj = $('<div id="' + _self.properties.dataId.selectYear + '" data-datepicker="' + _self.properties.dataId.datepicker + '" data-input="' + _self.properties.inputName + '" data-id="' + _self.properties.dataId.selectYear + '" class="col-xs-12 col-sm-4 datepicker-dropdown-template-item">' + _self.getDropdown(_self.properties.langs.defaultYear) + '</div>').appendTo(selectBlock);
        _self.setSelectors();
    };

    this.getDropdown = function (data) {
        var value = typeof (data !== 'undefined') ? data : '';
        return '<a class="btn btn-default dropdown-toggle btn-lg btn-block btn-group" data-toggle="dropdown" aria-expanded="false">\n\
                        <span class="col-xs-10">' + value + '</span>\n\
                        <span class="caret"></span>\n\
                    </a>\n\
                    <ul class="dropdown-menu" role="menu"></ul>';
    };

    this.setSelectors = function () {
        _self.setDays();
        _self.setMonths();
        _self.setYears();
        if (_self.properties.setDate) {
            _self.setSelectDay($(_self.properties.id.datepicker + ' .ui-datepicker-current-day > .ui-state-default').text());
            _self.setSelectMonth(
                $(_self.properties.id.datepicker + ' [data-handler="selectMonth"]>option:selected').text(),
                $(_self.properties.id.datepicker + ' [data-handler="selectMonth"]>option:selected').val()
            );
            _self.setSelectYear($(_self.properties.id.datepicker + ' [data-handler="selectYear"]>option:selected').val());
        }
    };

    this.setSelectDay = function (day) {
        _self.properties.calendar.day = day;
        _self.properties.dayObj.children('a').attr('data-value', parseInt(day) - 1);
        _self.properties.dayObj.children('a').find('span:first').text(day);
    };

    this.setSelectMonth = function (name, val) {
        _self.properties.calendar.month = val;
        _self.properties.monthObj.children('a').attr('data-value', val);
        _self.properties.monthObj.children('a').find('span:first').text(name);

    };

    this.setSelectYear = function (year) {
        _self.properties.calendar.year = year;
        _self.properties.yearObj.children('a').attr('data-value', year);
        _self.properties.yearObj.children('a').find('span:first').text(year);
    };

    this.setDays = function () {
        $(_self.properties.id.datepicker).datepicker("refresh");
        var days_html = '';
        $(_self.properties.id.datepicker).find('[data-handler="selectDay"]').each(function (index, element) {
            var day = index + 1;
            days_html += '<li data-type="' + index + '" data-handler="selectDay" data-value="' + day + '">\n\
                                        <a data-action="change-datepicker" data-value="' + day + '">' + day + '</a>\n\
                                      </li>';
        });
        _self.properties.dayObj.children('ul').html(days_html);
    };

    this.setMonths = function () {
        var monthHtml = '';
        $(_self.properties.id.datepicker).find('[data-handler="selectMonth"]>option').each(function (index, element) {
            monthHtml += '<li data-type="' + $(element).val() + '" data-handler="selectMonth" data-value="' + $(element).val() + '">\n\
                                            <a data-action="change-datepicker" data-value="' + $(element).val() + '">' + $(element).text() + '</a>\n\
                                       </li>';
        });
        _self.properties.monthObj.children('ul').html(monthHtml);
    };

    this.setYears = function () {
        var years_html = '';
        $(_self.properties.id.datepicker).find('[data-handler="selectYear"]>option').each(function (index, element) {
            years_html = '<li data-type="' +  $(element).text() + '" data-handler="selectYear" data-value="' +  $(element).text() + '">\n\
                                            <a data-action="change-datepicker" data-value="' +  $(element).text() + '">' + $(element).text() + '</a>\n\
                                       </li>' + years_html;
        });
        _self.properties.yearObj.children('ul').html(years_html);
    };

    this.setCalendarDate = function (item) {
        if (item !== false) {
            var date = new Date(
                _self.properties.calendar.year,
                _self.properties.calendar.month,
                _self.properties.calendar.day
            );
            if (Date.parse(date)) {
                $(_self.properties.id.datepicker).datepicker("setDate", date);
                _self.setInputDate();
            }
        } else {
            var date = new Date(
                item.year,
                item.month,
                item.day
            );
            if (Date.parse(date)) {
                $(_self.properties.id.datepicker).datepicker("setDate", date);
                _self.setInputDate();
            }
            return false;
        }
    };

    this.setInputDate = function () {
        if ($(_self.properties.id.datepicker).length > 0) {
            var d = $(_self.properties.id.datepicker).datepicker("getDate");
            $('input[name="' + _self.properties.inputName + '"]').val(d.toDateString());
        }
    };

    _self.Init(optionArr);

};


if (typeof exports === 'object') {
      exports.__esModule = true;
      exports.DatepickerDropdownTemplate = DatepickerDropdownTemplate;
}
