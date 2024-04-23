<?php

declare(strict_types=1);

namespace Pg\modules\subscriptions\models;

if (!defined('SUBSCRIPTIONS_USERS_TABLE')) {
    define('SUBSCRIPTIONS_USERS_TABLE', DB_PREFIX . 'subscriptions_users');
}

/**
 * Subscriptions users model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class SubscriptionsUsersModel extends \Model
{
    private $attrs = ['id', 'id_user', 'id_subscription'];

    public function getUsersByIdSubscription($id_subscription, $page = null, $items_on_page = 1000)
    {
        $this->ci->load->model('Users_model');

        $this->ci->db->select('id_user, email, lang_id')->from(SUBSCRIPTIONS_USERS_TABLE);
        $this->ci->db->join(USERS_TABLE, USERS_TABLE . '.id = ' . SUBSCRIPTIONS_USERS_TABLE . '.    id_user');
        $this->ci->db->where('id_subscription', $id_subscription);
        if (!is_null($page)) {
            $page = $page ? (int)$page : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        return $this->ci->db->get()->result_array();
    }

    public function saveUserSubscriptions($id_user, $subscriptions)
    {
        $this->ci->db->where("id_user", $id_user);
        $this->ci->db->delete(SUBSCRIPTIONS_USERS_TABLE);
        if ($subscriptions) {
            foreach ($subscriptions as $key => $value) {
                $data['id_user'] = $id_user;
                $data['id_subscription'] = intval($value);
                $this->ci->db->insert(SUBSCRIPTIONS_USERS_TABLE, $data);
                $id = $this->ci->db->insert_id();
            }
        }
        $this->save_auto_subscriptions($id_user);
    }

    public function saveAutoSubscriptions($id_user)
    {
        $this->ci->load->model('Subscriptions_model');
        $auto_subscriptions = $this->ci->Subscriptions_model->get_subscriptions_list(null, null, null, ['where' => ['subscribe_type' => 'auto']]);
        if ($auto_subscriptions) {
            foreach ($auto_subscriptions as $key => $value) {
                $data['id_user'] = $id_user;
                $data['id_subscription'] = intval($value['id']);
                $this->ci->db->insert(SUBSCRIPTIONS_USERS_TABLE, $data);
            }
        }
    }

    public function getSubscriptionsByIdUser($id_user)
    {
        $return = [];
        $this->ci->db->select(implode(", ", $this->attrs))->from(SUBSCRIPTIONS_USERS_TABLE);
        $this->ci->db->where('id_user', $id_user);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $return[$r['id_subscription']] = 1;
            }
        }

        return $return;
    }

    public function getSubscriptionUsersCount($id_subscription)
    {
        $this->ci->load->model('Users_model');

        $this->ci->db->select('COUNT(*) AS cnt')->from(SUBSCRIPTIONS_USERS_TABLE);
        $this->ci->db->join(USERS_TABLE, USERS_TABLE . '.id = ' . SUBSCRIPTIONS_USERS_TABLE . '.id_user');
        $this->ci->db->where('id_subscription', $id_subscription);

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    public function __call($name, $args)
    {
        $methods = [
            'get_subscription_users_count' => 'getSubscriptionUsersCount',
            'get_subscriptions_by_id_user' => 'getSubscriptionsByIdUser',
            'get_users_by_id_subscription' => 'getUsersByIdSubscription',
            'save_auto_subscriptions' => 'saveAutoSubscriptions',
            'save_user_subscriptions' => 'saveUserSubscriptions',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
