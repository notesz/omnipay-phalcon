<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Skeleton\Common\Models' => APP_PATH . '/common/models/',
    'Skeleton\Traits'        => APP_PATH . '/common/traits/',
    'Skeleton\Library'       => APP_PATH . '/libraries/',
]);

/**
 * Register module classes
 */
$registerClasses['Skeleton\Modules\Cli\Module'] = APP_PATH . '/modules/cli/Module.php';
foreach (explode(',', getenv('MODULES')) as $item) {
    $registerClasses['Skeleton\Modules\\' . \ucfirst($item) . '\Module'] = APP_PATH . '/modules/' . $item . '/Module.php';
}
$loader->registerClasses($registerClasses);

$loader->register();
