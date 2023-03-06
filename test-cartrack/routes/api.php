<?php

use App\Services\Router;
use App\Controllers\Api\v1\CustomerController;

$router = new Router($request);
$router->get('/api/v1/customers', [CustomerController::class, 'index']);
$router->get('/api/v1/customers/find', [CustomerController::class, 'find']);
$router->post('/api/v1/customers', [CustomerController::class, 'create']);
$router->put('/api/v1/customers', [CustomerController::class, 'update']);
$router->delete('/api/v1/customers', [CustomerController::class, 'delete']);

$router->mount();

return $router;
