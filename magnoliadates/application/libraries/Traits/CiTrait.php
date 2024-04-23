<?php

namespace Pg\Libraries\Traits;

/**
 * Class TestCase
 */
trait CiTrait
{
    protected $ci;

    public function ci()
    {
        if (empty($this->ci)) {
            $this->ci = get_instance();
        }

        return $this->ci;
    }
}
