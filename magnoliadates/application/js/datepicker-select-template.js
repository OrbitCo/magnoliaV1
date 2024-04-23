'use strict';
function DatepickerSelectTemplate(optionArr) {
    
    this.properties = {
        datepickerId: '#datepicker',
        selectDayId: '#daySelect',
        selectMonthId: '#monthSelect',
        selectYearId: '#yearSelect',
        selectBlock: 'datepicker-selectors-template',
        
        defaultDayText: 'Day',
        defaultMonthText: 'Month',
        defaultYearText: 'Year',
        
        dayObj: '',
        monthObj: '',
        yearObj: '',
        
        setDate: '',
        inputName: '',
    };
    
    var _self = this;
    
    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.setDatepickerOptions();
        _self.initSelectors();

    };
    
    this.setDatepickerOptions = function() {     
        if(_self.properties.setDate){
            $(_self.properties.datepickerId).datepicker("setDate", _self.properties.setDate);
            _self.setInputDate();
        }
        
        var options = {
            onChangeMonthYear: function() {
                var curr_day = _self.properties.dayObj.children('select').val();

                _self.setDays();
                _self.setSelectDay(curr_day);
                _self.setCalendarDate();
            }
        };
        
        $(_self.properties.datepickerId).datepicker("option", options);
    };
    
    this.initSelectors = function() {
        var dp_elem = $(_self.properties.datepickerId);
        var selectBlock = $('<div class="' + _self.properties.selectBlock + '"></div>').insertBefore(dp_elem);
        _self.properties.dayObj = $('<div id="daySelect"><select name="daySelect" class="form-control"></select></div>').appendTo(selectBlock);
        _self.properties.monthObj = $('<div id="monthSelect"></div>').appendTo(selectBlock);
        _self.properties.yearObj = $('<div id="yearSelect"></div>').appendTo(selectBlock);

        _self.setSelectors();
    };
    
    this.setSelectors = function() {
        _self.setDays();
        
        var month_obj = $(_self.properties.datepickerId).find('.ui-datepicker-month').clone(true).addClass('form-control');
        _self.properties.monthObj.html(month_obj);
        
        var year_obj = $(_self.properties.datepickerId).find('.ui-datepicker-year').clone(true).addClass('form-control');
        _self.properties.yearObj.html(year_obj);
        
        if(_self.properties.setDate) {
            var selected_day = $('.ui-datepicker-current-day > .ui-state-default').text();
            _self.setSelectDay(selected_day);
            
        } else {
            _self.properties.dayObj.children('select').prepend('<option disabled>' + _self.properties.defaultDayText + '</options>').prop('selectedIndex',0);
            _self.properties.monthObj.children('select').prepend('<option disabled>' + _self.properties.defaultMonthText + '</options>').prop('selectedIndex',0);
            _self.properties.yearObj.children('select').prepend('<option disabled>' + _self.properties.defaultYearText + '</options>').prop('selectedIndex',0);
        }
        
        _self.properties.dayObj.children('select').change(function() {
            _self.setCalendarDate();
        });
    };
    
    this.setSelectDay = function(day) {
        _self.properties.dayObj.children('select').children('option:eq(' + (day - 1) +')').prop('selected', true);
    };

    this.setDays = function() {
        $(_self.properties.datepickerId).datepicker("refresh");
        var days_html = '';
        
        $(_self.properties.datepickerId).find('[data-handler="selectDay"]').each(function(index, element){
            var day = index + 1;
            days_html = days_html + '<option data-handler="selectDay" value="' + day + '">' + day + '</option>';
        });

        _self.properties.dayObj.children('select').html(days_html);
    }
    
    this.setCalendarDate = function() {
        var day = _self.properties.dayObj.children('select').val();
        var month = parseInt(_self.properties.monthObj.children('select').val());
        var year = _self.properties.yearObj.children('select').val();
        
        var date = new Date(year, month, day);

        if(Date.parse(date)) {
            $(_self.properties.datepickerId).datepicker("setDate", date);
            _self.setInputDate();
        }
    }
    
    this.setInputDate = function() {
        if ($('div').is(_self.properties.datepickerId) !== false) {
            var d = $(_self.properties.datepickerId).datepicker("getDate");
            $('input[name="' + _self.properties.inputName + '"]').val(d.toDateString());
        }
    }
    
    _self.Init(optionArr);
    
}


