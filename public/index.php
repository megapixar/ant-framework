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

$app = new \Ant\Application\Application();

$app->singleton(\Ant\Controller\IFrontController::class, \Ant\Controller\FrontController::class);

$front = $app->get(\Ant\Controller\IFrontController::class);

$front->run();