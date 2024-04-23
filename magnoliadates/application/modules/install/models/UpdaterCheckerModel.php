<?php

declare(strict_types=1);

namespace Pg\modules\install\models;

class UpdaterCheckerModel extends \Model
{
    /**
     * Check new product update
     *
     * @return void
     */
    public function cronCheckNewUpdate()
    {
        $order_key = $this->ci->pg_module->get_module_config('start', 'product_order_key');
        if (!empty($order_key)) {
            $update_data = (new UpdaterDownloaderModel())->getLastVersionUpdater();
            if (!empty($update_data)) {
                $this->ci->pg_module->set_module_config('start', 'is_new_update', 1);
            }
        }
    }


}
