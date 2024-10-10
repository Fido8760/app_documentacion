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
$router->get('/usuarios/actualizar',[LoginController::class, 'actualizar']);
$router->post('/usuarios/actualizar',[LoginController::class, 'actualizar']);
$router->post('/usuarios/eliminar',[LoginController::class, 'eliminar']);
 
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

//remolques
$router->get('/polizas/crear-poliza-remolque', [PolizaController::class, 'crearPolizaRemolque']);
$router->post('/polizas/crear-poliza-remolque', [PolizaController::class, 'crearPolizaRemolque']);
$router->get('/polizas/actualizar-poliza-remolque', [PolizaController::class, 'actualizarPolizaRemolque']);
$router->post('/polizas/actualizar-poliza-remolque', [PolizaController::class, 'actualizarPolizaRemolque']);
$router->post('/polizas/eliminar', [PolizaController::class, 'eliminar']);

//API Polizas
$router->get('/api/polizas/', [PolizaController::class, 'info']);

//Verificaciones Ambientales

$router->get('/verif-ambiental',[VerifAmbientalController::class, 'index']);
$router->get('/verif-ambiental/crear',[VerifAmbientalController::class, 'crear']);
$router->post('/verif-ambiental/crear',[VerifAmbientalController::class, 'crear']);
$router->get('/verif-ambiental/actualizar',[VerifAmbientalController::class, 'actualizar']);
$router->post('/verif-ambiental/actualizar',[VerifAmbientalController::class, 'actualizar']);
$router->post('/verif-ambiental/eliminar',[VerifAmbientalController::class, 'eliminar']);

//------------------ CRUD Verificiaciones Fisico mecanicas ------------------------------

$router->get('/verif-fisico', [VerifFisicoController::class, 'index']);

//verificiacion fisico unidades
$router->get('/verif-fisico/crearUnidad', [VerifFisicoController::class, 'crearUnidad']);
$router->post('/verif-fisico/crearUnidad', [VerifFisicoController::class, 'crearUnidad']);
$router->get('/verif-fisico/actualizarUnidad', [VerifFisicoController::class, 'actualizarUnidad']);
$router->post('/verif-fisico/actualizarUnidad', [VerifFisicoController::class, 'actualizarUnidad']);
$router->post('/verif-fisico/eliminar', [VerifFisicoController::class, 'eliminar']);

//verificiacion fisico remolques
$router->get('/verif-fisico/crearCaja', [VerifFisicoController::class, 'crearCaja']);
$router->post('/verif-fisico/crearCaja', [VerifFisicoController::class, 'crearCaja']);
$router->get('/verif-fisico/actualizarCaja', [VerifFisicoController::class, 'actualizarCaja']);
$router->post('/verif-fisico/actualizarCaja', [VerifFisicoController::class, 'actualizarCaja']);


//------------------ CRUD Verificiaciones Tarjetas de Circulación ------------------------------

$router->get('/tarjetas-circulacion', [TarjetaCirculacionController::class, 'index']);
$router->get('/tarjetas-circulacion/crearUnidad', [TarjetaCirculacionController::class, 'crearUnidad']);
$router->post('/tarjetas-circulacion/crearUnidad', [TarjetaCirculacionController::class, 'crearUnidad']);
$router->get('/tarjetas-circulacion/actualizarUnidad', [TarjetaCirculacionController::class, 'actualizarUnidad']);
$router->post('/tarjetas-circulacion/actualizarUnidad', [TarjetaCirculacionController::class, 'actualizarUnidad']);

$router->get('/tarjetas-circulacion/crearCaja', [TarjetaCirculacionController::class, 'crearCaja']);
$router->post('/tarjetas-circulacion/crearCaja', [TarjetaCirculacionController::class, 'crearCaja']);
$router->get('/tarjetas-circulacion/actualizarCaja', [TarjetaCirculacionController::class, 'actualizarCaja']);
$router->post('/tarjetas-circulacion/actualizarCaja', [TarjetaCirculacionController::class, 'actualizarCaja']);

$router->post('/tarjetas-circulacion/eliminar', [TarjetaCirculacionController::class, 'eliminar']);

//Acuses

$router->get('/acuses', [AcusesController::class, 'index']);

$router->get('/acuses/crearUnidad', [AcusesController::class, 'crearUnidad']);
$router->post('/acuses/crearUnidad', [AcusesController::class, 'crearUnidad']);
$router->get('/acuses/actualizarUnidad', [AcusesController::class, 'actualizarUnidad']);
$router->post('/acuses/actualizarUnidad', [AcusesController::class, 'actualizarUnidad']);


$router->get('/acuses/crearCaja', [AcusesController::class, 'crearCaja']);
$router->post('/acuses/crearCaja', [AcusesController::class, 'crearCaja']);
$router->get('/acuses/actualizarCaja', [AcusesController::class, 'actualizarCaja']);
$router->post('/acuses/actualizarCaja', [AcusesController::class, 'actualizarCaja']);

$router->post('/acuses/eliminar', [AcusesController::class, 'eliminar']);

//Gps

$router->get('/gps', [GPSController::class, 'index']);
$router->get('/gps/crear', [GPSController::class, 'crear']);
$router->post('/gps/crear', [GPSController::class, 'crear']);
$router->get('/gps/actualizar', [GPSController::class, 'actualizar']);
$router->post('/gps/actualizar', [GPSController::class, 'actualizar']);
$router->post('/gps/eliminar', [GPSController::class, 'eliminar']);

//Operadores

$router->get('/operadores', [OperadoresController::class, 'index']);
$router->get('/operadores/crear', [OperadoresController::class, 'crear']);
$router->post('/operadores/crear', [OperadoresController::class, 'crear']);
$router->get('/operadores/actualizar', [OperadoresController::class, 'actualizar']);
$router->post('/operadores/actualizar', [OperadoresController::class, 'actualizar']);
$router->post('/operadores/eliminar', [OperadoresController::class, 'eliminar']);
$router->get('/api/operadores', [OperadoresController::class, 'info']);

//puestos

$router->get('/puestos', [PuestoController::class, 'index']);




$router->comprobarRutas();
