if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'friendlist_request',
        params: {module: 'friendlist', model: 'FriendlistModel', method: 'backendGetRequestNotifications'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (resp.friends && resp.friends) {
                for (var i in resp.friends) {
                    var req = resp.friends[i];
                    if (req.notified == 1) {
                        continue;
                    }
                    var options = {
                        title: req.title,
                        text: req.text,
                        image: req.user_icon,
                        image_link: req.user_link,
                        sticky: true,
                        time: 15000
                    };
                    notifications.show(options);
                }
                if (resp.friends.length) {
                    $('.friend_requests_count').html(resp.friends.length);
                } else {
                    $('.friend_requests_count').html('');
                }
            }
        },
        period: 300,
        status: 0
    });
    MultiRequest.initAction({
        gid: 'friendlist_accept',
        params: {module: 'friendlist', model: 'FriendlistModel', method: 'backendGetAcceptNotifications'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (resp.friends && resp.friends.length) {
                for (var i in resp.friends) {
                    var req = resp.friends[i];
                    if (req.notified == 1) {
                        continue;
                    }

                    var options = {
                        title: req.title,
                        text: req.text,
                        image: req.user_icon,
                        image_link: req.user_link,
                        sticky: false,
                        time: 15000
                    };
                    notifications.show(options);
                }
            }
        },
        period: 300,
        status: 0
    });

    if (id_user) {
        MultiRequest.enableAction('friendlist_request').enableAction('friendlist_accept');
    }
    $(document).on('users:login', function () {
        MultiRequest.enableAction('friendlist_request').enableAction('friendlist_accept');
    }).on('users:logout, session:guest', function () {
        MultiRequest.disableAction('friendlist_request').disableAction('friendlist_accept');
    });
}
