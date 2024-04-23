if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'user_information_request',
        params: {module: 'user_information', model: 'UserInformationModel', method: 'backendGetRequestNotifications'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (resp) {
                for (var i in resp.notifications) {
                    var options = {
                        title: resp.notifications[i].title,
                        text: resp.notifications[i].text,
                        sticky: true,
                        time: 15000
                    };
                    notifications.show(options);
                }
            }
        },
        period: 60,
        status: 1
    });
}
