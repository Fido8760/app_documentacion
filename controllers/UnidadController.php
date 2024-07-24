<?php

namespace Controllers;

use Model\Unidad;
use MVC\Router;

class UnidadController {
    public static function index(Router $router) {

        $unidades = Unidad::all();
        
        $router->render('unidades/unidades', [
            'unidades' => $unidades
        ]);
    }

    public static function crear(Router $router) {
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

        $router->render('unidades/crear',[
            'unidad' => $unidad,
            'alertas' => $alertas
        ]);
    }
    public static function actualizar(Router $router) {

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

        $router->render('unidades/actualizar', [
            'unidad' => $unidad,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {

         if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $unidad = Unidad::find($id);
            $unidad->eliminar();
            header('Location: /unidades');
        }
    }
}