<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('clear_viewers_table')) {

    function clear_viewers_table()
    {
        if (INSTALL_DONE) {
            $ci = &get_instance();
            if (rand(1, 10) == 2) { //call viewers table clear method by chance 10% not to overload stuff
                $ci->load->model('users/models/Users_views_model');
                $ci->Users_views_model->deleteExpiredViewers();
            }
        }
        return;
    }

}
