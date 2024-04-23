if (typeof MultiRequest !== 'undefined' && id_user !== 0) {
    MultiRequest.initAction({
        gid: 'twilio_video_request',
        params: {module: 'twilio_chat', model: 'Twilio_chat_video_model', method: 'backendGetRequests'},
        paramsFunc: function () {
            return {};
        },
        callback: function (resp) {
            if (resp.status == 'in-progress' && typeof TwilioPilot == 'undefined') {
                TwilioPilot  = new TwilioChatVideo();
                TwilioPilot.getInviteTwilio(resp.token, resp.room_name, resp.id, resp.participant,resp.user_id,resp.sid);
            } else if (typeof TwilioPilot != 'undefined' && resp.token !== undefined) {
                TwilioPilot.getInviteTwilio(resp.token, resp.room_name, resp.id, resp.participant,resp.user_id,resp.sid);
            } else if (resp.status  !== 'in-progress') {
                 TwilioPilot = undefined;
            }
        },
        period: 2,
        status: 1
    });
}
