<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\CajaController;
use Controllers\LoginController;
use Controllers\PrincipalController;
use Controllers\UnidadController;
use MVC\Router;

$router = new Router();

//Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Area principal (index)
$router->get('/principal', [PrincipalController::class,'index']);


// CRUD Usuarios
$router->get('/auth/usuarios',[LoginController::class, 'index']);
$router->get('/auth/crear-usuario',[LoginController::class, 'crear']);
$router->post('/auth/crear-usuario',[LoginController::class, 'crear']);
 
// Recuperar password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

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

//CRUD Pólizas

$router->get();

$router->comprobarRutas();
