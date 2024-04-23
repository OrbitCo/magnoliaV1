<?php

declare(strict_types=1);

namespace Pg\modules\statistics\helpers {

    use Pg\modules\start\helpers as StartHelpers;

    /**
     * statistics helper
     *
     * @package PG_Dating
     * @subpackage application
     *
     * @category    helpers
     *
     * @copyright Pilot Group <http://www.pilotgroup.net/>
     **/
    if (!function_exists('visitsData')) {
        function visitsData()
        {
            $is_install = (new \Pg\modules\statistics\models\StatisticsModel())->getSystemEvents('visits');
            if (isset($is_install['visits']) && $is_install['visits'] == 1) {
                $visits = new \Pg\modules\statistics\models\systems\StatisticsVisitsModel();
                return $visits->formatVisitsData(
                    $visits->getVisitsData()
                );
            }
            return false;
        }
    }

    if (!function_exists('mainBlock')) {
        function mainBlock($params = [])
        {
            $ci = &get_instance();
            $ci->load->model('Statistics_model');

            $statistics = [];
            $users_stats = $ci->Statistics_model->getStatPoints('users', null, [
                'registered_total', 'registered_day_1', 'registered_day_2', 'registered_day_3',
                'registered_day_4', 'registered_day_5', 'registered_day_6',
                'registered_day_7', 'registered_day_8', 'registered_day_9', 'registered_day_10',
                'registered_day_11', 'registered_day_12', 'registered_day_13', 'registered_day_14']);
            if ($users_stats !== false) {
                $week_1 = $users_stats['registered_day_1'] + $users_stats['registered_day_2'] +
                          $users_stats['registered_day_3'] + $users_stats['registered_day_4'] +
                          $users_stats['registered_day_5'] + $users_stats['registered_day_6'] +
                          $users_stats['registered_day_7'];
                $week_2 = $users_stats['registered_day_8'] + $users_stats['registered_day_9'] +
                          $users_stats['registered_day_10'] + $users_stats['registered_day_11'] +
                          $users_stats['registered_day_12'] + $users_stats['registered_day_13'] +
                          $users_stats['registered_day_14'];

                $statistics['registered'] = [
                    'week_1' => $week_1,
                    'week_2' => $week_2,
                    'week_percent' => round(($week_2 > 0 ? ($week_1 - $week_2) / $week_2 : $week_1) * 100, 2),
                ];
            }

            $payments_stats = $ci->Statistics_model->getStatPoints('payments', null, [
                'amount_total', 'amount_day_1', 'amount_day_2', 'amount_day_3',
                'amount_day_4', 'amount_day_5', 'amount_day_6', 'amount_day_7',
                'amount_day_8', 'amount_day_9', 'amount_day_10', 'amount_day_11',
                'amount_day_12', 'amount_day_13', 'amount_day_14', 'transactions_day_1',
                'transactions_day_2', 'transactions_day_3', 'transactions_day_4',
                'transactions_day_5', 'transactions_day_6', 'transactions_day_7',
                'transactions_day_8', 'transactions_day_9', 'transactions_day_10',
                'transactions_day_11', 'transactions_day_12', 'transactions_day_13',
                'transactions_day_14']);
            if ($payments_stats !== false) {
                $amount_week_1 = $payments_stats['amount_day_1'] + $payments_stats['amount_day_2'] +
                                 $payments_stats['amount_day_3'] + $payments_stats['amount_day_4'] +
                                 $payments_stats['amount_day_5'] + $payments_stats['amount_day_6'] +
                                 $payments_stats['amount_day_7'];
                $amount_week_2 = $payments_stats['amount_day_8'] + $payments_stats['amount_day_9'] +
                                 $payments_stats['amount_day_10'] + $payments_stats['amount_day_11'] +
                                 $payments_stats['amount_day_12'] + $payments_stats['amount_day_13'] +
                                 $payments_stats['amount_day_14'];

                $ci->view->assign('payment_total', StartHelpers\currencyFormatOutput(['value' => $payments_stats['amount_total'] ?: 0]));

                $statistics['payments'] = [
                    'week_1' => StartHelpers\currencyFormatOutput(['value' => $amount_week_1]),
                    'week_2' => StartHelpers\currencyFormatOutput(['value' => $amount_week_2]),
                    'week_percent' => round(($amount_week_2 > 0 ? ($amount_week_1 - $amount_week_2) / $amount_week_2 : $amount_week_1) * 100, 2),
                ];

                $transactions_week_1 =
                    $payments_stats['transactions_day_1'] + $payments_stats['transactions_day_2'] +
                    $payments_stats['transactions_day_3'] + $payments_stats['transactions_day_4'] +
                    $payments_stats['transactions_day_5'] + $payments_stats['transactions_day_6'] +
                    $payments_stats['transactions_day_7'];
                $transactions_week_2 =
                    $payments_stats['transactions_day_8'] + $payments_stats['transactions_day_9'] +
                    $payments_stats['transactions_day_10'] + $payments_stats['transactions_day_11'] +
                    $payments_stats['transactions_day_12'] + $payments_stats['transactions_day_13'] +
                    $payments_stats['transactions_day_14'];
                $payment_avg_1 = $transactions_week_1 > 0 ? $amount_week_1 / $transactions_week_1 : 0;
                $payment_avg_2 = $transactions_week_2 > 0 ? $amount_week_2 / $transactions_week_2 : 0;

                $statistics['payments_avg'] = [
                    'week_1' => StartHelpers\currencyFormatOutput(['value' => $payment_avg_1]),
                    'week_2' => StartHelpers\currencyFormatOutput(['value' => $payment_avg_2]),
                    'week_percent' => round(($payment_avg_2 > 0 ? ($payment_avg_1 - $payment_avg_2) / $payment_avg_2 : $payment_avg_1) * 100, 2),
                ];
            }
            $col = isset($params['col']) ? $params['col'] : null;

            $ci->view->assign('TRIAL_MODE', TRIAL_MODE);
            $ci->view->assign('col_sm', $col);
            $ci->view->assign('statistics', $statistics);

            return $ci->view->fetch('helper_main_block', 'admin', 'statistics');
        }
    }
}
