function Ratings(optionArr)
{
    this.properties = {
        siteUrl: '',
        ratingId: '',
        readOnly: false,
        showLabel: false,
        useMinAsDefault: false,
        errorObj: new Errors,
        isRTL: false,
        cbSendForm: null,
        mouseX: 0,
        mouseY: 0,
        rand: 0
    };

    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);

        $(window).mousemove(function (event) {
            _self.properties.mouseX = event.clientX;
            _self.properties.mouseY = event.clientY;
            $('#rating_current-' + _self.properties.rand).css('position', 'fixed');
            $('#rating_current-' + _self.properties.rand).css('padding', '10px');
            $('#rating_current-' + _self.properties.rand).css('top', (_self.properties.mouseY + 8) + 'px');
            $('#rating_current-' + _self.properties.rand).css('left', (_self.properties.mouseX + 8) + 'px');
        });

        $('#' + _self.properties.ratingId + ', #extended-' + _self.properties.ratingId + ' .rating').each(function (i, block) {
            var options = [];
            options = $.extend(_self.properties, options);
            block = $(block);
            block = {
                el: block,
                values: {},
                score: block.find('input[name^=rating_data]').data('my-set-mark'), // view only my mark in top list
                //block.find('input[name^=rating_data]').data('mark'),
                //block.find('input[name^=rating_data]').val(),
                label: block.find('#rating_current-' + _self.properties.rand),
                l: '',
                options: options,
                min: 1,
                max: 1,
            };

            block.el.on('mouseleave', function () {
                if (_self.properties.readOnly) {
                    return;
                }
                _self.render(block);
            });
            block.el.find('ins').each(function (j, item) {
                item = $(item);
                item.on('mouseover', function () {
                    if (block.options.readOnly) {
                        return;
                    }
                    _self.render(block, item.data('id'), item.data('label'));
                    if (!navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/)) {
                        block.label.show();
                    }
                }).on('mouseout', function () {
                    if (!navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/)) {
                        block.label.hide();
                    }
                }).on('click', function () {
                    if (block.options.readOnly) {
                        return;
                    }

                    if ($('input[name^=id_poster]').val() == '') {
                        $('html, body').animate({
                            scrollTop: $("#ajax_login_link_menu").length ? $("#ajax_login_link_menu").offset().top : 0
                        }, 1000);
                        $("#ajax_login_link").click();
                    } else {
                        var score = item.data('id');
                        block.score = score;
                        block.l = item.data('label');
                        if (!block.l) {
                            block.l = '';
                        }
                        block.el.find('input[name^=rating_data]').val(block.score);

                        if (typeof _self.properties.cbSendForm == "function") {
                            _self.properties.cbSendForm();
                        }

                        _self.render(block);
                    }
                });

                block.min = Math.min(block.min, item.data('id'));
                block.max = Math.max(block.max, item.data('id'));
                block.values[j] = {el: item, value: item.data('id'), label: item.data('label')};
            });

            _self.render(block);
        });
    }

    this.render = function (block, score, label) {
        score = score || block.score;
        label = label || block.l;
        block.label.html('');
        block.el.find('.rating-vals').css({'width': Math.round((score / block.max) * 100) + '%'}).show();
        block.label.html(label);
    }

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.Ratings = Ratings;
}
