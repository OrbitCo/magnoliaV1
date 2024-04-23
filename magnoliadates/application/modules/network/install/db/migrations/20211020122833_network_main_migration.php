<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

/**
 * Class NetworkMainMigration
 *
 * @copyright   Copyright (c)
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
final class NetworkMainMigration extends AbstractMigration
{
    public function up(): void
    {
        $file_content = file_get_contents(__DIR__ . '/../../structure_install.sql', true);
        $file_content = preg_replace("/\n+/", '', $file_content);
        $file_content = str_replace('MyISAM', 'InnoDB', $file_content);
        $file_content = str_replace('[prefix]', DB_PREFIX, $file_content);
        $this->query($file_content);
    }

    public function down(): void
    {
        $file_content = file_get_contents(__DIR__ . '/../../structure_deinstall.sql', true);
        $file_content = preg_replace("/\n+/", '', $file_content);
        $file_content = str_replace('[prefix]', DB_PREFIX, $file_content);
        $this->execute($file_content);
    }
}
