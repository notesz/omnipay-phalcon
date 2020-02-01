<?php

/**
 * Bootstrap for web.
 *
 * @copyright Copyright (c) 2020 innobotics (https://innobotics.eu)
 * @author Norbert Lakatos <norbert@innobotics.eu>
 */

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

ini_set('memory_limit', '512M');

error_reporting(E_ALL);

date_default_timezone_set('Europe/Budapest');

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * Composer
     */
    require BASE_PATH . '/vendor/autoload.php';

    /**
     * Environment variables
     */
    $dotenv = new Dotenv\Dotenv(BASE_PATH);
    $dotenv->load();

    /**
     * Initialize Prophiler
     */
    if (getenv('PROFILER') == 'enable') {
        $profiler = new \Fabfuel\Prophiler\Profiler();
    }

    /**
     * The FactoryDefault Dependency Injector automatically registers the services that
     * provide a full stack framework. These default services can be overidden with custom ones.
     */
    $di = new FactoryDefault();

    /**
     * Include general services
     */
    require APP_PATH . '/config/services.php';

    /**
     * Include web environment specific services
     */
    require APP_PATH . '/config/services_web.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Prophiler pluginmanager
     */
    if (getenv('PROFILER') == 'enable') {
        $pluginManager = new \Fabfuel\Prophiler\Plugin\Manager\Phalcon($profiler);
        $pluginManager->register();

        $profiler->addAggregator(new \Fabfuel\Prophiler\Aggregator\Database\QueryAggregator());
        $profiler->addAggregator(new \Fabfuel\Prophiler\Aggregator\Cache\CacheAggregator());
    }

    /**
     * Handle the request
     */
    $application = new Application($di);

    /**
     * Register application modules
     */
    foreach (explode(',', getenv('MODULES')) as $item) {
        $registerModules[$item] = ['className' => '\Skeleton\Modules\\' . \ucfirst($item) . '\Module'];
    }
    $application->registerModules($registerModules);

    echo $application->handle()->getContent();

    /**
     * Prophiler toolbar
     */
    if (getenv('PROFILER') == 'enable') {
        $toolbar = new \Fabfuel\Prophiler\Toolbar($profiler);
        $toolbar->addDataCollector(new \Fabfuel\Prophiler\DataCollector\Request());

        echo $toolbar->render();
        echo '<style>body { margin-top: 0 !important; margin-bottom: 35px !important; } #prophiler { top: inherit; bottom: 0;}</style>';
    }

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
//    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
