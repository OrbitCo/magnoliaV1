<?php

declare(strict_types=1);

namespace Pg\modules\social_networking\models\widgets;

/**
 * Social networking vkontakte widgets model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class VkontakteWidgetsModel extends \Model
{
    public $widget_types = [
        'comments',
        'like',
        'share',
    ];
    public $openapi = false;
    public $head_loaded = false;
    private $has_key = false;

    public function getHeader($service_data = [], $locale = '', $types = []): string
    {
        $header = '';
        $appid = isset($service_data['app_key']) ? $service_data['app_key'] : false;
        if ($appid) {
            $this->has_key = true;
        }
        $header .= '
        <script type="text/javascript">
            var vkontakte = [];
            var vkontakte_share = [];';
        if (!$this->openapi) {
            $header .= $appid ? ('
            var script = document.createElement("script");
            script.src = "https://vk.com/js/api/openapi.js?169"
            document.head.append(script);            
            script.onload = function() {
            VK.init({apiId: ' . $appid . ', onlyWidgets: true});
            for(var i in vkontakte){
                vkontakte[i]();
            }
            };') : '';
            $this->openapi = true;
        }

        $header .= '
        var script = document.createElement("script");
        script.src = "https://vk.com/js/api/share.js?11"
        document.head.append(script);            
        script.onload = function() {
          $(".vk_share").html(VK.Share.button(false,{type: "button"}));
        };</script>';
        $this->head_loaded = (bool) $header;

        return $header;
    }

    public function getLike(): string
    {
        return $this->head_loaded && $this->openapi ? '
    <div id="vk_like"></div>
    <script type="text/javascript">
        vkontakte.push(function(){
            VK.Widgets.Like("vk_like", {type: "button", verb: 1, height: 28});
        });
    </script>' : '';
    }

    public function getShare(): string
    {
        return $this->head_loaded ? '<div class="vk_share"></div>' : '';
    }

    public function getComments(): string
    {
        return $this->head_loaded && $this->openapi && $this->has_key ? '
    <div id="vk_comments"></div>
    <script type="text/javascript">
        window.onload = function () {
            VK.Widgets.Comments("vk_comments", {limit: 10, width: "496", attach: "*"});
        }
    </script>' : '';
    }
}
