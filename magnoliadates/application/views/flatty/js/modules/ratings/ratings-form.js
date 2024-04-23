function RatingsForm(optionArr) {
  this.properties = {
    siteUrl: '',
    sendRatingBtn: 'rating_btn',
    cFormId: 'ratings_form',
    urlGetForm: 'ratings/ajax_get_form/',
    urlSendForm: 'ratings/ajax_send_rating/',
    id_close: 'close_btn',
    viewRatingBlockClass: '.view-rating-block',
    emptyRating: '.empty-rating',
    rand: null,
    isPopup: true,
    isOwner: false,
    success: null,
    contentObj: null,
    errorObj: new Errors,
    common_ancestor: 'body',
    lang: {
      you: 'You'
    },
    data: {
      myMark: '[data-rating="my_mark"]',
      allMark: '[data-rating="all_mark"]'
    }
  }

  var _self = this

  this.Init = function (options) {
    _self.properties = $.extend(_self.properties, options)

    if (!_self.properties.contentObj) {
      _self.properties.contentObj = new loadingContent({
        loadBlockWidth: '544px',
        closeBtnClass: 'load_content_close',
        closeBtnPadding: 5,
      })
    }

    if (_self.properties.isPopup) {
      $('#' + _self.properties.sendRatingBtn + '_' + _self.properties.rand).on('click', function () {
        var data = {
          object_id: $(this).attr('data-id'),
          type_gid: $(this).attr('data-type'),
          responder_id: $(this).attr('data-responder'),
          is_owner: $(this).attr('data-owner') !== undefined ? 1 : 0,
          rand: _self.properties.rand
        }
        _self.get_form(data)
        return false
      }).show()
    } else {
      $(_self.properties.common_ancestor).off('click', '#' + _self.properties.cFormId + '_' + _self.properties.rand + ' ins').on('click', '#' + _self.properties.cFormId + '_' + _self.properties.rand + ' ins', function () {
        if (_self.properties.readOnly) {
          return
        }
        _self.send_form($(this).closest('form').serialize())
        return false
      }).off('mouseenter', +_self.properties.viewRatingBlockClass).on('mouseenter', _self.properties.viewRatingBlockClass, function () {
        _self.viewRatingBlock(this)
      }).off('mouseleave', +_self.properties.viewRatingBlockClass).on('mouseleave', _self.properties.viewRatingBlockClass, function () {
        _self.closeRatingBlock(this)
      })
    }
  }

  this.uninit = function () {
    $(_self.properties.common_ancestor).off('click', '#' + _self.properties.cFormId + '_' + _self.properties.rand)
    return this
  }

  this.viewRatingBlock = function (item) {
    $(item).find(_self.properties.emptyRating).hide()
    $(item).find('.form-rating').show()
    return this
  }

  this.closeRatingBlock = function (item) {
    $(item).find('.form-rating').hide()
    $(item).find(_self.properties.emptyRating).show()
  }

  this.get_form = function (data) {
    $.ajax({
      url: _self.properties.siteUrl + _self.properties.urlGetForm,
      type: 'post',
      data: data,
      cache: false,
      success: function (data) {
        _self.properties.contentObj.show_load_block(data)
        $('#' + _self.properties.id_close).unbind().on('click', function () {
          _self.clearBox()
          return false
        })
      }
    })
    return false
  }

  this.send_form = function (data) {
    data = typeof data !== 'undefined' ? data : $('#' + _self.properties.cFormId + '_' + _self.properties.rand).serialize()
    $.ajax({
      url: _self.properties.siteUrl + _self.properties.urlSendForm,
      type: 'post',
      data: data,
      dataType: 'json',
      cache: false,
      success: function (data) {
        if (typeof data.info.access_denied !== 'undefined' && data.info.access_denied.length > 0) {
          if (loadingContent.prototype.isActive === true && loadingContent.prototype.template === 'gallery') {
            _self.properties.contentObj.destroy()
            _self.properties.contentObj.changeTemplate('default')
          }
          _self.properties.contentObj.show_load_block(data.info.access_denied)
          return false
        } else if (typeof (data.errors) !== 'undefined' && data.errors !== '') {
          _self.properties.errorObj.show_error_block(data.errors, 'error')
        } else {
          if (_self.properties.isPopup) {
            var btn = $('#' + _self.properties.sendRatingBtn + '_' + _self.properties.rand)
            btn.removeAttr('href').unbind('click').on('click', function () {
              return false
            })
            btn.find('ins').addClass('g')
            _self.properties.contentObj.hide_load_block()
          } else {
            $('#' + _self.properties.cFormId).find('textarea').val('')
          }
          _self.properties.errorObj.show_error_block(data.success, 'success')

          $('#rating_avg-' + _self.properties.rand).html(data.rating.rating_value)
          $('#rating_count-' + _self.properties.rand).html('(<i class="fa fa-user g"></i> ' + data.rating.rating_count + ')')
          $(_self.properties.viewRatingBlockClass).find('.get-rating>.bottom').html('(' + data.rating.rating_count + ')')
          $(_self.properties.data.allMark).html(data.rating.rating_value)
          $(_self.properties.data.myMark).html(data.my_mark)
          $(_self.properties.data.myMark).siblings('.bottom').html(_self.properties.langs.you)
          $(_self.properties.data.myMark).siblings('i').attr('class', 'fa fa-star')
          $(_self.properties.data.myMark).closest(_self.properties.emptyRating).addClass('set')
          if (_self.properties.success) {
            _self.properties.success(data.id)
          }
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (typeof (console) !== 'undefined') {
          console.error(errorThrown)
        }
      }
    })
    return false
  }

  this.clearBox = function () {
    var data = $('#' + _self.properties.cFormId + '_' + _self.properties.rand).serialize()
    _self.send_form(data)
  }

  _self.Init(optionArr)

  return this;
}

if (typeof exports === 'object') {
  exports.__esModule = true
  exports.RatingsForm = RatingsForm
}
