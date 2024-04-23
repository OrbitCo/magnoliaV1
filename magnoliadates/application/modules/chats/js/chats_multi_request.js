if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'chats_request',
        params: {module: 'chats', model: 'ChatsModel', method: 'backendGetRequestNotifications'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (resp) {
                for (var i in resp.notifications) {
                    var options = {
                        title: resp.notifications[i].title,
                        text: resp.notifications[i].text,
                        image: resp.notifications[i].image,
                        useGritter: true,
                        sticky: true,
                        time: 15000,
                        link: resp.notifications[i].link,
                    };
                    notifications.show(options);
                }
            }
        },
        period: 300,
        status: 1
    });
}
