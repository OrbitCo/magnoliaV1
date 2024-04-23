<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

/**
 * Class GetTokenUserIdMigration
 *
 * @copyright   Copyright (c)
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
final class GetTokenUserIdMigration extends AbstractMigration
{
    public function change(): void
    {
        $exists = $this->hasTable(DB_PREFIX . 'tokens');
        if ($exists === true) {
            $table = $this->table(DB_PREFIX . 'tokens');
            $table->addColumn('user_id', 'integer')
                ->addIndex('user_id')
                ->save();
        }
    }
}
