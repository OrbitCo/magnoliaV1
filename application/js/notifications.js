function Notifications(optionArr)
{

    const _self = this;
    if (Notifications.prototype._singletonInstance) {
        return Notifications.prototype._singletonInstance;
    }
    Notifications.prototype._singletonInstance = _self;

    this.properties = {
    };

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        return _self;
    };

    this.show = function (options) {
        if (typeof(options.useGritter) !== 'undefined' && options.useGritter) {
            _self.show_gritter(options);
            return _self;
        }

        var permission;

        try {
            permission = $.notification.permissionLevel();
        }catch (e) {
            _self.show_gritter(options);
            return _self;
        }
        
        if ('granted' === permission || 'default' === permission) {
            _self.show_html5(options);
        } else {
            _self.show_gritter(options);
        }
        return _self;
    };

    this.show_gritter = function (options) {
        const gritter_id = $.gritter.add({
            title: options.title,
            text: options.text.replace('\[more\]', options.more),
            image: options.image,
            image_link: options.image_link,
            sticky: options.sticky,
            time: options.time
        });
        $('#gritter-item-'+gritter_id).on('click', 'a', function () {
            $.gritter.remove(gritter_id);
        });
    };

    this.show_html5 = function (options) {
        const body = removeHTML(options.text).replace('\[more\]', '');
        $.notification({
            iconUrl: options.image,
            title: options.title,
            body: body,
            onclick: function () {
                locationHref(options.link);
            },
            onerror: function () {
                _self.show_gritter(options);
            },
        });
    };

    _self.Init(optionArr);

}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.Notifications = Notifications;
}