<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\CajaController;
use Controllers\UnidadController;
use MVC\Router;

$router = new Router();
//Crud Unidades
$router->get('/unidades', [UnidadController::class, 'index']);
$router->get('/unidades/crear', [UnidadController::class, 'crear']);
$router->post('/unidades/crear', [UnidadController::class, 'crear']);
$router->get('/unidades/actualizar', [UnidadController::class, 'actualizar']);
$router->post('/unidades/actualizar', [UnidadController::class, 'actualizar']);
$router->post('/unidades/eliminar', [UnidadController::class, 'eliminar']);

//CRUD Cajas

$router->get('/cajas', [CajaController::class, 'index']);
$router->get('/cajas/crear', [CajaController::class, 'crear']);
$router->post('/cajas/crear', [CajaController::class, 'crear']);
$router->get('/cajas/actualizar', [CajaController::class, 'actualizar']);
$router->post('/cajas/actualizar', [CajaController::class, 'actualizar']);
$router->post('/cajas/eliminar', [CajaController::class, 'eliminar']);

$router->comprobarRutas();
