if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'referral_links_request',
        params: {module: 'referral_links', model: 'ReferralLinksModel', method: 'backendGetReferralNotification'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (resp) {
                for (var i in resp.notifications) {
                    var options = {
                        title: resp.notifications[i].title,
                        text: resp.notifications[i].text,
                        sticky: false,
                        time: 15000,
                        link: resp.notifications[i].link,
                        more: resp.notifications[i].more,
                    };
                    notifications.show(options);
                }
            }
        },
        period: 300,
        status: 1
    });
}
