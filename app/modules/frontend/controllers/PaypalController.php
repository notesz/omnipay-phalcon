<?php

namespace Skeleton\Modules\Frontend\Controllers;

/**
 * PaypalController.
 *
 * @copyright Copyright (c) 2020 innobotics (https://innobotics.eu)
 * @author Norbert Lakatos <norbert@innobotics.eu>
 */
class PaypalController extends \Skeleton\Common\Controllers\ControllerBase
{
    /**
     * return void
     */
    public function initialize()
    {
        \Skeleton\Common\Controllers\ControllerBase::initialize();
    }

    /**
     * @param $orderId
     * @return bool
     */
    public function checkoutAction($orderId)
    {
        $order = [
            'id'     => $orderId,
            'amount' => 10,
        ];

        $paypal = $this->di->get('paypal')->purchase([
            'amount'        => number_format($order['amount'], 2, '.', ''),
            'transactionId' => $order['id'],
            'currency'      => 'HUF',
            'returnUrl'     => $this->di->get('config')->base_url . '/paypal/success',
            'cancelUrl'     => $this->di->get('config')->base_url . '/paypal/cancel',
        ]);

        if ($paypal->isRedirect()) {
            $paypal->redirect();

            return false;
        }

        $this->flash->error($paypal->getMessage());

        return $this->response->redirect(
            $this->url->get([
                'for' => 'frontend-index',
            ])
        );
    }

    public function successAction()
    {
        $this->flash->success('Your order has been success');

        return $this->response->redirect(
            $this->url->get([
                'for' => 'frontend-index',
            ])
        );
    }

    public function cancelAction()
    {
        $this->flash->error('Your transaction has been cancelled');

        return $this->response->redirect(
            $this->url->get([
                'for' => 'frontend-index',
            ])
        );
    }
}
