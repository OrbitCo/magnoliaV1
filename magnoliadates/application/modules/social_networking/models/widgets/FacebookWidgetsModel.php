<?php

declare(strict_types=1);

namespace Pg\modules\social_networking\models\widgets;

/**
 * Social networking facebook widgets model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class FacebookWidgetsModel extends \Model
{
    public $widget_types = [
        'comments',
        'like',
        'share',
    ];
    public $url;
    public $head_loaded = false;

    public function __construct()
    {
        parent::__construct();

        $this->url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
        $this->url .= (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != '80') ? $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'] : $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    }

    public function getHeader($service_data = [], $locale = 'en_US', $types = [])
    {
        $header = '';
        $appid = isset($service_data['app_key']) ? $service_data['app_key'] : false;
        $header = $appid ? ('
            <meta property="fb:app_id" content="' . $appid . '"/>
            <div id="fb-root"></div>
            <script>window.fbAsyncInit = function() {
                FB.init({
                  appId            : ' . $appid . ',
                  autoLogAppEvents : true,
                  xfbml            : true,
                  version          : "v3.0"
                });
              };
          </script>
          <script>(function(d, s, id){
                 var js, fjs = d.getElementsByTagName(s)[0];
                 if (d.getElementById(id)) {return;}
                 js = d.createElement(s); js.id = id;
                 js.src = "https://connect.facebook.net/' . $locale . '/sdk.js";
                 fjs.parentNode.insertBefore(js, fjs);
               }(document, "script", "facebook-jssdk"));
           </script>'
            ) : '';
        $this->head_loaded = $header ? true : false;

        return $header;
    }

    public function getLike()
    {
        if ($this->head_loaded) {
            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
            $url .= (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != '80') ? $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'] : $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            return '<div class="fb-like" data-href="' . $url . '" data-layout="button_count" data-action="like" data-show-faces="true" data-font="segoe ui"  data-width="100" data-show-faces="true" data-send="false"></div>';
        } else {
            return '';
        }
    }

    public function getShare()
    {
        return $this->head_loaded ? '<div class="fb-share-button" data-href=' . $this->url . '" data-layout="button_count"></div>' : '';
    }

    public function getComments()
    {
        return $this->head_loaded ? '<div class="fb-comments" data-href="' . $this->url . '" data-num-posts="2" data-width="470"></div>' : '';
    }
}
