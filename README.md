# Paypal based on Omnipay in Phalcon framework

I've made a test site. It uses Omnipay and Paypal.

I have a skeleton and it based on Phalcon framework. If you use Phalcon it'll be similar.

## How can I made it

To Paypal with Omnipay implementation I made these things:

### Install Omnipay and Paypal with composer

```json
"league/omnipay" : "v3.0.2",
"omnipay/paypal" : "v3.0.2"
```

### Create a service

You can find my PayPal service here
``app/libraries/Paypal.php``

I've added Paypal service to Dependency injection

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

You can find the config here: `/app/config/config.php`

But I prefer .env. So you can find main settings in .env (.env.example) 

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
