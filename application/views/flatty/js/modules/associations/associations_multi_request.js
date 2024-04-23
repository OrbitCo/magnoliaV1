if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'user_associations_item',
        params: {module: 'associations', model: 'AssociationsModel', method: 'backendGetNewAssociations'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (resp.count) {
                $('.' + resp.gid + '_count').html(resp.count);
            } else {
                $('.' + resp.gid + '_count').html('');
            }

        },
        period: 300,
        status: 1
    });
}
