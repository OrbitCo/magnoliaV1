<?php

declare(strict_types=1);

namespace Pg\modules\social_networking\models\widgets;

/**
 * Social networking linkdin widget model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class LinkedinWidgetsModel extends \Model
{
    public $widget_types = [
        'share',
    ];
    public $head_loaded = false;

    public function getHeader($service_data = [], $locale = '', $types = []): string
    {
        $header = '';
        if (in_array('share', $types)) {
            $header .= '<script src="//platform.linkedin.com/in.js"></script>';
        }
        $this->head_loaded = (bool) $header;

        return $header;
    }

    public function getShare(): string
    {
        if ($this->head_loaded) {
            return <<<'EOD'
<script type="IN/Share" data-counter="right"></script>
<script>
    if(!$('.IN-widget').length && 'object' === typeof IN && 'function' === typeof IN.parse) {
        $(function(){IN.parse();});
    }
</script>
EOD;
        } else {
            return '';
        }
    }
}
