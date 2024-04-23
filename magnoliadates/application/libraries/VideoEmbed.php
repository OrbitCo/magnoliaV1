<?php

class VideoEmbed
{
    private $settings = [
        "youtube.com" => [
            "regexp" => [
                ['%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', [1 => 'video']],
                ['/width="([0-9]+)" height="([0-9]+)".*youtube\.com\/embed\/([a-z0-9_\-]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
                ['/width="([0-9]+)" height="([0-9]+)".*youtube\.com\/v\/([a-z0-9_\-]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
                ['/youtube\.com\/embed\/([a-z0-9_\-]+)/i', [1 => 'video']],
                ['/youtube\.com\/v\/([a-z0-9_\-]+)/i', [1 => 'video']],
            ],
            //"embed" => '<iframe width="[width]" height="[height]" src="//www.youtube.com/embed/[video]?wmode=transparent" frameborder="0" allowfullscreen></iframe>',
            "embed"   => '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="//www.youtube.com/embed/[video]?wmode=transparent"></iframe></div>',
            "replace" => ['width' => 560, 'height' => 315, 'video' => ''],
        ],

        "youtu.be" => [
            "regexp" => [
                ['%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', [1 => 'video']],
                ['/youtu\.be\/([a-z0-9_\-]+)/i', [1 => 'video']],
            ],
            //"embed" => '<iframe width="[width]" height="[height]" src="//www.youtube.com/embed/[video]?wmode=transparent" frameborder="0" allowfullscreen></iframe>',
            "embed"   => '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="//www.youtube.com/embed/[video]?wmode=transparent"></iframe></div>',
            "replace" => ['width' => 560, 'height' => 315, 'video' => ''],
        ],

        ///// yahoo.com
        "yimg.com" => [
            "regexp" => [
                ['/width="([0-9]+)" height="([0-9]+)".*yimg\.com\/nl\/vyc\/site\/.*vid=([0-9]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
                ['/yimg\.com\/nl\/vyc\/site\/.*vid=([0-9]+)/i', [1 => 'video']],
            ],
            //"embed" => '<iframe frameborder="0" width="[width]" height="[height]" src="//d.yimg.com/nl/vyc/site/player.html?wmode=transparent#vid=[video]"></iframe></div>',
            "embed"   => '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="//d.yimg.com/nl/vyc/site/player.html?wmode=transparent#vid=[video]"></iframe></div>',
            "replace" => ['width' => 576, 'height' => 324, 'video' => ''],
        ],

        ///// yahoo.com
        "veoh.com" => [
            "regexp" => [
                ['/width="([0-9]+)" height="([0-9]+)".*veoh\.com\/swf\/webplayer\/WebPlayer\.swf.*permalinkId=([a-z0-9]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
                ['/veoh\.com\/watch\/([a-z0-9]+)/i', [1 => 'video']],
            ],
            "embed"   => '<object width="[width]" height="[height]" id="veohFlashPlayer" name="veohFlashPlayer"><param name="movie" value="//www.veoh.com/swf/webplayer/WebPlayer.swf?version=AFrontend.5.7.0.1331&permalinkId=[video]&player=videodetailsembedded&videoAutoPlay=0&id=anonymous&wmode=transparent"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.veoh.com/swf/webplayer/WebPlayer.swf?version=AFrontend.5.7.0.1331&permalinkId=[video]&player=videodetailsembedded&videoAutoPlay=0&id=anonymous&wmode=transparent" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="[width]" height="[height]" id="veohFlashPlayerEmbed" name="veohFlashPlayerEmbed"></embed></object>',
            "replace" => ['width' => 576, 'height' => 324, 'video' => ''],
        ],
        ///// aol.com
        "aol.com" => [
            "regexp" => [
                ['/aol\.com\/video\/(.*\/)?([0-9]+)/i', [2 => 'video']],
            ],
            "embed"   => "<object width='[width]' height='[height]' id='FiveminPlayer' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000'><param name='allowfullscreen' value='true'/><param name='allowScriptAccess' value='always'/><param name='movie' value='//embed.5min.com/[video]/?wmode=transparent'/><param name='wmode' value='opaque' /><embed name='FiveminPlayer' src='//embed.5min.com/[video]/?wmode=transparent' type='application/x-shockwave-flash' width='[width]' height='[height]' allowfullscreen='true' allowScriptAccess='always' wmode='opaque'></embed></object>",
            "replace" => ['width' => 576, 'height' => 324, 'video' => ''],
        ],

        ///// aol.com
        "5min.com" => [
            "regexp" => [
                ["/width=(\"|')([0-9]+)(\"|') height=(\"|')([0-9]+)(\"|').*5min\.com\/([0-9]+)/i", [2 => 'width', 5 => 'height', 7 => 'video']],
                ['/5min\.com\/([0-9]+)/i', [1 => 'video']],
            ],
            "embed"   => "<object width='[width]' height='[height]' id='FiveminPlayer' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000'><param name='allowfullscreen' value='true'/><param name='allowScriptAccess' value='always'/><param name='movie' value='//embed.5min.com/[video]/?wmode=transparent'/><param name='wmode' value='opaque' /><embed name='FiveminPlayer' src='//embed.5min.com/[video]/?wmode=transparent' type='application/x-shockwave-flash' width='[width]' height='[height]' allowfullscreen='true' allowScriptAccess='always' wmode='opaque'></embed></object>",
            "replace" => ['width' => 576, 'height' => 324, 'video' => ''],
        ],

        ///// blip.tv
        "blip.tv" => [
            "regexp" => [
                ['/width="([0-9]+)" height="([0-9]+)".*blip\.tv\/.*\#([a-z0-9]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
                ['/blip\.com\/([0-9]+)/i', [1 => 'video']],
            ],
            "embed"   => '<iframe src="//blip.tv/play/[video].html?p=1&wmode=transparent" width="[width]" height="[height]" frameborder="0" allowfullscreen></iframe><embed type="application/x-shockwave-flash" src="//a.blip.tv/api.swf?wmode=transparent#[video]" style="display:none"></embed>',
            "replace" => ['width' => 550, 'height' => 443, 'video' => ''],
        ],

        ////// exposureroom.com
        "exposureroom.com" => [
            "regexp" => [
                ['/(id="xrP([a-z0-9]+)" )?width="([0-9]+)" height="([0-9]+)".*exposureroom\.com\/flash\/.*assetId=([a-z0-9]+).*size=([a-z]{2})/i', [2 => 'video', 3 => 'width', 4 => 'height', 5 => 'video', 6 => 'size']],
            ],
            "embed"   => '<object id="xrP[video]" width="[width]" height="[height]" type="application/x-shockwave-flash" data="//exposureroom.com/flash/XRVideoPlayer2.swf?domain=exposureroom.com/&amp;assetId=[video]&amp;size=[size]&amp;titleColor=%23ffffff&amp;wmode=transparent"><param name="movie" value="//exposureroom.com/flash/XRVideoPlayer2.swf?domain=exposureroom.com/&amp;assetId=[video]&amp;size=[size]&amp;titleColor=%23ffffff&amp;wmode=transparent" /><param name="allowNetworking" value="all" /><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="True" /><param name="wmode" value="opaque" /></object>',
            "replace" => ['width' => 480, 'height' => 270, 'video' => '', 'size' => 'sm'],
        ],

        //////pandora.tv
        "pandora.tv" => [
            "regexp" => [
                ['/width="([0-9]+)" height="([0-9]+)".*flvr\.pandora\.tv\/flv2pan\/flvmovie\.dll\/.*userid=([a-z0-9]+).*prgid=([0-9]+)/i', [1 => 'width', 2 => 'height', 3 => 'userid', 4 => 'video']],
                ['/pandora\.tv\/.*ch_userid=([a-z0-9]+)&prgid=([0-9]+)/i', [1 => 'userid', 2 => 'video']],
            ],
            "embed"   => '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="//download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="[width]" height="[height]" id="movie" align="middle"> <param name="quality" value="high" /> <param name="movie" value="//flvr.pandora.tv/flv2pan/flvmovie.dll/userid=[userid]&prgid=[video]&skin=1&wmode=transparent" /> <param name="allowScriptAccess" value="always" /> <param name="allowFullScreen" value="true" /> <param name="wmode" value="transparent" /> <embed src="//flvr.pandora.tv/flv2pan/flvmovie.dll/userid=[userid]&prgid=[video]&skin=1&wmode=transparent" type="application/x-shockwave-flash" wmode="transparent" allowScriptAccess="always" allowFullScreen="true" pluginspage="//www.macromedia.com/go/getflashplayer" width="[width]" height="[height]" /></embed> </object>',
            "replace" => ['width' => 500, 'height' => 402, 'video' => '', 'userid' => ''],
        ],

        //////vimeo.com
        "vimeo.com" => [
            "regexp" => [
                ['/vimeo\.com\/video\/([0-9]+).*width="([0-9]+)" height="([0-9]+)"/i', [1 => 'video', 2 => 'width', 3 => 'height']],
                ['/vimeo\.com\/([0-9]+)/i', [1 => 'video']],
            ],
            //"embed" => '<iframe src="//player.vimeo.com/video/[video]?title=0&amp;byline=0&amp;portrait=0&amp;wmode=transparent" width="[width]" height="[height]" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
            "embed"   => '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="//player.vimeo.com/video/[video]?title=0&amp;byline=0&amp;portrait=0&amp;wmode=transparent"></iframe></div>',
            "replace" => ['width' => 400, 'height' => 225, 'video' => ''],
        ],

        ///// zoomby.ru
        "zoomby.ru" => [
            "regexp" => [
                ['/width="([0-9]+)" height="([0-9]+)".*zoomby\.ru\/v\/([0-9]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
                ['/zoomby\.ru\/watch\/([0-9]+)/i', [1 => 'video']],
            ],
            "embed"   => '<object id="ZoombyPlayer" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="[width]" height="[height]"><param name="movie" value="//www.zoomby.ru/v/[video]?wmode=transparent" /><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="true" /><param name="bgcolor" value="#000000" /><param name="wmode" value="opaque" /><embed src="//www.zoomby.ru/v/[video]?wmode=transparent" quality="high" allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="[width]" height="[height]" type="application/x-shockwave-flash"></embed></object>',
            "replace" => ['width' => 640, 'height' => 360, 'video' => ''],
        ],

        ///// tvigle.ru
        "tvigle.ru" => [
            "regexp" => [
                ['/width="([0-9]+)" height="([0-9]+)".*tvigle\.ru\/resource\/rf\/swf\/([0-9a-z]{2})\/([0-9a-z]{2})\/([0-9a-z]{2})\/([0-9a-z]+)\.swf/i', [1 => 'width', 2 => 'height', 3 => 'p1', 4 => 'p2', 5 => 'p3', 6 => 'p4']],
            ],
            "embed"   => '<object id="v[p1][p2][p3][p4]" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="//download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="[width]" height="[height]" align="middle"><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="movie" value="//photo.tvigle.ru/resource/rf/swf/[p1]/[p2]/[p3]/[p4].swf"></param><embed src="//photo.tvigle.ru/resource/rf/swf/[p1]/[p2]/[p3]/[p4].swf" width="[width]" height="[height]"  allowfullscreen="true" allowscriptaccess="always" type="application/x-shockwave-flash" pluginspage="//www.macromedia.com/go/getflashplayer" /></object>',
            "replace" => ['width' => 720, 'height' => 405, 'p1' => '', 'p2' => '', 'p3' => '', 'p4' => ''],
        ],

        ///// rutube.ru
        "rutube.ru" => [
            "regexp" => [
                ['/width="([0-9]+)" height="([0-9]+)".*rutube\.ru\/([0-9a-z]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
            ],
            "embed"   => '<OBJECT width="[width]" height="[height]"><PARAM name="movie" value="//video.rutube.ru/[video]?wmode=transparent"></PARAM><PARAM name="wmode" value="window"></PARAM><PARAM name="allowFullScreen" value="true"></PARAM><EMBED src="//video.rutube.ru/[video]?wmode=transparent" type="application/x-shockwave-flash" wmode="window" width="[width]" height="[height]" allowFullScreen="true" ></EMBED></OBJECT>',
            "replace" => ['width' => 470, 'height' => 353, 'video' => ''],
        ],

        ///// kinostok.tv
        "kinostok.tv" => [
            "regexp" => [
                ['/kinostok\.tv\/v\/([0-9a-z]+).*width="([0-9]+)" height="([0-9]+)"/i', [2 => 'width', 3 => 'height', 1 => 'video']],
            ],
            "embed"   => '<embed src="//kinostok.tv/v/[video]?wmode=transparent" wmode="transparent" FlashVars="skin=skins/minimal" width="[width]" height="[height]" allowscriptaccess="always" allowfullscreen="true" pluginspage="//www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" /></embed>',
            "replace" => ['width' => 640, 'height' => 480, 'video' => ''],
        ],

        ///// smotri.com
        "smotri.com" => [
            "regexp" => [
                ['/id="smotriComVideoPlayer([0-9a-z_\.]*)".*width="([0-9]+)" height="([0-9]+).*smotri\.com\/player\.swf\?file=([0-9a-z]+)/i', [1 => "id", 2 => 'width', 3 => 'height', 4 => 'video']],
            ],
            "embed"   => '<object id="smotriComVideoPlayer[id]" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="[width]" height="[height]"><param name="movie" value="//pics.smotri.com/player.swf?file=[video]&wmode=transparent&bufferTime=3&autoStart=false&str_lang=rus&xmlsource=http%3A%2F%2Fpics.smotri.com%2Fcskins%2Fblue%2Fskin_color.xml&xmldatasource=http%3A%2F%2Fpics.smotri.com%2Fskin_ng.xml" /><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="true" /><param name="bgcolor" value="#ffffff" /><embed src="//pics.smotri.com/player.swf?file=[video]&wmode=transparent&bufferTime=3&autoStart=false&str_lang=rus&xmlsource=http%3A%2F%2Fpics.smotri.com%2Fcskins%2Fblue%2Fskin_color.xml&xmldatasource=http%3A%2F%2Fpics.smotri.com%2Fskin_ng.xml" quality="high" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"  width="[width]" height="[height]" type="application/x-shockwave-flash"></embed></object>',
            "replace" => ['width' => 640, 'height' => 480, 'video' => '', "id" => ''],
        ],

        ///// myvi.ru
        "myvi.ru" => [
            "regexp" => [
                ['/myvi\.ru\/ru\/flash\/player\/pre\/([0-9a-z\-_]+).*width="([0-9]+)" height="([0-9]+)/i', [1 => "video", 2 => 'width', 3 => 'height']],
            ],
            "embed"   => '<object style="width: [width]px; height: [height]px"><param name="allowFullScreen" value="true"/><param name="allowScriptAccess" value="always" /><param name="movie" value="//myvi.ru/ru/flash/player/pre/[video]?wmode=transparent" /><param name="flashVars" value="kgzp=replace" /><embed src="//myvi.ru/ru/flash/player/pre/[video]?wmode=transparent" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="[width]" height="[height]" flashVars="kgzp=replace"></object>',
            "replace" => ['width' => 640, 'height' => 390, 'video' => ''],
        ],

        //// dailymotion.com
        "dailymotion.com" => [
            "regexp" => [
                ['/width="([0-9]+)" height="([0-9]+)".*dailymotion\.com\/embed\/video\/([a-z_\-0-9]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
                ['/dailymotion\.com\/video\/([a-z_\-0-9]+)/i', [1 => 'video']],
            ],
            "embed"   => '<iframe frameborder="0" width="[width]" height="[height]" src="//www.dailymotion.com/embed/video/[video]?wmode=transparent"></iframe>',
            "replace" => ['width' => 480, 'height' => 270, 'video' => ''],
        ],

        //// metacafe.com
        "metacafe.com" => [
            "regexp" => [
                ['/metacafe\.com\/fplayer\/([0-9]+)\/([a-z0-9_\-]+)\.swf.*width="([0-9]+)" height="([0-9]+)"/i', [1 => 'video', 2 => 'gid', 3 => 'width', 4 => 'height']],
                ['/metacafe\.com\/watch\/([0-9]+)\/([a-z0-9_\-]+)/i', [1 => 'video', 2 => 'gid']],
            ],
            "embed"   => '<embed flashVars="playerVars=autoPlay=no" src="//www.metacafe.com/fplayer/[video]/[gid].swf?wmode=transparent" width="[width]" height="[height]" wmode="transparent" allowFullScreen="true" allowScriptAccess="always" name="Metacafe_[video]" pluginspage="//www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>',
            "replace" => ['width' => 440, 'height' => 248, 'video' => '', 'gid' => ''],
        ],

        //// myspace.com
        "myspace.com" => [
            "regexp" => [
                ['/width="([0-9]+)px" height="([0-9]+)px".*myspace\.com\/services\/media\/embed\.aspx\/m=([0-9]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
                ['/myspace\.com\/video\/.*\/([0-9]+)/i', [1 => 'video']],
            ],
            "embed"   => '<object width="[width]px" height="[height]px" ><param name="allowFullScreen" value="true"/><param name="wmode" value="transparent"/><param name="movie" value="//mediaservices.myspace.com/services/media/embed.aspx/m=[video]?wmode=transparent,t=1,mt=video"/><embed src="//mediaservices.myspace.com/services/media/embed.aspx/m=[video]?wmode=transparent,t=1,mt=video" width="[width]" height="[height]" allowFullScreen="true" type="application/x-shockwave-flash" wmode="transparent"></embed></object>',
            "replace" => ['width' => 425, 'height' => 360, 'video' => ''],
        ],

        //// liveleak.com
        "liveleak.com" => [
            "regexp" => [
                ['/width="([0-9]+)" height="([0-9]+)".*liveleak\.com\/e\/([a-z0-9_]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
                ['/liveleak\.com\/view\?i=([a-z0-9_]+)/i', [1 => 'video']],
            ],
            "embed"   => '<object width="[width]" height="[height]"><param name="movie" value="//www.liveleak.com/e/[video]?wmode=transparent"></param><param name="wmode" value="transparent"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.liveleak.com/e/[video]?wmode=transparent" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" width="[width]" height="[height]"></embed></object>',
            "replace" => ['width' => 450, 'height' => 370, 'video' => ''],
        ],

        //// vbox7.com
        "vbox7.com" => [
            "regexp" => [
                ['/width="([0-9]+)" height="([0-9]+)".*vbox7\.com\/player\/ext\.swf\?vid=([a-z0-9]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
                ['/vbox7\.com\/play:([a-z0-9]+)/i', [1 => 'video']],
            ],
            "embed"   => '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="//download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="[width]" height="[height]"><param name="movie" value="//i48.vbox7.com/player/ext.swf?vid=[video]&wmode=transparent"><param name="quality" value="high"><embed src="//i48.vbox7.com/player/ext.swf?vid=[video]&wmode=transparent" quality="high" pluginspage="//www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="[width]" height="[height]"></embed></object>',
            "replace" => ['width' => 450, 'height' => 403, 'video' => ''],
        ],
        // tour.getlookaround.com
        "tour.getlookaround.com" => [
            "regexp" => [
                ['/width="([0-9]+)" height="([0-9]+)".*tour\.getlookaround\.com\/([a-z0-9_\-]+)/i', [1 => 'width', 2 => 'height', 3 => 'video']],
            ],
            "embed"   => '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://tour.getlookaround.com/[video]"></iframe></div>',
            "replace" => ['width' => 560, 'height' => 315, 'video' => ''],
        ],
    ];

    private $services = [];

    public function __construct()
    {
        $this->services = array_keys($this->settings);
    }

    public function get_video_data($embed)
    {
        ///// смортим, чей может быть предположительно код
        $services = [];
        foreach ($this->services as $service) {
            if (strpos($embed, $service) !== false) {
                $services[] = $service;
            }
        }

        ///// Если пустой массив - то дальше искать бесполезно
        if (empty($services)) {
            return false;
        }

        ///// проверяем по регуляркам
        $video_data = [];
        foreach ($services as $service) {
            $settings = $this->settings[$service];
            foreach ($settings["regexp"] as $regexp_data) {
                $regexp = $regexp_data[0];
                $params = $regexp_data[1];
                if (preg_match($regexp, $embed, $matches)) {
                    foreach ($params as $pattern_num => $param) {
                        if (!empty($matches[$pattern_num])) {
                            $video_data[$param] = $matches[$pattern_num];
                        }
                    }
                    break;
                }
            }
            if (!empty($video_data)) {
                foreach ($settings["replace"] as $param => $default_value) {
                    if (!isset($video_data[$param]) || empty($video_data[$param])) {
                        $video_data[$param] = $default_value;
                    }
                }
                $video_data["service"] = $service;
                break;
            }
        }

        if (!empty($video_data)) {
            return $video_data;
        } else {
            return false;
        }
    }

    public function get_embed_code($video_data)
    {
        $service = $video_data["service"];
        if (!$service || !$this->settings[$service]) {
            return false;
        }

        $settings = $this->settings[$service];
        $return = $settings["embed"];
        foreach ($settings["replace"] as $param => $default) {
            $value = (!empty($video_data[$param])) ? $video_data[$param] : $default;
            $return = str_replace('[' . $param . ']', $value, $return);
        }

        return $return;
    }

    public function get_string_from_video_data($video_data)
    {
        return http_build_query($video_data);
    }

    public function get_video_data_from_string($str)
    {
        parse_str($str, $output);

        return $output;
    }

    public function get_services()
    {
        return $this->services;
    }

    public function replace_urls_to_embed_in_text($text, $prefix = '<br/>', $postfix = '<br/>')
    {
        $parse_result = $this->get_embed_from_urls_in_text($text);
        foreach ($parse_result['embeds'] as $key => $embed) {
            if ($embed) {
                $text = str_replace($parse_result['urls'][$key], $prefix . $embed . $postfix, $text);
            }
        }

        return $text;
    }

    public function get_embed_from_urls_in_text($text)
    {
        preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $text, $match);
        $embeds = [];
        $urls = $match[0];
        foreach ($urls as $key => $url) {
            $embed_data = $this->get_video_data($url);
            $embeds[$key] = $embed_data ? $this->get_embed_code($embed_data) : false;
        }

        return ['urls' => $urls, 'embeds' => $embeds];
    }
}
