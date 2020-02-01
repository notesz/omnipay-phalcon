<?php

namespace Skeleton\Library;

/**
 * Paypal.
 *
 * @copyright Copyright (c) 2020 innobotics (https://innobotics.eu)
 * @author Norbert Lakatos <norbert@innobotics.eu>
 */
class Paypal
{
    const GATEWAY = 'PayPal_Express';

    private $username;
    private $password;
    private $signature;
    private $sandbox;

    /**
     * Paypal constructor.
     * @param $username
     * @param $password
     * @param $signature
     * @param $sandbox
     */
    public function __construct($username, $password, $signature, $sandbox = 0)
    {
        $this->username  = $username;
        $this->password  = $password;
        $this->signature = $signature;
        $this->sandbox   = ($sandbox == 1) ? true : false;
    }

    /**
     * @return \Omnipay\Common\GatewayInterface
     */
    public function gateway()
    {
        $gateway = \Omnipay\Omnipay::create(self::GATEWAY);

        $gateway->setUsername($this->username);
        $gateway->setPassword($this->password);
        $gateway->setSignature($this->signature);
        $gateway->setTestMode($this->sandbox);

        return $gateway;
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function purchase(array $parameters)
    {
        return $this->gateway()->purchase($parameters)->send();
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function complete(array $parameters)
    {
        return $this->gateway()->completePurchase($parameters)->send();
    }
}
