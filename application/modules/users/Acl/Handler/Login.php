<?php

declare(strict_types=1);

namespace Pg\modules\users\Acl\Handler;

use Pg\Libraries\Acl\Handler;

class Login extends Handler
{

    public function render()
    {
        $this->ci->view->setRedirect(site_url() . 'users/login_form');
    }
}
