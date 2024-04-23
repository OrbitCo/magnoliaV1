function radio(optionArr) {
    this.properties = {
        labelClass: 'label',
        boxClass: 'box',
        checkedClass: 'checked',
        hoveredClass: 'hovered',
        elementsIDs: []
    };
    var _self = this;

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        for (var m in _self.properties.elementsIDs) {
            _self.initBox(_self.properties.elementsIDs[m]);
        }
    };

    this.initBox = function (box_id) {
        if ($('#' + box_id).length < 1)
            return;

        $('#' + box_id + ' .' + _self.properties.labelClass + ', #' + box_id + ' .' + _self.properties.boxClass)
                .unbind('mouseenter')
                .on('mouseenter', function () {
                    var gid = $(this).attr('gid');
                    $('#' + box_id + ' .' + _self.properties.boxClass + '[gid=' + gid + ']').addClass(_self.properties.hoveredClass);
                })
                .unbind('mouseleave')
                .on('mouseleave', function () {
                    var gid = $(this).attr('gid');
                    $('#' + box_id + ' .' + _self.properties.boxClass + '[gid=' + gid + ']').removeClass(_self.properties.hoveredClass);
                });

        $('#' + box_id + ' .' + _self.properties.labelClass + ', #' + box_id + ' .' + _self.properties.boxClass)
                .unbind('click')
                .on('click', function () {
                    var gid = $(this).attr('gid');
                    _self.checkBox(box_id, gid);
                });
    };

    this.checkBox = function (box_id, gid) {
        _self.uncheckBoxAll(box_id);
        $('#' + box_id + ' .' + _self.properties.boxClass + '[gid=' + gid + ']').addClass(_self.properties.checkedClass);
        $('#' + box_id + ' input[value=' + gid + ']').remove();

        var input_name = $('#' + box_id).attr('iname');
        if (!input_name)
            input_name = box_id;

        $('#' + box_id).append('<input type="hidden" name="' + input_name + '" value="' + gid + '">');
        $('#' + box_id + ' input[value=' + gid + ']:first').change();
    };

    this.uncheckBox = function (box_id, gid) {
        $('#' + box_id + ' .' + _self.properties.boxClass + '[gid=' + gid + ']').removeClass(_self.properties.checkedClass);
        $('#' + box_id + ' input[value=' + gid + ']:first').remove();
    };

    this.uncheckBoxAll = function (box_id) {
        $('#' + box_id + ' .' + _self.properties.boxClass).each(function () {
            var gid = $(this).attr('gid');
            _self.uncheckBox(box_id, gid);
        });
    };

    _self.Init(optionArr);
}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.radio = radio;
}
