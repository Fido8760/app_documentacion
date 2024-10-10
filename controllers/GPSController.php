<?php 
namespace Controllers;

use Model\GPS;
use Model\Unidad;
use MVC\Router;

class GPSController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $localizadores = GPS::all();
        
        foreach($localizadores as $localizador) {
            $localizador->unidades = Unidad::find($localizador->id_unidades);
        }

        $router->render('gps/index',[
            'titulo' => 'Inventarios de GPS',
            'mostrarLayout' => $mostrarLayout,
            'localizadores' => $localizadores
        ]);
    }

    public static function crear(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $alertas = [];
        $gps = new GPS;
        $consulta = 'SELECT u.id, u.no_unidad FROM unidades u LEFT JOIN gps g ON u.id = g.id_unidades WHERE g.id_unidades IS NULL';
        $unidades = Unidad::SQL($consulta);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()){
                header('Location: /');
            }

            $gps->sincronizar($_POST);
            $alertas = $gps->validar();

            if(empty($alertas)) {
                $resultado = $gps->guardar();

                if($resultado) {
                    header('Location: /gps?alert=success&action=create');
                }
            }
        }

        $router->render('gps/crear', [
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Agregar GPS a Unidad',
            'alertas' => $alertas,
            'gps' => $gps,
            'unidades' => $unidades,
            'actualizando' => false
        ]);
    }

    public static function actualizar(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /gps');
        }

        $gps = GPS::find($id);

        if(!$gps) {
            header('Location: /gps');
        }

        $gps->unidades = Unidad::find($gps->id_unidades);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gps->sincronizar($_POST);
            $alertas = $gps->validar();

            if(empty($alertas)) {
                $resultado = $gps->guardar();

                if($resultado) {
                    header('Location: /gps?alert=success&action=update');
                }
            }
        }

        $router->render('gps/actualizar', [
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Actualizar GPS de la Unidad',
            'alertas' => $alertas,
            'actualizando' => true,
            'gps' => $gps
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()){
                header('Location: /');
            }
            
            $id = $_POST['id'];
            $gps = GPS::find($id);

            if(!isset($gps)) {
                header('Location: /gps');
            }

            $resultado = $gps->eliminar();

            if($resultado) {
                header('Location: /gps?alert=success&action=delete');
            }
        }
    }
}