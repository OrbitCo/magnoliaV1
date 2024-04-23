
function PollsList(optionArr)
{
    this.properties = {
        siteUrl: '',
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
        $('.poll_question_link').on('click', function () {
            if ($(this).next('.poll_results_content').is(':hidden')) {
                _self.show_poll($(this));
            } else {
                _self.hide_poll($(this));
            }
        });
    }

    // Polls list
    this.show_poll = function (block) {
        var poll_id =  block.attr('id').replace(/\D+/g, '');
        var url     = _self.properties.siteUrl + _self.properties.ajaxPollUrl + poll_id + '/1';
        block.find('[data-role="expander"]').removeClass('down').addClass('up');
        if (block.next('.poll_results_content').html() == '') {
            block.next('.poll_results_content').load(url, function () {
                block.next('.poll_results_content').show();
            });
        } else {
            block.next('.poll_results_content').show();
        }
    }

    this.hide_poll = function (block) {
        block.find('[data-role="expander"]').removeClass('up').addClass('down');
        block.next('.poll_results_content').hide();
    }

    _self.Init(optionArr);

}

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.PollsList = PollsList;
}
