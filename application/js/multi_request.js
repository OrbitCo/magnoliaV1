MultiRequest = (function () {

    const runTimeout = function () {
        if (self.properties.active) {
            if (typeof (self.to) !== 'undefined') {
                clearTimeout(self.to);
            }
            self.to = setTimeout(execute, self.properties.timeout);
        }
        return self;
    };
    const execute = function () {
        const post_data = {data: {}};
        post_data.not_update_online_status = 1;
        post_data.without_message = 1;
        for (const gid in self.properties.actions) {
            const action = self.properties.actions[gid];
            if (action.update_online_status == 1) {
                post_data.not_update_online_status = 0;
            }
            if (((self.properties.hotstart && self.counter == 0) || (self.counter % action.period == 0)) && action.status) {
                const params = {'gid': action.gid, 'counter': ++action.counter};
                $.extend(params, action.params);
                if (action.paramsFunc) {
                    $.extend(params, action.paramsFunc(action));
                }
                post_data.data[action.gid] = params;
            }
        }

        self.counter++;
        if (!$.isEmptyObject(post_data.data)) {
            $.ajax({
                type: 'POST',
                url: self.properties.url,
                data: post_data,
                success: function (resp) {
                    if (resp) {
                        if (typeof resp.user_session_id !== 'undefined' && resp.user_session_id == 0) {
                            $(document).trigger('session:guest');
                        }
                        for (var gid in resp) {
                            if (resp.hasOwnProperty(gid)) {
                                if (self.properties.actions[gid]) {
                                    self.properties.actions[gid].callback(resp[gid]);
                                }
                            }
                        }
                    }
                    runTimeout();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    self.properties.error_count++;
                    if (typeof (console) !== 'undefined') {
                        if (self.properties.error_count >= self.properties.error_limit) {
                            console.log('Too many errors. MultiRequest stopped.');
                        }
                    }
                    if (self.properties.error_count >= self.properties.error_limit) {
                        self.unInit();
                    } else {
                        runTimeout();
                    }
                },
                dataType: 'json',
                backend: 1
            });
        } else {
            runTimeout();
        }
    };
    const self = {};

    self.properties = {
        url: '/start/ajax_backend/',
        timeout: 1000,
        active: true,
        actions: {},
        error_count: 0,
        error_limit: 10,
        hotstart: 1
    };


    self.init = function (options) {
        self.counter = self.properties.hotstart ? 0 : 1;
        self.properties.active = true;
        self.properties.error_count = 0;
        if (self.properties.hotstart) {
            execute();
        } else {
            runTimeout();
        }
        return self;
    };


    self.unInit = function () {
        if (typeof (self.to) !== 'undefined') {
            clearTimeout(self.to);
        }
        self.properties.active = false;
        return self;
    };


    self.initAction = function (action) {
        if (!self.properties.actions[action.gid]) {
            self.properties.actions[action.gid] = action;
            self.properties.actions[action.gid].counter = 0;
        }
        return self;
    };

    self.initActions = function (actions) {
        if (typeof (actions) === 'object') {
            for (const i in actions) {
                if (actions.hasOwnProperty(i) && typeof (actions[i]) === 'object') {
                    self.initAction(actions[i]);
                }
            }
        }
        return self;
    };


    self.disableAction = function (action_gid) {
        if (self.properties.actions[action_gid]) {
            self.properties.actions[action_gid].status = 0;
        }
        return self;
    };


    self.enableAction = function (action_gid) {
        if (self.properties.actions[action_gid]) {
            self.properties.actions[action_gid].status = 1;
        }
        return self;
    };


    self.deleteAction = function (action_gid) {
        if (self.properties.actions[action_gid]) {
            delete self.properties.actions[action_gid];
        }
        return self;
    };


    self.setProperties = function (property, value) {
        value = value || null;
        if (typeof (property) === 'object') {
            $.extend(self.properties, property);
        } else if (typeof (property) === 'string') {
            self.properties[property] = value;
        }
        return self;
    };


    return self;
})();

if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.MultiRequest = MultiRequest;
}
