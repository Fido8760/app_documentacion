<?php

namespace Controllers;

use Model\Unidad;
use MVC\Router;

class UnidadController {

    public static function info() {
        $unidades = Unidad::all();
        echo json_encode($unidades);
    }

    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $alertas = [];
        $unidades = Unidad::all();

        //echo json_encode(['unidades' => $unidades]);
        $mostrarLayout = true;
        
        $router->render('unidades/index', [
            'titulo' => 'Inventario de Unidades',
            'unidades' => $unidades,
            'mostrarLayout' => $mostrarLayout,
            'alertas' => $alertas
        ]);
    }

    public static function crear(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $showNavbar = true;
        $unidad = new Unidad;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()){
                header('Location: /');
            }
            $unidad->sincronizar($_POST);
            $alertas = $unidad->validar();

            if(empty($alertas)) {
                $unidad->guardar();
                header('Location: /unidades');
            }
        }

        $router->render('unidades/crear-unidad',[
            'titulo' => 'Agregar Unidad',
            'unidad' => $unidad,
            'alertas' => $alertas,
            'showNavbar' => $showNavbar
        ]);
    }
    public static function actualizar(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $showNavbar = true;
        if(!is_numeric($_GET['id'])) return;
        $unidad = Unidad::find($_GET['id']);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()){
                header('Location: /');
            }
            $unidad->sincronizar($_POST);
            $alertas = $unidad->validar();
            if(empty($alertas)) {
                $unidad->guardar();
                header('Location: /unidades')
;            }
        }

        $router->render('unidades/actualizar-unidad', [
            'tiulo' => 'Actualizar Datos de la Unidad',
            'unidad' => $unidad,
            'alertas' => $alertas,
            'showNavbar' => $showNavbar
        ]);
    }

    public static function eliminar() {
        if(!is_auth()){
            header('Location: /');
        }
         if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $unidad = Unidad::find($id);
            $unidad->eliminar();
            header('Location: /unidades');
        }
    }
}