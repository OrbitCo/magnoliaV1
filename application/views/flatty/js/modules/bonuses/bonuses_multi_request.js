'use strict';
if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'bonuses_request',
        params: {module: 'bonuses', model: 'BonusesModel', method: 'backendGetRequestNotifications'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (resp.bonuses != '') {
                for (var i in resp.bonuses) {
                    var options = {
                        title: resp.bonuses[i].title,
                        text: resp.bonuses[i].text,
                        sticky: true,
                        time: 15000
                    };
                    notifications.show(options);
                }
            }
        },
        period: 300,
        status: 1
    });
}
