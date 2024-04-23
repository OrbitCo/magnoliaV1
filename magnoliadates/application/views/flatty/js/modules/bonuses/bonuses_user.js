'use strict'

function bonusesContent(optionArr) {

  this.properties = {
    siteUrl: '',
    exchangeRate: '0.1',
    popupBlockClass: 'exchange_center',
    noneBonusNotify: '',
    bonusContentClass: '.bonus_content'
  }
  var _self = this

  this.Init = function (options) {
    _self.properties = $.extend(_self.properties, options)
    _self.sendAjax(false)
    $(document).off('click', '#refresh_bonuses').on('click', '#refresh_bonuses', function () {
      _self.sendAjax(false)
    }).off('click', _self.properties.bonusContentClass).on('click', _self.properties.bonusContentClass, function () {
      _self.toggleBonusDescription($(this))
    })

  }

  this.sendAjax = function (is_exchange) {
    _self.user_id = $('div[name=\'user_id\']').attr('id_user')
    $.ajax({
      url: _self.properties.siteUrl + 'bonuses/ajax_refresh_user_bonus_panel/' + _self.user_id,
      type: 'POST',
      dataType: 'json',
      success: function (content) {
        if (typeof content.info.access_denied !== 'undefined' && content.info.access_denied.length > 0) {
          
        } else {
          if (is_exchange) {
            _self.exchangeBonuses(content)
          }
          $('#bonuses_content').empty()
          _self.performed_text = content['performed_text']
          _self.button_text = content['button_text']
          _self.amount_text = content['amount_text']
          _self.counter_times_text = content['counter_times_text']
          _self.currency = content['currency']

          var account = content['account'] ? content['account']['bonus_account'] : null
          var bonuses = content['bonuses'] ? content['bonuses'] : []
          if (bonuses) {
            _self.refreshBonusTable(bonuses)
          }
          _self.refreshAccountTable(account)
        }

      },
      error: function () {}
    })
  }

  this.exchangeToMoney = function (points) {
    if (points) {
      points = parseInt(points)
      if (points > _self.account) {
        points = _self.account
      }
      if (points < 0) {
        points = 0
      }
      $('#exchange_points').val(points)
      var res = parseFloat(points * parseFloat(_self.properties.exchangeRate)).toFixed(1)
      var cash = '= ' + '\u00A0' + res + ' ' + _self.currency.abbr
      $('#exchange_cash').attr('value', res)
      $('#exchange_cash').html(cash)
    } else {
      $('#exchange_points').val('')
      $('#exchange_cash').html('')
    }
  }

  this.exchangeBonuses = function (data) {
    var view = new loadingContent({ otherClass: _self.properties.popupBlockClass })
    view.show_load_block(JSON.parse(data['exchange_bonus_content']))
    _self.exchange_popup = view
    var account = 0
    if (typeof data.account != 'undefined') {
      if (data.account.bonus_account) {
        account = data.account.bonus_account
      }
    }

    _self.account = account
    $('#my_bonuses_points').attr('value', account)
    $('#my_bonuses_points').prepend(account)
    $('#my_bonuses_points').click(function () {
      $('#exchange_points').val($(this).attr('value'))
      $('#exchange_points').trigger('change')
    })
    $('#exchange_points').change(function () {
      _self.exchangeToMoney($(this).val())
    })
    $('#exchange_points').keyup(function () {
      _self.exchangeToMoney($(this).val())
    })
    $('#exchange_save').click(function (e) {
      $(this).prop('disabled', true)
      e.preventDefault()
      var money = parseFloat($('#exchange_cash').attr('value'))
      if (money > 0) {
        _self.cashOperation(money)
      } else {
        error_object.show_error_block(_self.properties.noneBonusNotify, 'error')
      }
    })
  }

  this.cashOperation = function (money) {
    $.ajax({
      url: _self.properties.siteUrl + 'bonuses/ajax_filled_account/' + _self.user_id,
      type: 'POST',
      dataType: 'json',
      data: { data: money },
      success: function (data) {
        var user_account = _self.currency.abbr + parseFloat(data.account).toFixed(2)
        $('.user-short-inf__currency').children().first().html(user_account)
        _self.sendAjax(false)
        _self.exchange_popup.destroy()
        if (typeof (data.errors) != 'undefined' && data.errors != '') {
          error_object.show_error_block(data.error, 'error')
        } else if (typeof (data.success) != 'undefined' && data.success != '') {
          error_object.show_error_block(data.success, 'success')
        }
      }
    })
  }

  this.refreshBonusTable = function (bonuses) {
    for (var i in bonuses) {
      var bonus = bonuses[i]
      if (bonus['status'] != 0) {
        if (bonus['period_type'] != 'multiple') {
          if (bonus['user_counter_status'] == 1) {
            $('#bonuses_content').append(_self.createNewElemAndSetValues(bonus))
            $('#bonus_row_' + bonus['id']).attr('data-toggle', '')
            $('#bonus_row_' + bonus['id']).attr('title', '')
            $('#bonus_row_' + bonus['id']).addClass('inactive')
            $('#bonus_check_' + bonus['id']).show()
            $('#bonus_row_' + bonus['id']).css('color', '#aaa')
          } else {
            $('#bonuses_content').prepend(_self.createNewElemAndSetValues(bonus))
            $('#counter_block_' + bonus['id']).addClass('bonus_bage')
            _self.isPersent(bonus)
            $('#data_counter_bonus_' + bonus['id']).show()
          }
        } else {
          $('#bonuses_content').prepend(_self.createNewElemAndSetValues(bonus))
          $('#counter_block_' + bonus['id']).addClass('bonus_bage')
          $('#counter_block_' + bonus['id']).addClass('multiple_bonus_icon')
          $('#infinity_' + bonus['id']).show()
        }
      }
    }
    var button_block = '<button onclick="sendAnalytics(\'dp_user_home_bonuses_btn_exchange\')" id=\'exchange_bonus_btn\' class=\'btn btn-primary exchange_bonus\'>' + _self.button_text + '</button>'
    $('#bonuses_content').append(button_block)

    $('#exchange_bonus_btn').on('click', function () {
      _self.sendAjax(true)
    })
  }

  this.createNewElemAndSetValues = function (bonus) {
    var content = '<div class=\'bonus_content pointer\' data-html=\'true\' data-original-title=\'\''
      + '\' id=\'bonus_row_' + bonus['id'] + '\' bonus_id=\'' + bonus['id'] + '\'><div><span id=\'table_bonus_name_'
      + bonus['id'] + '\'>'
      + bonus['name_' + bonus['cur_lang_id']] + '</span>'
      + '<span class=\'fright\' id=\'counter_block_' + bonus['id'] + '\'>'
      + '<span hidden id=\'infinity_' + bonus['id'] + '\'>&infin;</span>'
      + '<span hidden class=\'bonus_count\' id=\'data_counter_bonus_'
      + bonus['id'] + '\'></span>' + '<span hidden id=\'bonus_check_'
      + bonus['id'] + '\'><i class=\'fa fa-check\'></i></span>'
      + '<span hidden id=\'bonus_percent_' + bonus['id']
      + '\'>%</span>' + '</span></div>'
      + '<div id=\'bonus_description_' + bonus['id'] + '\' class=\'bonus_description hide\'>'
      + '<div>' + bonus['info_' + bonus['cur_lang_id']] + '</div>'
      + '<div class=\'bonus_amount_text\' id=\'bonus_amount_' + bonus['id'] + '\'>'
      + bonus['amount'] + ' ' + _self.amount_text + '</div>'
      + '</div></div><hr id=\'hr_bonuses_' + bonus['id'] + '\'>'
    return content
  }

  this.isPersent = function (bonus) {
    if (typeof (bonus['config']) != 'undefined' && bonus['config']['is_percent'] == '1') {
      $('#bonus_percent_' + bonus['id']).show()
      $('#data_counter_bonus_' + bonus['id']).html(bonus['user_counter'])
    } else {
      $('#bonus_percent_' + bonus['id']).hide()
      $('#data_counter_bonus_' + bonus['id']).html(parseInt(bonus['repetition'], 10) - parseInt(bonus['user_counter'], 10))
    }
  }

  this.refreshAccountTable = function (account) {
    if (!account) {
      account = 0
    }
    $('#data_account_bonus').text(account)
  }

  this.toggleBonusDescription = function (obj) {
    var bonus_id = obj.attr('bonus_id')
    $('#bonus_description_' + bonus_id).toggle()
  }

  _self.Init(optionArr)
}

if (typeof exports === 'object') {
  exports.__esModule = true
  exports.bonusesContent = bonusesContent
}
