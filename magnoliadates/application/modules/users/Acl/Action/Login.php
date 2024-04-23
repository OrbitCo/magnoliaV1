<?php

declare(strict_types=1);

namespace Pg\modules\users\Acl\Action;

use Pg\Libraries\Acl\Action;

class Login extends Action
{
    const GID = 'login';

    public function getGid()
    {
        return self::GID;
    }
}
