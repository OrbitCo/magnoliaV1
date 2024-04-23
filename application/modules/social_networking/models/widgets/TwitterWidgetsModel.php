<?php

declare(strict_types=1);

namespace Pg\modules\social_networking\models\widgets;

/**
 * Social networking twitter widgets model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class TwitterWidgetsModel extends \Model
{
    public $widget_types = [
        'share',
    ];

    public function getShare(): string
    {
        return <<<'EOD'
<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>
    !function(d,s,id){
        var js,
        fjs=d.getElementsByTagName(s)[0],
        p=/^http:/.test(d.location)?'http':'https';
        if(!d.getElementById(id)){
            js=d.createElement(s);
            js.id=id;
            js.src=p+'://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js,fjs);
        }
    }(document, 'script', 'twitter-wjs');
    if(!$('iframe.twitter-share-button').length && 'object' === typeof twttr) {
        $(function(){
            twttr.widgets.load();
        });
    }
</script>
EOD;
    }
}
