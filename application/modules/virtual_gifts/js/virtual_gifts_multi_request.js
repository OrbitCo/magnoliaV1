if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'virtual_gifts',
        params: {module: 'virtual_gifts', model: 'VirtualGiftsModel', method: 'backendGetRequestNotifications'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (resp) {
                for (var i in resp.notifications) {
                    var options = {
                        title: resp.notifications[i].title,
                        text: resp.notifications[i].text,
                        image: resp.notifications[i].user_icon,
                        image_link: resp.notifications[i].link,
                        sticky: true,
                        time: 20000,
                        link: resp.notifications[i].user_link,
                        more: resp.notifications[i].more
                    };
                    notifications.show(options);
                    $('#receipt_gifts_list').append('<li class="menu-alerts-more-item"><span class="hide summand">1</span><a href="javascript:void(0);" gift-id="' + resp.notifications[i].id + '" class="receipt-gift">' + resp.notifications[i].text + '</a></li>');
                }
            }

        },
        period: 300,
        status: 1
    });

    $(document).on('users:login', function () {
        MultiRequest.enableAction('virtual_gifts');
    }).on('users:logout, session:guest', function () {
        MultiRequest.disableAction('virtual_gifts');
    });
}
