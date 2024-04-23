function pginfo(optionArr)
{
    this.properties = {
        messages : ''
    };

    const _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.add_messages();
    };

    this.add_messages = function () {
        let elem;
        let msgElem;
        if (null === _self.properties.messages) {
            return false;
        }
        $.each(_self.properties.messages, function (type, messages) {
            if (typeof messages === 'object') {
                $.each(messages, function (key, message) {
                    elem = $('[name="' + message.name + '"]');
                    if (0 === elem.length) {
                        elem = $('#' + message.name);
                    }
                    if (0 !== elem.length) {
                        elem.addClass('pginfo field ' + type);
                    }

                    msgElem = $('.pginfo.msg.' + message.name);
                    if (0 === msgElem.length) {
                        elem.after('<span class="pginfo msg ' + message.name + ' ' + type + '">' + message.text + '</span>');
                    } else if (0 !== msgElem.length) {
                        msgElem.addClass(type).html(message.text);
                    }
                });
            }
        });
    };

    _self.Init(optionArr);
}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.pginfo = pginfo;
}