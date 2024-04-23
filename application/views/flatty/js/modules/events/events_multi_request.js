if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'events_request',
        params: {module: 'events', model: 'EventsModel', method: 'backendGetRequestNotifications'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (typeof resp.events !== 'undefined' && resp.events.length > 0) {
                for (var i in resp.events) {
                    var req = resp.events[i];
                    var options = {
                        title: req.title,
                        text: req.text,
                        sticky: true,
                        time: 15000
                    };
                    notifications.show(options);
                }
            }

          if (resp.request_count){
            $('.user_events_item_count').html(resp.request_count);
          }
        },
        period: 300,
        status: 1
    });
}
