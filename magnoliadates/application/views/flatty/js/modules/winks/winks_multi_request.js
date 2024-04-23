if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'winks',
        params: {module: 'winks', model: 'WinksModel', method: 'backendWinksCount'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if ( $('.winks_count').length == 0) {
                $('#activities_user-menu-activities_winks_item').append('<span class="badge winks_count summand"></span>');
                $('#activities_winks_item').append('<span class="badge winks_count summand"></span>');
            }

            if (resp.count) {
                $('.winks_count').html(resp.count);
            } else {
                $('.winks_count').html('');
            }

            let cnt = 0;

            $('.menu-user-menu-activities-more .badge').each(function(){
                cnt += Number($(this).html());
            });

            if (cnt > 0) {
                $('#menu-user-menu-activities-more .badge').html(cnt);
            }
        },
        period: 300,
        status: 0
    });

    if (id_user) {
        MultiRequest.enableAction('winks');
    }
    $(document).on('users:login', function () {
        MultiRequest.enableAction('winks');
    }).on('users:logout, session:guest', function () {
        MultiRequest.disableAction('winks');
    });
}
