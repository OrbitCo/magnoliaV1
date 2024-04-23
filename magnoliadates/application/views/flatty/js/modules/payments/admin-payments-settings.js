function AdminPaymentsSettings(optionArr){

	this.properties = {
		siteUrl: '',
		useAutoUpdateId: 'use_rates_update',
		driverAutoUpdateId: 'rates_update_driver',
		driverSelectId: 'driver_select',
		manualUpdateId: 'rates_update_manual',
		manualSelectId: 'manual_select',
		urlUseAutoUpdate: 'admin/payments/ajax_use_rates_update/',
		urlDriverAutoUpdate: 'admin/payments/ajax_rates_driver_update/',
		urlManualUpdate: 'admin/payments/ajax_currency_rates_update/',
		errorObj: new Errors({ position: site_error_position }),
	};

	const _self = this;

	this.Init = function(options){
		_self.properties = $.extend(_self.properties, options);
		$('#'+_self.properties.useAutoUpdateId).on('change', function(){
			var status = this.checked ? 1 : 0;
			_self.use_auto_update(status);
			return false;
		});
		$('#'+_self.properties.driverAutoUpdateId).on('click', function(){
			var updater = $('#'+_self.properties.driverSelectId).val();
			_self.driver_auto_update(updater);
			return false;
		});
		$('#'+_self.properties.manualUpdateId).on('click', function(){
			var updater = $('#'+_self.properties.manualSelectId).val();
			_self.manual_update(updater);
			return false;
		});
	}

	this.use_auto_update = function(status){
		$.ajax({
			url: _self.properties.siteUrl + _self.properties.urlUseAutoUpdate + status,
			type: 'GET',
			data: {},
			dataType: 'json',
			cache: false,
			success: function(data){
				if(typeof(data.error) != 'undefined' && data.error != ''){
					_self.properties.errorObj.show_error_block(data.error, 'error');
				}else{
					_self.properties.errorObj.show_error_block(data.success, 'success');
				}
			}
		});
		return false;
	}

	this.driver_auto_update = function(updater){
		$.ajax({
			url: _self.properties.siteUrl + _self.properties.urlDriverAutoUpdate + updater,
			type: 'GET',
			data: {},
			dataType: 'json',
			cache: false,
			success: function(data){
				if(typeof(data.error) != 'undefined' && data.error != ''){
					_self.properties.errorObj.show_error_block(data.error, 'error');
				}else{
					_self.properties.errorObj.show_error_block(data.success, 'success');
				}
			}
		});
		return false;
	}

	this.manual_update = function(updater){
		$.ajax({
			url: _self.properties.siteUrl + _self.properties.urlManualUpdate + updater,
			type: 'GET',
			data: {},
			dataType: 'json',
			cache: false,
			success: function(data){
				if(typeof(data.error) != 'undefined' && data.error != ''){
					_self.properties.errorObj.show_error_block(data.error, 'error');
				}else{
					_self.properties.errorObj.show_error_block(data.success, 'success');
				}
			}
		});
		return false;
	}

	_self.Init(optionArr);

}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.AdminPaymentsSettings = AdminPaymentsSettings;
}
