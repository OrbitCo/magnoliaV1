<?php

declare(strict_types=1);

namespace Pg\modules\social_networking\models\widgets;

/**
 * Social networking google widgets model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class GoogleWidgetsModel extends \Model
{
    //TODO передалать, google plus больше не существует
    public $widget_types = [
        //'like',
    ];
    public $head_loaded = false;

    public function getHeader($service_data = [], $locale = '', $types = []): string
    {
        $header = '';
        $lang = $this->ci->pg_language->get_lang_by_id($this->ci->pg_language->current_lang_id);
        $lang_code = isset($lang['code']) ? $lang['code'] : false;
        if (in_array('like', $types) && $lang_code) {
            $header = '<script type="text/javascript">window.___gcfg = {lang: \'' . $lang_code . '\'};(function() { var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true; po.src = \'https://apis.google.com/js/plusone.js\'; var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s); })();</script>';
        }
        $this->head_loaded = $header ? true : false;

        return $header;
    }

    public function getLike(): string
    {
        return $this->head_loaded ? '<g:plusone></g:plusone>' : '';
    }
}
