<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\CajaController;
use Controllers\LoginController;
use Controllers\PolizaController;
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
// $router->get('/unidades/crear', [UnidadController::class, 'crear']);
// $router->post('/unidades/crear', [UnidadController::class, 'crear']);
// $router->get('/unidades/actualizar', [UnidadController::class, 'actualizar']);
// $router->post('/unidades/actualizar', [UnidadController::class, 'actualizar']);
// $router->post('/unidades/eliminar', [UnidadController::class, 'eliminar']);

//Crud Unidades

$router->get('/api/unidades', [UnidadController::class, 'index']);
$router->post('/api/unidad', [UnidadController::class, 'crear']);
$router->post('/api/unidad/actualizar', [UnidadController::class, 'crear']);
$router->post('/api/unidad/eliminar', [UnidadController::class, 'actualizar']);


//CRUD Cajas

$router->get('/cajas', [CajaController::class, 'index']);
$router->get('/cajas/crear', [CajaController::class, 'crear']);
$router->post('/cajas/crear', [CajaController::class, 'crear']);
$router->get('/cajas/actualizar', [CajaController::class, 'actualizar']);
$router->post('/cajas/actualizar', [CajaController::class, 'actualizar']);
$router->post('/cajas/eliminar', [CajaController::class, 'eliminar']);

//CRUD Pólizas

$router->get('/polizas', [PolizaController::class, 'index']);
$router->post('/polizas/seleccionar-tipo-poliza', [PolizaController::class, 'seleccionarTipoPoliza']);
$router->get('/polizas/crear-poliza-vehicular', [PolizaController::class, 'crearPolizaVehicular']);
$router->post('/polizas/crear-poliza-vehicular', [PolizaController::class, 'crearPolizaVehicular']);
$router->get('/polizas/crear-poliza-remolque', [PolizaController::class, 'crearPolizaRemolque']);

$router->get('/polizas/crear', [PolizaController::class, 'crear']);
$router->post('/polizas/crear', [PolizaController::class, 'crear']);
$router->get('/polizas/actualizar', [PolizaController::class, 'actualizar']);
$router->post('/polizas/actualizar', [PolizaController::class, 'actualizar']);
$router->post('/polizas/eliminar', [PolizaController::class, 'eliminar']);

$router->comprobarRutas();
