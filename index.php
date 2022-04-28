<?php

use App\Application;
use App\Config;
use App\Controllers\ProductController;
use App\Exceptions\NotFoundException;
use App\Router;
use Dotenv\Dotenv;

require_once(__DIR__ . '/vendor/autoload.php');

$dotenv = Dotenv::createImmutable(__DIR__ . '\src');
$dotenv->safeLoad();
const VIEW_PATH = __DIR__ . '/src/views';

$router = new Router();

$router->get('/phpTest/', [ProductController::class, 'index']);
$router->get('/phpTest/create', [ProductController::class, 'create']);
$router->post('/phpTest/create', [ProductController::class, 'store']);
$router->get('/phpTest/cancel', [ProductController::class, 'cancel']);
$router->post('/phpTest/delete', [ProductController::class, 'delete']);

try {
    (new Application(
        $router,
        ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
        new Config($_ENV)
    ))->run();
} catch (NotFoundException $e) {
    throw new $e->getMessage();
} catch (ReflectionException $e) {
    throw new NotFoundException();
}
