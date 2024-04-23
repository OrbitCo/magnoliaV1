require('@fortawesome/fontawesome-free/css/all.css');
require('jquery-ui/themes/base/all.css');
require('@js/jquery.imgareaselect/css/imgareaselect-default.css');
require('@js/emoji-picker/css/emoji.css');

const $ = require('jquery');
window.$ = $;
window.jQuery = $;

require('jquery-pjax');
require('jquery-ui');
require('jquery-ui/ui/widgets/autocomplete');
require('jquery-ui/ui/widgets/draggable');
require('jquery-ui/ui/widgets/slider');
require('jquery-ui/ui/widgets/datepicker');
require('jquery-ui/ui/effects/effect-transfer');
require('jquery-ui/ui/i18n/datepicker-da');
require('jquery-ui/ui/i18n/datepicker-de');
require('jquery-ui/ui/i18n/datepicker-en-GB');
require('jquery-ui/ui/i18n/datepicker-es');
require('jquery-ui/ui/i18n/datepicker-fr');
require('jquery-ui/ui/i18n/datepicker-it');
require('jquery-ui/ui/i18n/datepicker-nl');
require('jquery-ui/ui/i18n/datepicker-no');
require('jquery-ui/ui/i18n/datepicker-pt');
require('jquery-ui/ui/i18n/datepicker-ru');
require('jquery-ui/ui/i18n/datepicker-th');
require('bootstrap');
require('lazysizes');

require('@js/slick/slick.min');
require('@js/jquery.imgareaselect/jquery.imgareaselect');
require('@js/jquery.placeholder');
require('@js/jquery.gritter');
require('@js/jquery.notification');
require('@js/jquery.jcarousel.min');
require('@js/jquery.jeditable.mini');
require('@js/bootstrap-switch/dist/js/bootstrap-switch');

window.NProgress = require('@js/nprogress/nprogress');
window.Errors = require('@js/errors').Errors;
window.pginfo = require('@js/pginfo').pginfo;
window.Alerts = require('@js/alerts').Alerts;
window.Notifications = require('@js/notifications').Notifications;
window.MultiRequest = require('@js/multi_request').MultiRequest;
window.loadingContent = require('@flatty/js/loading_content').loadingContent;
window.available_view = require('@js/available_view').available_view;
window.DatepickerDropdownTemplate = require('@js/datepicker-dropdown-template').DatepickerDropdownTemplate;
window.webcamera = require('@js/webcamera').webcamera;
window.autocompleteInput = require('@js/autocomplete_input').autocompleteInput;

const {
    loaded_scripts,
    log_events,
    loadScripts,
    locationHref,
    log,
    removeHTML,
    in_array,
    autoResize,
    sendAnalytics,
    lightGetCookie,
    lightScriptCallback,
    lightSend,
    lightSendScriptRequest,
    lightSetCookie,
    redirect
} = require('@js/functions');

const {
    uploader,
    uploadErrorObject,
    uploaderObject,
    progressBar,
} = require('@js/uploader');

window.error_object = new Errors;
window.uploader = uploader;
window.uploadErrorObject = uploadErrorObject;
window.uploaderObject = uploaderObject;
window.progressBar = progressBar;
window.loaded_scripts = loaded_scripts
window.log_events = log_events
window.loadScripts = loadScripts
window.locationHref = locationHref
window.log = log
window.removeHTML = removeHTML
window.in_array = in_array
window.autoResize = autoResize
window.sendAnalytics = sendAnalytics
window.lightGetCookie = lightGetCookie
window.lightScriptCallback = lightScriptCallback
window.lightSend = lightSend
window.lightSendScriptRequest = lightSendScriptRequest
window.lightSetCookie = lightSetCookie
window.redirect = redirect

const jQueryShow = $.fn.show;
$.fn.show = function () {
    jQueryShow.apply(this);
    this.removeClass('hide');
    return this;
};
