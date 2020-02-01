<?php

defined('BASE_PATH') || define('BASE_PATH', \getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

/**
 * Composer
 */
require BASE_PATH . '/vendor/autoload.php';

/**
 * Environment variables
 */
$dotenv = new \Dotenv\Dotenv(BASE_PATH);
$dotenv->load();

return new \Phalcon\Config([
    'database' => [
        'adapter'  => 'Mysql',
        'host'     => \getenv('DATABASE_MASTER_HOST'),
        'username' => \getenv('DATABASE_MASTER_USER'),
        'password' => \getenv('DATABASE_MASTER_PASS'),
        'dbname'   => \getenv('DATABASE_MASTER_NAME'),
        'charset'  => 'utf8'
    ]
]);
