'use strict'

function adminNetwork (optionArr) {

    const _self = this

    this.properties = {
        btnGetAccess: {},
        btnHideHelp: {},
        btnShowHelp: {},
        fast: {},
        frmNetwork: {},
        hasAccess: false,
        helpBlock: {},
        domainField: {},
        keyField: {},
        interval: 1000,
        isRegistered: true,
        meetsReqs: false,
        parent: {},
        prevFast: '',
        prevSlow: '',
        showHelp: true,
        showHelpBlock: {},
        showHelpInput: {},
        showLog: true,
        siteUrl: '',
        slow: {},
        status: false,
        statusUrl: 'admin/network/ajax_get_status',
        accessUrl: 'admin/network/get_access'
    }

    let showElements = (ids) => {
        for (let id in ids) {
            $('#' + ids[id]).show()
        }
    }
    let hideElements = (ids) => {
        for (let id in ids) {
            $('#' + ids[id]).hide()
        }
    }

    let ajax = (url) => {
        return $.ajax({
            dataType: 'json',
            url: _self.properties.siteUrl + url,
            context: document.body
        })
    }

    let getAccess = () => {
        return ajax(_self.properties.accessUrl)
    }

    let getStatus = () => {
        return ajax(_self.properties.statusUrl)
    }

    let setObjects = () => {
        _self.properties.parent = $('.network-content')
        _self.properties.fast = $('#fast', _self.properties.parent)
        _self.properties.slow = $('#slow', _self.properties.parent)
        _self.properties.helpBlock = $('#help-block')
        _self.properties.btnHideHelp = $('#btn-hide-help', _self.properties.helpBlock)
        _self.properties.showHelpBlock = $('#show-help-block')
        _self.properties.btnShowHelp = $('#btn-show-help', _self.properties.showHelpBlock)
        _self.properties.btnGetAccess = $('#btn-get-access')
        _self.properties.frmNetwork = $('#network-form')
        _self.properties.domainField = $('#network-domain')
        _self.properties.keyField = $('#network-key')
        _self.properties.showHelpInput = $('[name="show_help"]', _self.properties.frmNetwork)
        _self.properties.btnStartConnect = $('[data-action="start_connect"]')
        _self.properties.btnStopConnect = $('[data-action="stop_connect"]')
        _self.properties.btnStopConnect = $('[data-action="stop_connect"]')
        _self.properties.blockActionStop = $('.net_client_started')
        _self.properties.blockActionStart = $('.net_client_stopped')
    }

    let processStatus = (status) =>  {
        if (_self.properties.prevSlow !== status.slow.log) {
            _self.properties.prevSlow = status.slow.log
            _self.properties.slow.html(status.slow.log)
        }
        if (_self.properties.prevFast !== status.fast.log) {
            _self.properties.prevFast = status.fast.log
            _self.properties.fast.text(status.fast.log)
        }
    }

    let startBackend = () => {
        setInterval(function () {
            getStatus().done(function (result) {
                processStatus(result)
            })
        }, _self.properties.interval)
    }

    this.Init = (options) => {
        _self.properties = $.extend(_self.properties, options)
        setObjects()
        _self.uninit()
        _self.bindEvents()
        if (_self.properties.showLog) {
            startBackend()
        }
        if (_self.properties.showHelp) {
            showHelp()
        } else {
            hideHelp()
        }
        _self.initStep[getStep()]()
    }

    this.uninit = () => {
        _self.properties.frmNetwork.off('submit')
    }

    this.formIsValid = () => {
        return true
    }

    this.bindEvents = () => {
        _self.uninit()
        _self.properties.frmNetwork.on('submit', function () {
            return _self.formIsValid()
        })
        _self.properties.btnHideHelp.on('click', function () {
            hideHelp()
        })
        _self.properties.btnShowHelp.on('click', function () {
            showHelp()
        })
        _self.properties.btnGetAccess.on('click', function () {
            getAccess().done(function (result) {
                if ('object' !== typeof result.access
                    || 'string' !== typeof result.access.domain
                    || 'string' !== typeof result.access.key) {
                    console.error('wrong_access')
                    return false
                } else {
                    if (result.access.error.length) {
                        error_object.show_error_block(result.access.error, 'error')
                    }
                    // To step 3
                    _self.properties.domainField.val(result.access.domain)
                    _self.properties.keyField.val(result.access.key)
                    _self.properties.hasAccess = result.access.is_correct
                    _self.initStep[getStep()]()
                }
            })
        })
        _self.properties.btnStartConnect.on('click', function () {
            connect('start')
        })
        _self.properties.btnStopConnect.on('click', function () {
            connect('stop')
        })
    }

    let connect = (action) => {

        ajax('admin/network/' + action).done((response) => {
            if (typeof response.error !== 'undefined' && response.error.length > 0) {
                error_object.show_error_block(response.error, 'error')
            }
            if (typeof response.success !== 'undefined' && response.success.length > 0) {
                _self.properties.blockActionStart.toggle()
                _self.properties.blockActionStop.toggle()
                error_object.show_error_block(response.success, 'success')
            }
        })

    }

    let showHelp = () => {
        _self.properties.showHelpInput.val(1)
        _self.properties.showHelpBlock.hide()
        _self.properties.helpBlock.show()
    }

    let hideHelp = () => {
        _self.properties.showHelpInput.val(0)
        _self.properties.showHelpBlock.show()
        _self.properties.helpBlock.hide()
    }

    let getStep = () => {
        let step
        if (_self.properties.isRegistered) {
            step = 4
        } else if (!_self.properties.meetsReqs) {
            step = 1
        } else if (!_self.properties.hasAccess) {
            step = 2
        } else if (!_self.properties.isRegistered) {
            step = 3
        } else {
            step = 4
        }
        return step
    }

    this.initStep = {
        1: () => {
            showElements(['help-section', 'requirements-section'])
            hideElements(['settings-header', 'access-section', 'settings-section',
                'save-section', 'connection-status-section'])
        },
        2: () => {
            showElements(['network-form', 'access-section',
                'btn-access-section'])
            hideElements(['access-fields-section', 'settings-header',
                'settings-section', 'save-section', 'connection-status-section'])
        },
        3: () => {
            showElements(['network-form', 'settings-section',
                'save-section'])
            hideElements(['upload-photos-section', 'access-section',
                'settings-header', 'connection-status-section',
                'requirements-section'])
        },
        4: () => {
            showElements(['help-section', 'requirements-section', 'network-form',
                'settings-header', 'settings-section', 'save-section', 'log-section',
                'connection-status-section', 'requirements-section', 'upload-photos-section'])
            hideElements(['btn-access-section'])
        }
    }

    _self.Init(optionArr)
}

if (typeof exports === 'object') {
    exports.__esModule = true
    exports.adminNetwork = adminNetwork
}
