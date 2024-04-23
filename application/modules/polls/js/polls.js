function Polls(optionArr)
{

    this.properties = {
        siteUrl: '',
        poll_id: '',
        ajaxPollUrl: 'polls/ajax_poll/'
    }

    var _self = this;

    this.errors = {
    }

    this.Init = function (options) {
        _self.properties = $.extend(_self.properties, options);
        _self.bind_events();
    }

    this.bind_events = function () {
        $('#poll_block_' + _self.properties.poll_id + ' .respond').on('click', function () {
            _self.save_result($('#poll_block_' + _self.properties.poll_id));
            return false;
        });
        $('#poll_block_' + _self.properties.poll_id + ' .next_poll').on('click', function () {
            _self.update_poll($('#poll_block_' + _self.properties.poll_id));
            return false;
        });
    }

    this.update_poll = function (poll_block, poll_id) {
        poll_id = poll_id || 0;
        $.get(_self.properties.siteUrl + _self.properties.ajaxPollUrl + poll_id, function (response) {
            poll_block.addClass('old_block').hide();
            poll_block.before(response);
            $('.old_block').remove();
        });
    }

    this.save_result = function (poll_block) {
        var form = poll_block.find('form');
        if (form.find('input[name^=answer]:checked').val() > 0) {
            poll_block.addClass('old_block').hide();
            var poll_data = form.serialize();
            var url = _self.properties.siteUrl + 'polls/ajax_save_result/';
            $.post(url, poll_data, function (response) {
                if (response!='error') {
                    poll_block.before(response);
                    $('.old_block').remove();
                }else {
                    location.href=_self.properties.siteUrl+'polls';
                }
            });
        }
    }

    _self.Init(optionArr);
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.Polls = Polls;
}
