<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/


require __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../app/Http/Routes.php';

$config['DB'] = require_once __DIR__ . '/../config/database.php';

$app = new \Ant\Application\Application($config);

$app->singleton(\Ant\Controller\IFrontController::class, \Ant\Controller\FrontController::class);

$app->singleton(\Ant\Http\IRequest::class, \Ant\Http\Request::class);

$front = $app->get(\Ant\Controller\IFrontController::class);

$front->run();