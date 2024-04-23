<?php

declare(strict_types=1);

namespace Pg\modules\payments\models\systems\Omnipay;

use Omnipay\Omnipay;
use Omnipay\Common\GatewayInterface;
use Omnipay\Common\CreditCard;

/**
 * Class OmnipayGateway
 * @package Pg\modules\payments\models\systems\Omnipay
 *
 * @copyright   Copyright (c) 2000-2021
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class OmnipayGateway
{
    /**
     * @var GatewayInterface
     */
    protected $gateway;

    /**
     * OmnipayGateway constructor.
     * @param $gateway
     */
    public function __construct($gateway)
    {
        $this->gateway = Omnipay::create($gateway);
    }

    /**
     * @return GatewayInterface
     */
    public function getGateway(): GatewayInterface
    {
        return $this->gateway;
    }

    /**
     * @param array $card_input
     * @param array $val_transaction
     * @return mixed
     */
    public function sendPurchase(array $card_input, array $val_transaction)
    {
        $val_transaction['card'] = new CreditCard($card_input);

        $response = $this->gateway->purchase($val_transaction)->send();

        $return_response = [];
        if ($response->isSuccessful()) {
            $return_response['data'] = $response->getData();
        } elseif ($response->isRedirect()) {
            $return_response['redirect_data'] = $response->getRedirectData();
        } else {
            $return_response['errors'] = $response->getMessage();
        }

        return $return_response;
    }
}
