function TwilioChatVideo() {
  this.room_name = null;
  this.tw_token = null;
  this.video_popup = null;
  this.tw_room = null;
  this.TW_Video = null;
  this.track_id = null;
  this.local_video = null;
  this.local_video_track = null;
  this.check_room_status_invite = null;
  this.check_room_status = null;
  this.tplPopup = "";
  this.user_id = null;
  this.participant = null;
  this.isOpenCaller = false;
  this.cameraDevice = [];
  this.camerasCounter = 0;
  this.timeCounter = 0;
  this.timeConnectCounter = 0;
  this.timeConnectCounterId = null;
  this.contentObj = null;

  let self = this;

  this.get_status_room = function (track_id, type) {

    $.ajax({
      url: site_url + 'twilio_chat/get_status_room/',
      type: 'POST',
      data: {'track_id': track_id, 'partner_id': self.participant.id, 'type': type, 'user_id': self.user_id},
      dataType: 'json',
      cache: false,
      success: function (resp) {
        if (typeof resp.track != 'undefined') {
          if (type === 'caller') {
            
            if (self.timeConnectCounter >= 30 && self.timeCounter === 0) {
              resp.track.status = 'disconnected'
            } else if (self.timeConnectCounter >= 30 && self.timeCounter > 0) {
              clearInterval(self.timeConnectCounterId);
              self.timeConnectCounter = 0;
            }

            if (resp.track.status !== 'in-progress' || resp.track.status === 'decline' || !self.video_popup) {

              clearInterval(self.timeConnectCounterId);
              self.timeConnectCounter = 0;

              if (self.video_popup) {
                self.video_popup.destroy();
              }

              clearInterval(self.check_room_status);
              self.check_room_status = null
              if (resp.track.status === 'decline') {
                error_object.show_error_block(resp.track.status_decline, 'warning');
              }
              self.closeBlock();
            }
          } else {
            if (resp.track.status !== 'in-progress' || resp.track.status === 'decline') {

              if (self.video_popup) {
                self.video_popup.destroy();
              }

              clearInterval(self.check_room_status_invite);
              self.check_room_status_invite = null;
              self.closeBlock();
              $('.menu-video-item').addClass('no-notifications');
              $('.menu-video-item .sum').text('');
            }
          }
          if (resp.track.status === 'disconnected') {
            error_object.show_error_block('disconnected', 'warning');
          }
        }

      }
    });
  }

  this.closeBlock = function () {

    if (self.room_name) {
      self.room_name = null;
    }
    if (self.tw_room) {
      self.tw_room.disconnect();
      self.tw_room = null;
      self.tw_token = null;
    }
    if (self.local_video_track) {
      self.local_video_track.stop();
      self.local_video_track = null;
    }

    self.video_popup = null;

    if (self.timeOfCall._counerId) {
      self.timeOfCall.stop();
    }

    self.isOpenCaller = false;

  }

  this.sendStatusRoom = function (track_id, status) {
    $.ajax({
      url: site_url + 'twilio_chat/set_status_room/',
      type: 'POST',
      data: {'track_id': track_id, 'status': status},
      dataType: 'json',
      cache: false,
      success: function (resp) {
        console.log('room status - ' + status);
      }
    });
  }

  this.generatePopup = function () {
    this.video_popup = new loadingContent({
      loadBlockTopType: 'center',
      otherClass: "twilio_chat",
      closeBtnPadding: 12,
      linkerObjID: null,
      blockBody: false,
      showAfterImagesLoad: true,
      onClose: self.closeBlock,
    });

    /* Переписал метод чтобы не закрывать по bg другого пути не нашел. */
    this.video_popup.active_bg = function () {
      if (!$("#" + self.video_popup.properties.loadBlockBgID).hasClass('gallery-type')) {
        $("#" + self.video_popup.properties.loadBlockBgID).css('display', 'flex');
      } else {
        $("#" + self.video_popup.properties.loadBlockBgID).show();
      }
    }

    self.tplPopup = $(document.querySelector('#twilioRoomContainer').innerHTML);
    self.tplPopup.removeAttr('style'); // deleting display none
    self.tplPopup.find('.local-media-tw').html('');
    self.tplPopup.find('.connect-tw').attr('id', self.room_name);

    if (self.participant) {
      self.tplPopup.find('.twilio_user_info_top')
        .css('background-image', 'url(' + self.participant.media.user_logo.thumbs.grand + ')');

      self.tplPopup.find('.modal-body').attr('id', "room-track-" + self.track_id + "");
      self.tplPopup.find('.twilio-room_user_info').html(self.participant.output_name + "</span>");
    }

    self.video_popup.show_load_block(self.tplPopup.html());

    // control panel
    $(".twilio-camera-off").off('click').click(function () {
      $(this).toggleClass("svg-active ");
      self.turnOffOnVideoStream();
    });

    $(".twilio-mute-switcher").off('click').click(function () {
      $(this).toggleClass("svg-active");
      self.turnOffOnMuteStream();
    });

    self.closeBtn();
    self.switchCamera();
  }

  this.initCall = function (token, room_name, id) {
    if (!self.tw_token && !self.room_name) {
      self.tw_token = token;
      self.room_name = room_name;
      self.track_id = id;
      self.createVideo();
    }
  }

  this.openCaller = function () {

    let user_content = $(document.querySelector('#callingToPartner').innerHTML);
    let link = self.participant.link;

    user_content.find('#partnerthumbs').attr('src', self.participant.media.user_logo.thumbs.great);
    user_content.find('#messageImage').attr('href', link);
    user_content.find('.partner_name').html("<a href='" + link + "'> " + self.participant.name + "</a>");
    user_content.find('.partner_year_numb').html("<a href='" + link + "'> " + self.participant.age + "</a>");

    $('.menu-video-more.dropdown-menu').find('.menu-alerts-more-items').css('text-align', 'center').html(user_content.html());
    $('.menu-video-item').removeClass('no-notifications');
    $('.menu-video-item .sum').text(1);
    $('.menu-video-item').addClass('open');
  }

  this.closeCaller = function () {
    $('.menu-video-more.dropdown-menu').find('.menu-alerts-more-items').html('');
    $('.menu-video-item').addClass('no-notifications');
    $('.menu-video-item .sum').text('');
    $('.menu-video-item').removeClass('open');
  }

  this.getInviteTwilio = function (token, room_name, id, participant, user_id, sid) {
    if (!self.video_popup && !self.isOpenCaller) {
      self.participant = participant;
      self.user_id = user_id;
      self.isOpenCaller = true;
      self.openCaller();

      if (!self.check_room_status_invite) {
        self.check_room_status_invite = setInterval(function () {
          self.get_status_room(id, 'partner');
        }, 5000);
      }

      $('.accept-chat').off('click').click(function () {
        self.closeCaller();
        self.initCall(token, room_name, id);
      });

      $('.decline-chat').off('click').click(function () {
        self.sendStatusRoom(id, 'decline', sid, self.user_id);
        self.closeCaller();
        self.isOpenCaller = false;
      });
      $("html, body").animate({scrollTop: 0}, "slow");
    }
  }

  this.sendInviteTwilio = function (user_id) {
    $.ajax({
      url: site_url + 'twilio_chat/get_room/' + user_id,
      type: 'POST',
      dataType: 'json',
      cache: false,
      success: function (resp) {
        if (typeof resp.info.access_denied !== 'undefined' && resp.info.access_denied.length > 0) {
          self.contentObj.show_load_block(resp.info.access_denied);
          return false;
        } else if (typeof resp.errors  !== 'undefined') {
          error_object.show_error_block(resp.errors, 'error');
        } else {
          if (resp.data) {
            if (resp.data.my_token) {
              self.tw_token = resp.data.my_token;
              self.room_name = resp.data.room_name;
              self.track_id = resp.data.track_id;
              self.participant = resp.data.participant;
              self.user_id = resp.data.user_id;
              self.createVideo();

              self.check_room_status = setInterval(function () {
                if (self.track_id) {
                  self.get_status_room(self.track_id, 'caller');
                }
              }, 5000);

              self.timeConnectCounterId = setInterval(() => {
                self.timeConnectCounter++
              }, 1000);
            }
          }
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (typeof console !== 'undefined') {
          console.error(errorThrown);
        }
      }
    });
  }

  /* Создаем видео поток*/
  this.createVideo = function () {

    let settingCon = {
      name: self.room_name,
      audio: true,
      maxAudioBitrate: 16000,
      video: {frameRate: 24}
    }
    self.TW_Video = Twilio.Video;
    if (self.TW_Video.isSupported) {

      self.generatePopup();

      self.TW_Video.connect(self.tw_token, settingCon).then(room => {
        self.tw_room = room;
        self.updateVideoDevice();
        room.participants.forEach(participantConnected);

        room.on('participantConnected', participantConnected);
        room.on('trackDisabled', (callee) => {
          if (callee.kind == 'video') {
            $(".twilio-room").removeClass('partner_in');
          }
        });
        room.on('trackEnabled', (callee) => {
          if (callee.kind == 'video') {
            $(".twilio-room").addClass('partner_in');
          }
        });
        room.on('trackStarted', () => {
          $(".twilio-room").addClass('partner_in');
        });
        //room.on('participantDisconnected', participantDisconnected);
        room.once('disconnected', participantDisconnected);
      }).catch(function (e) {
        console.log(e.message)
      });
    } else {
      error_object.show_error_block('Video stream unavailable, please connect webcam', 'error');
    }

    function participantConnected(participant) {

      self.timeOfCall.start();
      var div = document.createElement('div');
      div.id = participant.sid;
      div.classList = "caller";

      participant.on('trackSubscribed', track => trackSubscribed(div, track));
      participant.on('trackUnsubscribed', trackUnsubscribed);

      participant.tracks.forEach(publication => {
        if (publication.isSubscribed) {
          trackSubscribed(div, publication.track);
        }
      });

      $('#' + self.room_name).append(div);

    }

    function participantDisconnected(participant) {

      if (typeof participant.localParticipant != "undefined") {
        participant.localParticipant.tracks.forEach(publication => publication.track.stop());
      }

      self.timeOfCall.stop();
      self.sendStatusRoom(self.track_id, participant.state, self.tw_room.sid, self.user_id);
    }

    function trackSubscribed(div, track) {
      div.appendChild(track.attach());
    }

    function trackUnsubscribed(track) {
      track.detach().forEach(element => element.remove());
    }
  }

  this.addIndicator = function () {
    if (!$('.menu-video-item').length) {
      let html = document.querySelector('#callingIndicator');
      if (html) {
        let i_content = document.querySelector('#callingIndicator').innerHTML;

        $('.navbar-right #users-alerts-menu #menu_admin_alerts').before(i_content);
        $('.navbar-ava-xs').after(i_content);
        $('.navbar-header .menu-video-item').addClass('navbar-ava-xs');
        $('.menu-video-item').tooltip();
        $('.menu-video-item').off('click').click(function () {
          $('.menu-video-item').tooltip('hide');
        });
      }

    }
  }

  /*Получаем камеры*/
  this.gotDevices = function (mediaDevices) {
    mediaDevices.forEach(mediaDevice => {
      if (mediaDevice.kind === 'videoinput') {
        self.cameraDevice.push(mediaDevice.deviceId);
      }
    });
  }

  /*Переключатель камер front and back camera*/
  this.updateVideoDevice = function () {
    self.TW_Video.createLocalVideoTrack({deviceId: {exact: self.cameraDevice[self.camerasCounter]}}).then(function (localVideoTrack) {

      const tracks = Array.from(self.tw_room.localParticipant.videoTracks.values()).map(publication => publication.track);

      self.local_video_track = localVideoTrack;

      self.tw_room.localParticipant.unpublishTracks(tracks);
      self.tw_room.localParticipant.publishTrack(self.local_video_track);

      self.tw_room.localParticipant.audioTracks.forEach((publication) => {
        publication.track.enable();
      });

      self.local_video = $('.local-media-tw');
      self.local_video.html(self.local_video_track.attach());

    }).catch(function (err) {
      self.sendStatusRoom(self.track_id, 'disconnected');
      console.error(err);
    });
    ;
    ((self.cameraDevice.length - 1) > self.camerasCounter) ? self.camerasCounter++ : self.camerasCounter = 0;

    $(".twilio-mute-switcher").removeClass('svg-active');
    $(".twilio-camera-off").removeClass('svg-active');
  }

  /* кнопка включить или отключить видео */
  this.switchCamera = function () {
    if (self.cameraDevice.length > 1) {
      $('.twilio-camera-switcher').css('display', 'inline-flex');
    }
    $(document).off('click').on('click', '.twilio-camera-switcher', self.updateVideoDevice);
  }

  /* кнопка включить или отключить видео */
  this.turnOffOnVideoStream = function () {

      let local_video_track = self.local_video_track;

        if(typeof local_video_track === 'object' && local_video_track !== null){
          local_video_track.mediaStreamTrack.enabled = !!local_video_track.mediaStreamTrack.enabled;
          self.tw_room.localParticipant.videoTracks.forEach((publication) => {
      publication.track.isEnabled ? publication.track.disable() : publication.track.enable();
          });
        }else {
          $('.twilio-camera-off').removeClass('svg-active');
        }
  }

  /* кнопка включить или отключить аудио */
  this.turnOffOnMuteStream = function () {
      if(typeof self.tw_room === 'object' && self.tw_room !== null){
          self.tw_room.localParticipant.audioTracks.forEach((publication) => {
      publication.track.isEnabled ? publication.track.disable() : publication.track.enable();
          });
      }else {
        $('.twilio-mute-switcher').removeClass('svg-active');
      }
  }

  this.closeBtn = function () {
    $(".twilio_close").off('click').click(function (event) {
      event.preventDefault();
      $('.load_content_close').trigger('click');
    });
  }

  this.init = function () {

    self.addIndicator();
    if (navigator.mediaDevices)
      navigator.mediaDevices.enumerateDevices().then(self.gotDevices);

    $(document).on('pjax:complete', function (e) {
      self.video_popup = null;
      self.isOpenCaller = false;
      self.addIndicator();
      clearInterval(self.check_room_status_invite);
    });

    self.contentObj = new loadingContent({
      loadBlockWidth: '400px',
      loadBlockLeftType: 'center',
      loadBlockTopType: 'top'
    })
  }

  /*Show time in a chat*/
  this.timeOfCall = {
    _counerId: null,
    _sec: 0,
    _min: 0,
    _h: 0,
    start: function () {
      let boxTime = $('.twilio-room_user_time');
      this._counerId = setInterval(() => {
        this._step();
        this._sec = self.timeCounter++
        boxTime.show();
        boxTime.find('.twilio-room_user_time-counter').html(this._format());
      }, 1000);
    },
    stop: function () {
      let boxTime = $('.twilio-room_user_time');
      boxTime.hide();
      clearInterval(this._counerId);
      self.timeCounter = 0;
    },
    _step: function () {
      if (this._sec == 59) {
        this._min++;
        self.timeCounter = 0;
      }
      if (this._min == 59 && this.sec == 59) {
        this._h++;
        this._min = 0;
        this._sec = 0;
      }
      if (this._h == 23 && this._min == 59 && this.sec == 59) {
        this._h = 0;
        this._min = 0;
        this._sec = 0;
      }
    },
    _format: function () {

      let format = "";
      if (this._h) {
        format = this._h + ':' + this._min + ":" + this._sec;
      }

      if (this._min < 10) {
        format += +"0" + this._min;
      } else {
        format += this._min;
      }

      if (this._sec < 10) {
        format += ":0" + this._sec;
      } else {
        format += ":" + this._sec;
      }

      return format;
    }
  }

  self.init();

}

if (typeof exports === 'object') {
  exports.__esModule = true;
  exports.TwilioChatVideo = TwilioChatVideo;
}
