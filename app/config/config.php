<?php

defined('ENVIRONMENT') || define('ENVIRONMENT', \getenv('ENVIRONMENT') ?: 'prod');

defined('BASE_PATH') || define('BASE_PATH', \getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

$version = file_get_contents(BASE_PATH . '/composer.json');
$version = json_decode($version, true);
$version = !empty($version['version']) ? $version['version'] : '';

$revision = '';

if (\getenv('ENVIRONMENT') == 'prod') {
    $revision = \exec('git rev-parse --short HEAD');
} else {
    $revision = '12345';
}


\define('VERSION', $version . (!empty($revision) ? '.' . $revision : ''));

return new \Phalcon\Config([
    'project' => \getenv('PROJECT'),

    'base_url' => \getenv('BASE_URL'),

    'version' => \getenv('PROJECT') . '.' . VERSION,

    'environment' => \getenv('ENVIRONMENT'),

    'database' => [
        'adapter'  => 'mysql',
        'master' => [
            'host'     => \getenv('DATABASE_MASTER_HOST'),
            'username' => \getenv('DATABASE_MASTER_USER'),
            'password' => \getenv('DATABASE_MASTER_PASS'),
            'dbname'   => \getenv('DATABASE_MASTER_NAME'),
            'charset'  => 'utf8'
        ],
        'slave' => [
            'host'     => \getenv('DATABASE_SLAVE_HOST'),
            'username' => \getenv('DATABASE_SLAVE_USER'),
            'password' => \getenv('DATABASE_SLAVE_PASS'),
            'dbname'   => \getenv('DATABASE_SLAVE_NAME'),
            'charset'  => 'utf8'
        ]
    ],

    'application' => [
        'modules'        => \explode(',', \getenv('MODULES')),
        'appDir'         => APP_PATH . '/',
        'viewsDir'       => [
            'common' => APP_PATH . '/common/views/',
        ],
        'modelsDir'      => APP_PATH . '/common/models/',
        'controllersDir' => APP_PATH . '/common/controllers/',
        'baseUri'        => '/'
    ],

    'redis' => [
        'host'      => \getenv('REDIS_HOST'),
        'port'      => \getenv('REDIS_PORT'),
        'lifetime'  => \getenv('REDIS_LIFETIME'),
        'keyPrefix' => '_skeleton'
    ],

    'paypal' => [
        'username'  => \getenv('PAYPAL_USERNAME'),
        'password'  => \getenv('PAYPAL_PASSWORD'),
        'signature' => \getenv('PAYPAL_SIGNATURE'),
        'sandbox'   => \getenv('PAYPAL_SANDBOX')
    ],

]);
