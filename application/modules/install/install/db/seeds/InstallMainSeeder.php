<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class InstallMainSeeder extends AbstractSeed
{
    public function run()
    {
        $date = date('Y-m-d H:i:s');
        $data = [
            [
                'model' => 'pg_theme',
                'method_add' => 'lang_dedicate_module_callback_add',
                'method_delete' => 'lang_dedicate_module_callback_delete',
                'date_created' => $date
            ], [
                'model' => 'pg_seo',
                'method_add' => 'lang_dedicate_module_callback_add',
                'method_delete' => 'lang_dedicate_module_callback_delete',
                'date_created' => $date
            ]
        ];

        $this->table(DB_PREFIX . 'lang_dedicate_modules')
            ->insert($data)
            ->saveData();
    }
}
