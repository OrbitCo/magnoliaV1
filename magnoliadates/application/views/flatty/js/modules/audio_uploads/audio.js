function audio(optionArr)
{
    this.properties = {
        item_id: 0,
        timelineWidth: '',
        duration: '',
        siteUrl: '',
        deleteUrl: '',

        timelineWidthWide: '',
        firstTrack: '',
        lastTrack: '',
        nextTrack: '',
        prevTrack: '',
        themeType: '',

                //audio_items
        timelineItem: 'timeline_',
        playheadItem: 'playhead_',
        durationItem: 'duration_',
        audionameItem: 'audioname_',
        playheadBallItem: 'playhead-ball_',
                //audio blocks
        wideBlockItem: 'audio-wide-block',

                //play buttons
        playButtonItem: 'play-track',
        playGalleryButtonId: '#play_',
        playPopupButtonId: '.play-track_',
        playWideButtonId: '#play_wide',
        playButtonIcon: 'fa-play',
        pauseButtonIcon: 'fa-pause',

                //next/prev buttons
        nextButtonItem: 'next-track',
        prevButtonItem: 'prev-track',

                //other buttons
        volumeButtonItem: 'volume-track',
        repeatButtonItem: '',

        repeat: '',
    }
        this.objects = {
            music: '',
            timeline: '',
            playhead: '',
            elem: '',

            timelineWide: '',
            playheadWide: '',
            elemWide: '',

            timelinePopup: '',
            playheadPopup: '',
            elemPopup: '',

            is_playing: 0,
    }

        var _self = this;

    this.Init = function (options) {
                _self.properties = $.extend(_self.properties, options);
                _self.setButtons();
    }

        this.setButtons = function () {
                $('html').off('click').on("click", '.' + _self.properties.playButtonItem, function () {
                    var item_id = $(this).parent().data("id-media");

                    if (typeof item_id != 'undefined') {
                        if (!_self.properties.item_id) { //first start
                            $('.' + _self.properties.wideBlockItem).show();
                            _self.setTrack(item_id);
                        } else if (item_id != _self.properties.item_id) { //new track
                            _self.reloadTimeline();
                            _self.clearCurrentTrack();
                            _self.setTrack(item_id);
                        }
                    }

                    if (_self.properties.item_id) {
                        _self.changePlay();
                    }
                });

                $('.' + _self.properties.nextButtonItem).off('click').on('click', function () {
                    _self.playNext();
                });

                $('.' + _self.properties.prevButtonItem).off('click').on('click', function () {
                    _self.playPrev();
                });

                $('.' + _self.properties.volumeButtonItem).off('click').on('click', function () {
                    _self.volumeButton();
                });
        }

        this.setTrack = function (item_id) {

                _self.properties.item_id = item_id;
                _self.setCurrentAudio();
                _self.setWideBlock();
                _self.setTracks();

                _self.objects.music.addEventListener("timeupdate", _self.timeUpdateEvents, false);
                _self.objects.music.addEventListener("ended", _self.playEndedEvents, false);
                //_self.objects.music.addEventListener("pause", _self.playTestEvents, false);

                //**********
                var repeat_track_option = $('.repeat-track-option');
                repeat_track_option.on('click', function () {
                    $(this).children('p').hide();
                    $(this).removeClass("active");
                    var next_option = $(this).next();

                    if (next_option.length != '0') {
                        _self.properties.repeat = next_option.addClass("active").attr("value");
                    } else {
                        _self.properties.repeat = $(this).parent().children(':first-child').addClass("active").attr("value");
                    }
                });

                repeat_track_option.hover(function () {
                    $(this).children('p').show();
                },
                function () {
                        $(this).children('p').hide();
                });

                $('html').on('click', '.timeline_' + _self.properties.item_id, function (event) {

                    var timeline_width = $(this).outerWidth();
                    var timeline_click = $(this).offset();

                    var currentTimePercent = ((event.pageX - timeline_click.left) * 100) / timeline_width;

                    $('.' + _self.properties.playheadItem + _self.properties.item_id).width(currentTimePercent + '%');
                    var offset_left = currentTimePercent - 0.7;
                    $('.' + _self.properties.timelineItem + _self.properties.item_id + ' .' + _self.properties.playheadBallItem + _self.properties.item_id).css('left', offset_left  + '%');

                    _self.objects.music.currentTime = (_self.objects.music.duration * currentTimePercent) / 100;
                });
                //************
        }

        this.playTestEvents = function () {
            if (_self.objects.is_playing) {
                _self.playTrack();
            }
        }

        this.playEndedEvents = function () {
            _self.pauseTrack();

            //repeat
            if (_self.properties.repeat == 'one') {
                _self.clearCurrentTrack();
                _self.playTrack();
            } else if (_self.properties.repeat == 'all') {
                _self.playNext();
            }
        }

        this.changePlay = function () {
            if (_self.objects.is_playing) {
                    _self.pauseTrack();
            } else {
                    _self.playTrack();
            }
        }

        this.pauseTrack = function () {
                _self.objects.music.pause();
                _self.objects.is_playing = 0;
                _self.changePlayIcons();
        }

        this.playTrack = function () {
                _self.objects.music.play();
                _self.objects.is_playing = 1;
                _self.changePlayIcons();
        }

        this.changePlayIcons = function () {
            var play_buttons = [_self.properties.playGalleryButtonId + _self.properties.item_id, _self.properties.playPopupButtonId + _self.properties.item_id, _self.properties.playWideButtonId];

            if (_self.objects.is_playing) {
                $.each(play_buttons, function (key,value) {
                    $(value).find('i').removeClass(_self.properties.playButtonIcon).addClass(_self.properties.pauseButtonIcon);
                });
            } else {
                $.each(play_buttons, function (key,value) {
                    $(value).find('i').removeClass(_self.properties.pauseButtonIcon).addClass(_self.properties.playButtonIcon);
                });
            }
        }

        this.playNext = function () {
            _self.clearCurrentTrack();

            var next_track = 0;
            if (_self.properties.nextTrack) {
                next_track = _self.properties.nextTrack;
            } else if (_self.properties.firstTrack && _self.properties.repeat == 'all') {
                next_track = _self.properties.firstTrack;
            }

            if (next_track) {
                _self.setTrack(next_track);
                _self.playTrack();
            }

        }

        this.playPrev = function () {
            _self.clearCurrentTrack();

            var prev_track = 0;
            if (_self.properties.prevTrack) {
                prev_track = _self.properties.prevTrack;
            } else if (_self.properties.lastTrack) {
                prev_track = _self.properties.lastTrack;
            }

            if (prev_track) {
                _self.setTrack(prev_track);
                _self.playTrack();
            }
        }

        this.clearCurrentTrack = function () {
            _self.pauseTrack();
            _self.objects.music.currentTime = 0;

            $('.' + _self.properties.playheadItem + _self.properties.item_id).width(0);
            $('.' + _self.properties.timelineItem + _self.properties.item_id + ' .' + _self.properties.playheadBallItem + _self.properties.item_id).css('left','0');

            $('#wall_events').find('.' + _self.properties.timelineItem + _self.properties.item_id).addClass('timeline-hide');
        }

        this.reloadTimeline = function () {
            _self.objects.timeline = document.getElementById('timeline_' + _self.properties.item_id);
            _self.objects.playhead = document.getElementById('playhead_' + _self.properties.item_id);
        }

        this.setCurrentAudio = function () {
            //temporary conditions
            if (_self.properties.themeType !== 'flatty') {
                $('#player_' + _self.properties.item_id).appendTo('.audio-wide-block');
            }

                $('#wall_events').find('.' + _self.properties.timelineItem + _self.properties.item_id).removeClass('timeline-hide');

                $('.duration-time').html('');
                _self.objects.music = document.getElementById('player_' + _self.properties.item_id).cloneNode(true);

                _self.properties.deleteUrl = _self.properties.siteUrl + 'media/delete_media/' + _self.properties.item_id;

            if (_self.objects.music.duration) {
                    $('#duration_' + _self.properties.item_id).html(_self.readableDuration(_self.objects.music.duration));
            } else {
                    _self.objects.music.addEventListener('error', function (e) {
                        alert('Audio decoding error');
                        location.reload();
                    });

                    _self.objects.music.addEventListener('loadedmetadata', function () {
                        _self.properties.duration = _self.objects.music.duration;
                        $('#duration_' + _self.properties.item_id).html(_self.readableDuration(_self.properties.duration));
                    });
            }
        }

        this.setWideBlock = function () {
            $('.' + _self.properties.wideBlockItem).find('.current-track').html(_self.objects.music);

            $('#timeline_wide').addClass(_self.properties.timelineItem + _self.properties.item_id);
            $('#playhead_wide').addClass(_self.properties.playheadItem + _self.properties.item_id);
            $('#duration_wide').addClass(_self.properties.durationItem + _self.properties.item_id);
            $('#playhead-ball').addClass(_self.properties.playheadBallItem + _self.properties.item_id);
            $('#audioname_wide').html($('.' + _self.properties.audionameItem + _self.properties.item_id + ':first').text());
            $('#remove_wide').attr("href",_self.properties.deleteUrl);
        }

        this.setPopupBlock = function (item_id) {

        }

        this.setTracks = function () {
                var ids = $('.audio-content').map(function (index, element) {
                        var id = $(element).data("id-media");
                    if (typeof id == 'number') {
                            return id;
                    }
                });

                var arr = ids.get();
                _self.properties.firstTrack = arr[0];
                _self.properties.lastTrack = arr[arr.length - 1];
                var i;
            for (i = 0;; i++) {
                if (arr[i] == _self.properties.item_id) {
                        _self.properties.nextTrack = arr[i + 1];
                        _self.properties.prevTrack = arr[i - 1];
                        break;
                }
            }
        }

        this.updateTimelines = function () {
            var playPercent = (_self.objects.music.currentTime * 100) / _self.objects.music.duration;

            $('.' + _self.properties.playheadItem + _self.properties.item_id).width(playPercent + '%');
            var offset_left = playPercent - 0.7;
            $('.' + _self.properties.timelineItem + _self.properties.item_id + ' .' + _self.properties.playheadBallItem + _self.properties.item_id).css('left', offset_left  + '%');
            $('.' + _self.properties.durationItem + _self.properties.item_id).html(_self.readableDuration(_self.objects.music.currentTime));
        }

        this.timeUpdateEvents = function () {
                _self.changePlayIcons();
                _self.updateTimelines();
        }

        this.volumeButton = function () {
            if (_self.objects.music.muted) {
                    $(".volume-track i").removeClass().addClass("fa fa-lg fa-volume-up");
                    _self.objects.music.muted = false;
            } else {
                    $(".volume-track i").removeClass().addClass("fa fa-lg fa-volume-off");
                    _self.objects.music.muted = true;
            }
        }

        this.readableDuration = function (seconds) {
                sec = Math.floor(seconds);
                min = Math.floor(sec / 60);
                min = min >= 10 ? min : '0' + min;
                sec = Math.floor(sec % 60);
                sec = sec >= 10 ? sec : '0' + sec;
                return min + ':' + sec;
        }

    _self.Init(optionArr);
}





if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.audio = audio;
}
