<?php

namespace Controllers;

use Model\Unidad;
use MVC\Router;

class UnidadController {
    public static function index(Router $router) {
        session_start();
        isAuth();
        $alertas = [];
        $unidades = Unidad::all();

        

        //echo json_encode(['unidades' => $unidades]);
        $showNavbar = true;
        
        $router->render('unidades/unidades', [
            'unidades' => $unidades,
            'showNavbar' => $showNavbar,
            'alertas' => $alertas
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAuth();
        $showNavbar = true;
        $unidad = new Unidad;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $unidad->sincronizar($_POST);
            $alertas = $unidad->validar();

            if(empty($alertas)) {
                $unidad->guardar();
                header('Location: /unidades');
            }
        }

        $router->render('unidades/crear-unidad',[
            'unidad' => $unidad,
            'alertas' => $alertas,
            'showNavbar' => $showNavbar
        ]);
    }
    public static function actualizar(Router $router) {
        session_start();
        isAuth();
        $showNavbar = true;
        if(!is_numeric($_GET['id'])) return;
        $unidad = Unidad::find($_GET['id']);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $unidad->sincronizar($_POST);
            $alertas = $unidad->validar();
            if(empty($alertas)) {
                $unidad->guardar();
                header('Location: /unidades')
;            }
        }

        $router->render('unidades/actualizar-unidad', [
            'unidad' => $unidad,
            'alertas' => $alertas,
            'showNavbar' => $showNavbar
        ]);
    }

    public static function eliminar() {
        session_start();
        isAuth();
         if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $unidad = Unidad::find($id);
            $unidad->eliminar();
            header('Location: /unidades');
        }
    }
}