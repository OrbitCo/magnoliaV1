function Ratings(optionArr)
{
    this.properties = {
        siteUrl: '',
        ratingId: '',
        readOnly: false,
        width: 39,
        height: 39,
        type: 'previous',
        showLabel: false,
        useMinAsDefault: false,
        errorObj: new Errors,
        isRTL: false,
    };

    var _self = this;

    _self.blocks = [];

    _self.types = ['one', 'previous', 'next'];

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        $('#'+_self.properties.ratingId+', #extended-'+_self.properties.ratingId+' .rating').each(function (i, block) {
            var options = [];
            options = $.extend(_self.properties, options);
            block = $(block);
            block = {
                el: block,
                values: {},
                score: block.find('input[name^=rating_data]').val(),
                label: block.find('label'),
                options: options
            };
            if (_self.properties.showLabel) {
                block.label.css({display: 'inline-block'});
            }
            block.el.on('mouseleave',function () {
                if (_self.properties.readOnly) {
                    return;
                }
                _self.render(block);
            });
            block.el.find('li').each(function (j, item) {
                item = $(item);
                item.on('mouseover', function () {
                    if (block.options.readOnly) {
                        return;
                    }
                    _self.render(block, item.attr('data-id'));
                /*}).on('mouseleave',function(){
                    if(block.options.readOnly) return;
                    _self.render(block);*/
                }).on('click',function () {
                    if (block.options.readOnly) {
                        return;
                    }
                    var score = item.attr('data-id');
                    if (block.score != score) {
                        block.score = score;
                    }else {
                        block.score = 0;
                    }
                    block.el.find('input[name^=rating_data]').val(block.score)
                    _self.render(block);
                });
                block.values[j] = {el: item, value: item.attr('data-id'), label: item.attr('data-label')};
            });
            _self.blocks[i] = block;
            _self.render(block);
        });
    }

    this.render = function (block, score) {
        score = score || block.score;
        block.label.html('');
        block.el.find('.custom').remove();
        var p = 0;
        var cscore = null;
        var old_item = null;
        for (var i in block.values) {
            var item = block.values[i];
            item.el.attr('class', item.el.hasClass('hide') ? 'hide' : 'far');
            if (old_item == null && score>0 && item.value>=score) {
                p = score/item.value;
                cscore = {el: item.el, value: item.value, label: item.label};
            }
            if (old_item && old_item.value<score && item.value>=score) {
                p =(score-old_item.value)/(item.value-old_item.value);
                if (p >= 0.5) {
                    cscore = {el: item.el, value: item.value, label: item.label};
                }else {
                    cscore = {el: item.el, value: old_item.value, label: old_item.label};
                }
            }
            if (!cscore && _self.properties.useMinAsDefault) {
                cscore = {el: item.el, value: item.value, label: item.label};
            }
            old_item = item;
        }

        if (!cscore) {
            return;
        }

        switch (block.options.type) {
            case 'previous':
                cscore.el.prevAll().addClass('fas rating-'+cscore.value);
            break;
            case 'next':
                cscore.el.nextAll().addClass('fas rating-'+cscore.value);
            case 'equal':
            default:
            break;
        }
        if (p>0 && p<1) {
            cscore.el.before(cscore.el.clone(true));
            cscore.el.addClass('custom').css('marginLeft', '-'+cscore.el.width()+"px").width(cscore.el.width()*(p));
        }
        block.label.html(cscore.label);
        cscore.el.addClass('fas rating-'+cscore.value);
    }

    _self.Init(optionArr);
}



if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.Ratings = Ratings;
}
