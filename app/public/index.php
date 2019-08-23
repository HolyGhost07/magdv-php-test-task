<?php

use Slim\App;
use App\Routes;
use App\Providers\ConnectionProvider;
use Pimple\Container as PimpleContainer;
use App\Document\Providers\DocumentServicesProvider;
use App\Document\Providers\DocumentControllersProvider;

define('ROOT_PATH', dirname(__DIR__));

if (!file_exists($file = ROOT_PATH . '/vendor/autoload.php')) {
    throw new RuntimeException('Install dependencies to run this script.');
}

require_once $file;

date_default_timezone_set('Asia/Novosibirsk');

$app = new App();

/** @var PimpleContainer */
$container = $app->getContainer();
$container->register((new ConnectionProvider()))
    ->register((new DocumentServicesProvider()))
    ->register((new DocumentControllersProvider()));

Routes::register($app);

$app->run();
