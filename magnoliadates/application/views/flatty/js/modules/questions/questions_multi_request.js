if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'questions_request',
        params: {module: 'questions', model: 'QuestionsModel', method: 'backendGetNotifications'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (resp) {
                if (resp.new_questions > 0) {
                    $('.new_questions').html(resp.new_questions);
                } else {
                    $('.new_questions').html('');
                }
            }
        },
        period: 300,
        status: 1
    });
}
