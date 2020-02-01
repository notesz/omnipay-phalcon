<?php

// index
$router->add('/', [
    'namespace'  => 'Skeleton\Modules\Frontend\Controllers',
    'module'     => 'frontend',
    'controller' => 'index',
    'action'     => 'index'
])->setName('frontend-index');

// paypal/checkout
$router->add('/paypal/checkout/{order}', [
    'namespace'  => 'Skeleton\Modules\Frontend\Controllers',
    'module'     => 'frontend',
    'controller' => 'paypal',
    'action'     => 'checkout'
])->setName('frontend-paypal-checkout');

// paypal/success
$router->add('/paypal/success', [
    'namespace'  => 'Skeleton\Modules\Frontend\Controllers',
    'module'     => 'frontend',
    'controller' => 'paypal',
    'action'     => 'success'
])->setName('frontend-paypal-success');

// paypal/cancel
$router->add('/paypal/cancel', [
    'namespace'  => 'Skeleton\Modules\Frontend\Controllers',
    'module'     => 'frontend',
    'controller' => 'paypal',
    'action'     => 'cancel'
])->setName('frontend-paypal-cancel');
