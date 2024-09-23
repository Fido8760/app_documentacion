<?php

namespace Controllers;

use Model\Caja;
use MVC\Router;

class CajaController {

    public static function info() {
        $cajas = Caja::all();
        echo json_encode($cajas);
    }


    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;

        $cajas = Caja::all();

        $router->render('cajas/index', [
            'titulo' => 'Inventario de Remolques',
            'cajas' => $cajas,
            'mostrarLayout' => $mostrarLayout
        ]);
    }

    public static function crear(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;

        $caja = new Caja;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_auth()){
                header('Location: /');
            }
            $caja->sincronizar($_POST);
            $alertas = $caja->validar();

            if(empty($alertas)) {
                $caja->guardar();
                header('Location:/cajas?alert=success&action=create');
            }
        }

        $router->render('cajas/crear-caja', [
            'titulo' => 'Agrear Remolque',
            'caja' => $caja,
            'alertas' => $alertas,
            'mostrarLayout' => $mostrarLayout
        ]);
    }

    public static function actualizar(Router $router){
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;

        if(!is_numeric($_GET['id'])) return;
        $caja = Caja::find($_GET['id']);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()){
                header('Location: /');
            }
            $caja->sincronizar($_POST);
            $alertas = $caja->validar();
            if(empty($alertas)) {
                $caja->guardar();
                header('Location: ?alert=success&action=update');
            }

        }

        $router->render('cajas/actualizar-caja', [
            'titulo' => 'Actulizar datos de Remolque',
            'caja' => $caja,
            'alertas' => $alertas,
            'mostrarLayout' => $mostrarLayout
        ]);

    }
    public static function eliminar(){
        if(!is_auth()){
            header('Location: /');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $caja = Caja::find($id);
            $caja->eliminar();
            header('Location: /cajas?alert=success&action=delete');
        }
    }
}

