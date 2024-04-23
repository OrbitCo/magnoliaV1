<?php

use Phinx\Seed\AbstractSeed;

class ThemesMainSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {


        $data = [
            [
                "id" => 3,
                "theme" => "flatty",
                "theme_type" => "user",
                "scheme" => "default",
                "active" => 1,
                "theme_name" => "User area theme",
                "theme_description" => "Default user side template; PilotGroup",
                "setable" => 1,
                "logo_width" => 111,
                "logo_height" => 21,
                "logo_default" => "logo.png",
                "mini_logo_width" => 30,
                "mini_logo_height" => 30,
                "mini_logo_default" => "mini_logo.png",
                "mobile_logo_width" => 160,
                "mobile_logo_height" => 32,
                "mobile_logo_default" => "mobile_logo.png",
                "template_engine" => "twig"
            ],
            [
                "id" => 4,
                "theme" => "gentelella",
                "theme_type" => "admin",
                "scheme" => "default",
                "active" => 1,
                "theme_name" => "Admin area theme",
                "theme_description" => "Gentelella template; PilotGroup",
                "setable" => 1,
                "logo_width" => 150,
                "logo_height" => 28,
                "logo_default" => "logo.png",
                "mini_logo_width" => 29,
                "mini_logo_height" => 28,
                "mini_logo_default" => "mini_logo.png",
                "mobile_logo_width" => 160,
                "mobile_logo_height" => 32,
                "mobile_logo_default" => "mobile_logo.png",
                "template_engine" => "twig"
            ]
        ];

        $this->table(DB_PREFIX . 'themes')
            ->insert($data)
            ->saveData();
    }
}
