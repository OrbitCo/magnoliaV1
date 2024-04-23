//let globals = {}, // global vars
let timeout,
  loaded_scripts = [],
  tmp_objects = [],
  tmp_objects_alien = ['FB'],
  tmp_scripts_alien = ['//connect.facebook.net/'],
  log_events = 0

const jq_remove = $.fn.remove
$.fn.remove = function () {
  if (typeof arguments[0] !== 'undefined') {
    $(this).filter(arguments[0]).trigger('remove')
  } else {
    $(this).trigger('remove')
  }
  return jq_remove.apply(this, arguments)
}

$.fn.outerHTML = function () {
  return (this[0]) ? this[0].outerHTML : ''
}

if ($.support.pjax && window.use_pjax) {
  $(document).on('click', 'a[data-pjax!="0"][target!="_blank"]', function (event) {
    var container = $(this).attr('data-pjax-container') || pjax_container
    var options = {}
    if ($(this).attr('data-pjax-no-scroll')) {
      options.scrollTo = false
    }
    $.pjax.click(event, container, options)
  })
  $(window).on('popstate', function () {})
  $.pjax.defaults.timeout = 30000
}

$(document)
  .on('click', '[data-history]', function () {
    var url = $(this).attr('data-history')
    if (url) {
      if ($.support.pjax) {
        window.history.replaceState(null, '', url)
      }
    }
  })
  .on('scroll ready pjax:success', function () {
    if ($('#top_bar_fixed').length) {
      if ($(document).scrollTop() > $('#top_bar_fixed').offset().top) {
        if ($('#top_bar_fixed').find('.menu-search-bar').css('position') != 'fixed') {
          $('#top_bar_fixed').css({ height: $('#top_bar_fixed').height() + 'px' })
          $('#top_bar_fixed').find('.menu-search-bar').css({ position: 'fixed', width: '100%', top: '0', left: '0' })
          $('#top_bar_fixed').find('.menu-search-bar .submenu').css({ position: 'fixed' })
        }
      } else {
        if ($('#top_bar_fixed').find('.menu-search-bar').css('position') != 'static') {
          $('#top_bar_fixed').css({ height: 'auto' })
          $('#top_bar_fixed').find('.menu-search-bar').css({ position: 'static', width: 'auto', top: 'auto' })
          $('#top_bar_fixed').find('.menu-search-bar .submenu').css({ position: 'absolute' })
        }
      }
    }
  })
  .on('pjax:error', function (e) {
    if (log_events)
      log(e.type)
  })
  .on('pjax:hardload', function (e, data) {
    if (log_events)
      log(e.type)
    $('body').html(data.responseText)
  })
  .on('pjax:start', function (e) {
    NProgress.start()
    if (log_events)
      log(e.type)

    for (var i in tmp_objects) {
      if (tmp_objects.hasOwnProperty(i) && typeof window[i] !== 'undefined') {
        if (typeof window[i].uninit === 'function') {
          window[i].uninit()
          if (log_events)
            log('uninit: ' + /(\w+)\(/.exec(window[i].constructor.toString())[1])
        }
        window[i] = undefined
        try {
          delete window[i]
        } catch (e) {
          if (log_events) {
            log(e)
          }
        }
        delete tmp_objects[i]
      }
    }

    for (var i in tmp_objects_alien)
      if (tmp_objects_alien.hasOwnProperty(i) && typeof window[i] !== 'undefined') {
        delete window[tmp_objects_alien[i]]
      }
    for (var i in tmp_scripts_alien)
      if (tmp_scripts_alien.hasOwnProperty(i)) {
        $('script[src*="' + tmp_scripts_alien[i] + '"]').remove()
      }
  })
  .on('pjax:end', function (e) {
    if (log_events)
      log(e.type)
    NProgress.done()
  })
  .on('pjax:send', function (e) {
    NProgress.start()
    if (log_events)
      log(e.type)

  })
  .on('pjax:complete', function (e) {
    if (log_events)
      log(e.type)
  })
  .on('submit', 'form', function (event) {
    if ($.support.pjax && window.use_pjax) {
      var container = pjax_container
      var form = event.currentTarget
      if (!form.action) {
        form.action = location.href
      }
      var eventHandler = event.delegateTarget.activeElement
      var options = {
        processData: false,
        contentType: false,
        cache: false,
        data: {}
      }

      options.data = new FormData($(form)[0])
      if (typeof eventHandler.type !== 'undefined' && (eventHandler.type == 'submit' || eventHandler.type == 'button') && eventHandler.name) {
        options.data.append(eventHandler.name, eventHandler.value)
      } else {
        var submit_btn = $(form).find('input[type="submit"][data-pjax-submit!="0"]')
        if (submit_btn.attr('name') && submit_btn.val()) {
          options.data.append(submit_btn.attr('name'), submit_btn.val())
        }
      }
      $.pjax.submit(event, container, options)
    }
  })
  .ready(function (e) {
    $(document).ajaxSend(function (e, jqxhr, options) {
      if (!options.backend) {
        NProgress.start()
      }
    }).ajaxStop(function () {
      try {
        NProgress.done()
      }catch (e){
       // console.log(e)
      }

    })

    if (typeof MultiRequest !== 'undefined') {
      MultiRequest.setProperties('url', site_url + 'start/ajax_backend/').init()
    }
  })
  .on('ready pjax:success', function (e) {
    if (log_events)
      log(e.type)
    if (typeof site_error_position === 'undefined') {
      site_error_position = 'center'
    }
    //TODO убрать после подключения webpack к админке
    if (typeof is_webpack === 'undefined' && is_webpack !== true) {
      error_object = new Errors({ position: site_error_position })
    }

    timeout = 0

    $('#error_block').each(function (index, item) {
      var html = $(item).html()
      if (html.trim()) {
        error_object.show_error_block(html, 'error')
        timeout = 2000
      }
    })

    $('#info_block').each(function (index, item) {
      var html = $(item).html()
      if (html.trim()) {
        if (timeout) {
          setTimeout(function () {
            error_object.show_error_block(html, 'info')
          }, timeout)
        } else {
          error_object.show_error_block(html, 'info')
        }
      }
    })

    $('#success_block').each(function (index, item) {
      var html = $(item).html()
      if (html.trim()) {
        if (timeout) {
          setTimeout(function () {
            error_object.show_error_block(html, 'success')
          }, timeout)
        } else {
          error_object.show_error_block(html, 'success')
        }
      }
    })

    if (typeof $().placeholder === 'function') {
      $('input, textarea').placeholder()
    }

    if (window.js_events && js_events.length) {
      if (typeof js_events === 'object') {
        for (var i in js_events)
          if (js_events.hasOwnProperty(i)) {
            $(document).trigger(js_events[i])
            if (log_events)
              log('js event: ' + js_events[i])
          }
      } else {
        $(document).trigger(js_events)
        if (log_events)
          log('js event: ' + js_events)
      }
      js_events = null
    }
  })
  .on('scriptLoad', function (e, obj_name) {
    obj_name = obj_name || null
    if (obj_name) {
      if (log_events)
        log('scriptLoad:' + obj_name)
      $(document).trigger('scriptLoad:' + obj_name)
    }
  }).on('session:guest', function () {
  id_user = 0
})

function loadScripts (url, callback, obj_for_kill, ajaxOptions) {

  //TODO убрать после подключения webpack к админке
  if (typeof is_webpack !== 'undefined' && is_webpack !== false) {
    return callback()
  } else {

    obj_for_kill = obj_for_kill || ''
    ajaxOptions = ajaxOptions || {}
    let script_url = '', cb

    if (typeof url === 'object' && url.length) {
      script_url = url.shift()
      cb = url.length ? function () {
        loadScripts(url, callback, obj_for_kill, ajaxOptions)
      } : callback
    } else if (typeof url === 'string') {
      script_url = url
      cb = callback
    }

    if (typeof obj_for_kill === 'object' && obj_for_kill.length) {
      for (var i in obj_for_kill) {
        tmp_objects[obj_for_kill[i]] = script_url
      }
    } else if (obj_for_kill) {
      tmp_objects[obj_for_kill] = script_url
    }

    if (script_url) {
      var scriptname = script_url.match(/[^\/?#]+(?=$|[?#])/)[0]
      if (typeof scriptname !== 'undefined') {
        var ext = scriptname.lastIndexOf('.')
        if (ext) {
          scriptname = scriptname.substr(0, ext)
        }
        if (scriptname.substr(-4) === '.min') {
          scriptname = scriptname.substr(0, scriptname.length - 4)
        }
      } else {
        var scriptname = ''
      }
      var event = scriptname ? 'scriptLoad:' + scriptname : 'scriptLoad'

      for (var i in loaded_scripts) {
        if (script_url == loaded_scripts[i]) {
          if (typeof cb == 'function') {
            cb()
          }
          $(document).trigger(event)
          if (log_events)
            log(event)
          return
        }
      }

      var options = {
        url: script_url,
        success: function () {
          loaded_scripts.push(script_url)
          if (typeof cb == 'function') {
            cb()
          }
          $(document).trigger(event)
          if (log_events)
            log(event)
        },
        error: function (xhr, textStatus, errorThrown) {
          log('error loading script: ' + script_url + '. ' + textStatus + '. ' + errorThrown, 'error')
        },
        dataType: 'script',
        cache: true
      }

      $.extend(true, options, ajaxOptions)
      $.ajax(options)
    } else if (typeof console !== 'undefined') {
      console.warn('Error. Load script: invalid url')
    }
  }
}

function locationHref (url, hard, new_window) {
  new_window = new_window || false
  hard = hard || false
  if ($.support.pjax && window.use_pjax && !hard) {
    $.pjax({ url: url, container: pjax_container })
  } else {
    if (new_window) {
      window.open(url)
    } else {
      location.href = url
    }
  }
}

function log (str, type) {
  type = type || 'log'
  if (typeof console !== 'undefined') {
    switch (type) {
      case 'error':
        console.error(str)
        break
      case 'warn':
        console.warn(str)
        break
      case 'log':
      default:
        console.log(str)
        break
    }
  }
}

function removeHTML (str) {
  var tmp = document.createElement('div')
  tmp.innerHTML = str
  return tmp.textContent || tmp.innerText || ''
}

function in_array (needle, haystack, argStrict) {
  var key = '',
    strict = !!argStrict
  if (strict) {
    for (key in haystack) {
      if (haystack[key] === needle) {
        return true
      }
    }
  } else {
    for (key in haystack) {
      if (haystack[key] == needle) {
        return true
      }
    }
  }
  return false
}

function autoResize (id) {
  var newheight
  var newwidth
  if (document.getElementById) {
    newheight = document.getElementById(id).contentWindow.document.body.scrollHeight
    newwidth = document.getElementById(id).contentWindow.document.body.scrollWidth
  }
  document.getElementById(id).height = newheight + 'px'
  document.getElementById(id).width = newwidth + 'px'
}

function redirect (url) {
  if (window.$ && $.support.pjax && window.use_pjax) {
    $.pjax({ url: url, container: '#pjaxcontainer' })
  } else {
    window.location.href = url
  }
}

function showLoginForm () {
  error_object.show_error_block('ajax_login_link', 'error')
}

function sendAnalytics (event, category, type) {
  if (!event) {
    return
  }

  if (typeof sendAnalyticsF === 'function') {
    sendAnalyticsF(event, category, type)
  }
}

$(function () {
  $(document).ajaxError(function (event, jqxhr, settings, exception) {
    switch (jqxhr.status) {
      case 403:
        showLoginForm()
        break
      default:
        break
    }
  })
})

/** Lighthouse methods **/
function lightSendScriptRequest (url, httpParams) {
  var currentScript = document.createElement('SCRIPT')
  if (httpParams) httpParams = '?rand=' + Math.random() + '&' + httpParams
  else httpParams = '?rand=' + Math.random()

  currentScript.ajax_readyState = false
  currentScript.onload = lightScriptCallback(currentScript)
  currentScript.onreadystatechange = lightScriptCallback(currentScript)
  currentScript.src = url + httpParams
  document.getElementsByTagName('script')[0].parentNode.appendChild(currentScript)
}

function lightScriptCallback (currentScript) {
  return function () {
    if (currentScript.ajax_readyState) return
    if (!currentScript.readyState ||
      currentScript.readyState == 'loaded' ||
      currentScript.readyState == 'complete') {
      currentScript.ajax_readyState = true
    }
  }
}

function lightSend () {
  var nowDate = new Date()
  var expiredays = 7
  var light_time = lightGetCookie('l_time')

  if (light_time == '') {
    var expiresDate = new Date()
    expiresDate.setTime(expiresDate.getTime() + expiredays * 24 * 60 * 60 * 1000)
    lightSetCookie('l_time', expiresDate.getTime(), expiredays)
  } else if (light_time > nowDate.getTime()) {
    return
  }
  lightSendScriptRequest('//lighthouse.pilotgroup.net/light.php', 'build_code=')
}

//Cookie functions
function lightSetCookie (name, value, expiredays) {
  var valueEscaped = escape(value)
  var expiresDate = new Date()
  expiresDate.setTime(expiresDate.getTime() + expiredays * 24 * 60 * 60 * 1000) //milliseconds
  var expires = expiresDate.toGMTString()
  var newCookie = name + '=' + valueEscaped + '; path=/; expires=' + expires
  if (valueEscaped.length <= 4000) document.cookie = newCookie + ';'
}

function lightGetCookie (c_name) {
  if (document.cookie.length > 0) {
    var c_start = document.cookie.indexOf(c_name + '=')
    if (c_start != -1) {
      c_start = c_start + c_name.length + 1
      var c_end = document.cookie.indexOf(';', c_start)
      if (c_end == -1) c_end = document.cookie.length
      return unescape(document.cookie.substring(c_start, c_end))
    }
  }
  return ''
}

lightSend()
/** End Lighthouse methods **/

if (typeof exports === 'object') {
  exports.__esModule = true
  exports.locationHref = locationHref
  exports.log = log
  exports.removeHTML = removeHTML
  exports.in_array = in_array
  exports.autoResize = autoResize
  exports.sendAnalytics = sendAnalytics
  exports.lightGetCookie = lightGetCookie
  exports.lightScriptCallback = lightScriptCallback
  exports.lightSend = lightSend
  exports.lightSendScriptRequest = lightSendScriptRequest
  exports.lightSetCookie = lightSetCookie
  exports.loadScripts = loadScripts
  exports.redirect = redirect
  exports.log_events = exports.loaded_scripts = void 0
}
