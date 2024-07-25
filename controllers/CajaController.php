<?php

namespace Controllers;

use Model\Caja;
use MVC\Router;

class CajaController {
    public static function index(Router $router) {
        $cajas = Caja::all();

        $router->render('/cajas/cajas', [
            'cajas' => $cajas
        ]);
    }

    public static function crear(Router $router) {
        $caja = new Caja;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $caja->sincronizar($_POST);
            $alertas = $caja->validar();

            if(empty($alertas)) {
                $caja->guardar();
                header('Location:/cajas');
            }
        }

        $router->render('cajas/crear', [
            'caja' => $caja,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router){
        if(!is_numeric($_GET['id'])) return;
        $caja = Caja::find($_GET['id']);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $caja->sincronizar($_POST);
            $alertas = $caja->validar();
            if(empty($alertas)) {
                $caja->guardar();
                header('Location: /cajas');
            }

        }

        $router->render('cajas/actualizar', [
            'caja' => $caja,
            'alertas' => $alertas
        ]);

    }
    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $caja = Caja::find($id);
            $caja->eliminar();
            header('Location: /cajas');
        }
    }
}

