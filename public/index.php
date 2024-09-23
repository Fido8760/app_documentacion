<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\GPSController;
use Controllers\CajaController;
use Controllers\LoginController;
use Controllers\AcusesController;
use Controllers\PolizaController;
use Controllers\UnidadController;
use Controllers\PrincipalController;
use Controllers\OperadoresController;
use Controllers\PuestoController;
use Controllers\VerifFisicoController;
use Controllers\VerifAmbientalController;
use Controllers\TarjetaCirculacionController;

$router = new Router();

//Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->post('/logout', [LoginController::class, 'logout']);

//Area principal (index)
$router->get('/principal', [PrincipalController::class,'index']);


// CRUD Usuarios
$router->get('/usuarios',[LoginController::class, 'index']);
$router->get('/usuarios/crear-usuario',[LoginController::class, 'crear']);
$router->post('/usuarios/crear-usuario',[LoginController::class, 'crear']);
 
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
//API para mostrar datos
$router->get('/api/unidades/', [UnidadController::class, 'info']);

//CRUD Cajas

$router->get('/cajas', [CajaController::class, 'index']);
$router->get('/cajas/crear', [CajaController::class, 'crear']);
$router->post('/cajas/crear', [CajaController::class, 'crear']);
$router->get('/cajas/actualizar', [CajaController::class, 'actualizar']);
$router->post('/cajas/actualizar', [CajaController::class, 'actualizar']);
$router->post('/cajas/eliminar', [CajaController::class, 'eliminar']);
//API para mostrar datos completos de caja
$router->get('/api/cajas/', [CajaController::class, 'info']);

//-------------------CRUD Pólizas------------------------------
//unidades
$router->get('/polizas', [PolizaController::class, 'index']);
$router->get('/polizas/crear-poliza-unidad', [PolizaController::class, 'crearPolizaUnidad']);
$router->post('/polizas/crear-poliza-unidad', [PolizaController::class, 'crearPolizaUnidad']);
$router->get('/polizas/actualizar-poliza-unidad', [PolizaController::class, 'actualizarPolizaUnidad']);
$router->post('/polizas/actualizar-poliza-unidad', [PolizaController::class, 'actualizarPolizaUnidad']);
$router->post('/polizas/eliminar', [PolizaController::class, 'eliminar']);

//remolques
$router->get('/polizas/crear-poliza-remolque', [PolizaController::class, 'crearPolizaRemolque']);
$router->post('/polizas/crear-poliza-remolque', [PolizaController::class, 'crearPolizaRemolque']);
$router->get('/polizas/actualizar-poliza-remolque', [PolizaController::class, 'actualizarPolizaRemolque']);
$router->post('/polizas/actualizar-poliza-remolque', [PolizaController::class, 'actualizarPolizaRemolque']);
//API Polizas
$router->get('/api/polizas/', [PolizaController::class, 'info']);

//Verificaciones Ambientales

$router->get('/verif-ambiental',[VerifAmbientalController::class, 'index']);
$router->get('/verif-ambiental/crear',[VerifAmbientalController::class, 'crear']);
$router->post('/verif-ambiental/crear',[VerifAmbientalController::class, 'crear']);
$router->get('/verif-ambiental/actualizar',[VerifAmbientalController::class, 'actualizar']);
$router->post('/verif-ambiental/actualizar',[VerifAmbientalController::class, 'actualizar']);
$router->post('/verif-ambiental/eliminar',[VerifAmbientalController::class, 'eliminar']);

//Verificiaciones Fisico mecanicas

$router->get('/verif-fisico', [VerifFisicoController::class, 'index']);

//Tarjetas de circulación

$router->get('/tarjetas-circulacion', [TarjetaCirculacionController::class, 'index']);

//Acuses

$router->get('/acuses', [AcusesController::class, 'index']);

//Gps

$router->get('/gps', [GPSController::class, 'index']);

//Operadores

$router->get('/operadores', [OperadoresController::class, 'index']);

//puestos

$router->get('/puestos', [PuestoController::class, 'index']);




$router->comprobarRutas();
