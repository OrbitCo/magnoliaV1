if (typeof MultiRequest !== 'undefined') {
    function showViewersNotifications(viewers, viewers_langs)
    {
        for (i in viewers) {
            var options = {
                title: viewers_langs.title,
                text: viewers[i].output_name +  ' ' +viewers_langs.message,
                link: site_url + 'users/view/' + viewers[i].id + '/profile',
                image: viewers[i].media.user_logo.thumbs.small,
                image_link: site_url + 'users/view/' + viewers[i].id + '/profile',
            };
            notifications.show(options);
        }
    }
    MultiRequest.initAction({
        gid: 'visitors',
        params: {module: 'users', model: 'UsersViewsModel', method: 'backendGetViewersCount'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (typeof resp.viewers != 'undefined' && resp.viewers.length > 0) {
                showViewersNotifications(resp.viewers, resp.viewers_langs);
            }
            if (resp.count) {
                $('.visitors_count').html(resp.count);
            } else {
                $('.visitors_count').html('');
            }
        },
        period: 300,
        status: 0
    });

    if (id_user) {
        MultiRequest.enableAction('visitors');
    }
    $(document).on('users:login', function () {
        MultiRequest.enableAction('visitors');
    }).on('users:logout, session:guest', function () {
        MultiRequest.disableAction('visitors');
    });
}
