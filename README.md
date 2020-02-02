# PayPal based on Omnipay in Phalcon framework

I've made a test site. It uses Omnipay and PayPal.

I have a skeleton and it based on Phalcon framework. If you use Phalcon it'll be similar.

## How can I made it

To PayPal with Omnipay implementation I made these things:

### Install Omnipay and Paypal with composer

```json
"league/omnipay" : "v3.0.2",
"omnipay/paypal" : "v3.0.2"
```

### Create a service

You can find my PayPal service here
``app/libraries/Paypal.php``

```php
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

```

I've added PayPal service to Dependency injection

```php
/**
 * Setting up paypal (omnipay)
 */
$di->setShared('paypal', function () {
    $config = $this->getConfig();

    $paypal = new \Skeleton\Library\Paypal(
        $config->paypal->username,
        $config->paypal->password,
        $config->paypal->signature,
        $config->paypal->sandbox
    );

    return $paypal;
});
```

You can find it in ``app/config/services.php``.

### Config

As you see in the source code, I used some variables in config.

```php
    'paypal' => [
        'username'  => \getenv('PAYPAL_USERNAME'),
        'password'  => \getenv('PAYPAL_PASSWORD'),
        'signature' => \getenv('PAYPAL_SIGNATURE'),
        'sandbox'   => \getenv('PAYPAL_SANDBOX')
    ],
```

You can find the config here: `/app/config/config.php`

But I prefer .env. So you can find main settings in .env (.env.example)

```text
PAYPAL_USERNAME=ab-cd123456789_api1.business.example.com
PAYPAL_PASSWORD=ABCDEF567890WXYZ
PAYPAL_SIGNATURE=AbcdefghijkLMNOPQ.s6d7s6d7s6d7s6d7QWERTZUIO34567890ABCDE
PAYPAL_SANDBOX=1
``` 

### Controller

If you want to see how it works visit the PayPal controller.

The checkoutAction create and redirect the transaction.

You can find the router here:
``app/modules/config/router.php``

And you can find the PaypalController here:
``app/modules/frontend/controllers/PaypalController.php``

## PayPal settings

You need a Business account.

To create it visit https://paypal.com

When you have an account you have to generate an API credential.

1. Click on the "Tools/All Tools" in the top of the menu
2. Click "Integrate Paypal" on the left
3. Click open under the "API credentials"
4. Click "Manage API credentials" under the "NVP/SOAP API integration"
5. You need API username, API password and Signature

Don't forget! These credentials used by the live PayPal. If you want to test it in Paypal sandbox, you need a sandbox account.
When you try to use sandbox with these settings, PayPal says: "Security header is not valid".

To create sandbox credentials

1. Visit https://developer.paypal.com (and login of course)
2. Find your name on the top of the right and click "Dashboard"
3. Click "Accounts" under the SANDBOX on the left
4. You can create a Sandbox Account here
5. Choose an Account Name and click "View/Edit account" (last column)
6. Click the second tab (API Credentials)
7. You can find your sandbox credentials under "NVP/SOAP Sandbox API Credentials"
