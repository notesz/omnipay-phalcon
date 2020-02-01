<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . '/config/config.php';
});

/**
 * Setting up master and slave database connection
 */
$di->setShared('dbMaster', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $connection = new $class([
        'host'     => $config->database->master->host,
        'username' => $config->database->master->username,
        'password' => $config->database->master->password,
        'dbname'   => $config->database->master->dbname,
        'charset'  => $config->database->master->charset
    ]);

    return $connection;
});
$di->setShared('dbSlave', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $connection = new $class([
        'host'     => $config->database->slave->host,
        'username' => $config->database->slave->username,
        'password' => $config->database->slave->password,
        'dbname'   => $config->database->slave->dbname,
        'charset'  => $config->database->slave->charset
    ]);

    return $connection;
});

/**
 * Setting up redis
 */
$di->setShared('redis', function() {
    $config = $this->getConfig();

    $redis = new \Phalcon\Cache\Backend\Redis(
        new \Phalcon\Cache\Frontend\Data(array(
            'lifetime' => $config->redis->lifetime
        )),
        array(
            'host'       => $config->redis->host,
            'port'       => $config->redis->port,
            'persistent' => false
        )
    );

    return $redis;
});

/**
 * Setting up cookies
 */
$di->set('cookies', function() {
    $cookies = new Phalcon\Http\Response\Cookies();

    $cookies->useEncryption(false);

    return $cookies;
});

/**
 * Setting up ImageResize
 */
$di->setShared('imageResize', function () {
    $config = $this->getConfig();

    $image = new \Innobotics\ImageResize();

    $image->setProgressive(true);
    $image->setSaveOriginal(true);

    foreach ($config->image->size as $type => $value) {
        $image->setType($type, $value['width'], $value['height']);
    }

    return $image;
});

/**
 * Setting up helper
 */
$di->setShared('helper', function () {
    $helper = new \Skeleton\Library\Helper();

    return $helper;
});

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
