/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** ******  left menu  *********************** **/
$(function () {
    $('#sidebar-menu li ul').slideUp();
    //$('#sidebar-menu li').removeClass('active');

    $('#sidebar-menu li').click(function () {
        if ($(this).is('.active')) {
            $(this).removeClass('active');
            $('ul', this).slideUp();
            $(this).removeClass('nv');
            $(this).addClass('vn');
        } else {
            $('#sidebar-menu li ul').slideUp();
            $(this).removeClass('vn');
            $(this).addClass('nv');
            $('ul', this).slideDown();
            $('#sidebar-menu li').removeClass('active');
            $(this).addClass('active');
        }
    });
});

/* Sidebar Menu active class */
$(function () {
    var url = window.location;
    $('#sidebar-menu a[href="' + url + '"]').parent('li').addClass('current-page');
    $('#sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent('li').addClass('current-page').parent('ul').slideDown().parent().addClass('active');
});


$(function () {
    $('body.nav-sm .container.body .left_col')
})
/** ******  /left menu  *********************** **/



/** ******  tooltip  *********************** **/
$(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    /** ******  /tooltip  *********************** **/
    /** ******  progressbar  *********************** **/
if ($(".progress .progress-bar")[0]) {
    $('.progress .progress-bar').progressbar(); // bootstrap 3
}
/** ******  /progressbar  *********************** **/
/** ******  switchery  *********************** **/
if ($(".js-switch")[0]) {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html, {
            color: '#26B99A'
        });
    });
}
/** ******  /switcher  *********************** **/
/** ******  collapse panel  *********************** **/
// Close ibox function
$('.close-link').click(function () {
    var content = $(this).closest('div.x_panel');
    content.remove();
});

// Collapse ibox function
$('.collapse-link').click(function () {
    var x_panel = $(this).closest('.x_panel');
    var button = $(this).find('i');
    var content = x_panel.children('.x_content');
    content.slideToggle(200);
    (x_panel.hasClass('fixed_height_390') ? x_panel.toggleClass('').toggleClass('fixed_height_390') : '');
    (x_panel.hasClass('fixed_height_320') ? x_panel.toggleClass('').toggleClass('fixed_height_320') : '');

    if (button.hasClass('fa-chevron-up') || button.hasClass('fa-chevron-down')) {
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
    } else {
        button.toggleClass('fa-angle-right').toggleClass('fa-angle-down');
    }

    setTimeout(function () {
        x_panel.resize();
    }, 50);
});
/** ******  /collapse panel  *********************** **/
/** ******  iswitch  *********************** **/
$(document).ready(function () {
    $('input.flat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    }).on('ifClicked', function(event) {
        $(this).trigger('click');
    }).on('ifChanged', function(event) {
        $(this).trigger('change');
    }).on('ifChecked', function() {
        $(this).attr('checked', 'checked');
    }).on('ifUnchecked', function() {
        $(this).removeAttr('checked');
    }).on('ifDisabled', function() {
        $(this).attr('disabled', 'disabled');
    }).on('ifEnabled', function() {
        $(this).removeAttr('disabled');
    });
}).ajaxStop(function() {
    /* $('input.flat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    }).off('ifClicked').on('ifClicked', function(event) {
        $(this).trigger('click');
    }).off('ifChecked').on('ifChecked', function() {
        $(this).attr('checked', 'checked');
    }).off('ifUnchecked').on('ifUnchecked', function() {
        $(this).removeAttr('checked');
    }).off('ifDisabled').on('ifDisabled', function() {
        $(this).attr('disabled', 'disabled');
    }).off('ifEnabled').on('ifEnabled', function() {
        $(this).removeAttr('disabled');
    });  */
});
/** ******  /iswitch  *********************** **/
/** ******  star rating  *********************** **/
// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function ($, window) {
    var Starrr;

    Starrr = (function () {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function (e, value) {}
        };

        function Starrr($el, options) {
            var i, _, _ref,
                _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                _ = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on('mouseover.starrr', 'span', function (e) {
                return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function () {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'span', function (e) {
                return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function () {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
            }
            return _results;
        };

        Starrr.prototype.setRating = function (rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function (rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                }
            }
            if (!rating) {
                return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
            }
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function () {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function () {
                var data;

                data = $(this).data('star-rating');
                if (!data) {
                    $(this).data('star-rating', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function () {
    return $(".starrr").starrr();
});

$(document).ready(function () {

    $('#stars').on('starrr:change', function (e, value) {
        $('#count').html(value);
    });


    $('#stars-existing').on('starrr:change', function (e, value) {
        $('#count-existing').html(value);
    });

});
/** ******  /star rating  *********************** **/
/** ******  table  *********************** **/
/*$('.bulk_action input#check-all').on('ifChecked', function () {
    $(".bulk_action input[data='table_records']").iCheck('check');
});

$('.bulk_action input#check-all').on('ifUnchecked', function () {
    $(".bulk_action input[data='table_records']").iCheck('uncheck');
});

$('table input').on('ifChecked', function () {
    var disabled = $(this).prop('disabled');
    if (!disabled) {
        $(this).parent().parent().parent().addClass('selected');
    } else {
        $(this).iCheck('uncheck');
        $(this).parent().removeClass('checked');
    }
    countChecked();
});
$('table input').on('ifUnchecked', function () {
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});

function countChecked() {
    var n = $(".bulk_action input[data='table_records']:checked").length;
    if (n > 0) {
        $('.column-title').hide();
        $('.bulk-actions').show();
        $('.action-cnt').html(n + ' Records Selected');
    } else {
        $('.column-title').show();
        $('.bulk-actions').hide();
    }
}*/
/** ******  /table  *********************** **/
/** ******    *********************** **/
/** ******    *********************** **/
/** ******    *********************** **/
/** ******    *********************** **/
/** ******    *********************** **/
/** ******    *********************** **/
/** ******  Accordion  *********************** **/

$(function () {
    $(".expand").on("click", function () {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");

        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});

/** ******  Accordion  *********************** **/
/** ******  scrollview  *********************** **
$(document).ready(function () {

            $(".scroll-view").niceScroll({
                touchbehavior: true,
                cursorcolor: "rgba(42, 63, 84, 0.35)"
            });

});
** ******  scrollview  *********************** **/

$(function () {
    $('.btn.btn-primary.dropdown-toggle').on('click', function() {
        var height = $(window).height() + $(window).scrollTop();
        var menu = $(this).next();
        var offset = $(this).offset().top + menu.height() + 50 - height;
        if (offset > 0) {
            menu.css({top:  (- offset)+ 'px'});
        }
    });
    $('#btn_support').width(function(){
        var btnSupport = document.getElementById("btn_support").offsetWidth;
        if (btnSupport < 165) {
            return (btnSupport+5) + 'px';
        }
    });
    $('body>div.container.body').height(function(){
        return $(document).height()+'px';
    });

    let setWindowWidth = function (container_width) {
        $('body>div.container.body').width(container_width);
    };
    let window_width = $(window).width();
    setWindowWidth(window_width);
    $(window).resize(function() {
        window_width = $(window).width();
        setWindowWidth(window_width)
    });
});
