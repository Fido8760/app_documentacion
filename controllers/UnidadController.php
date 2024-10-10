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
        $unidades = Unidad::all();

        //echo json_encode(['unidades' => $unidades]);
        $mostrarLayout = true;
        
        $router->render('unidades/index', [
            'titulo' => 'Inventario de Unidades',
            'unidades' => $unidades,
            'mostrarLayout' => $mostrarLayout
        ]);
    }

    public static function crear(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $alertas = [];
        $unidad = new Unidad;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()){
                header('Location: /');
            }

            $unidad->sincronizar($_POST);
            $alertas = $unidad->validar();

            if(empty($alertas)) {
                $resultado = $unidad->guardar();

                if($resultado) {
                    header('Location: /unidades?alert=success&action=create');
                }
            }
        }
        
        $router->render('unidades/crear-unidad', [
            'titulo' => 'Registrar Unidades',
            'mostrarLayout' => $mostrarLayout,
            'alertas' => $alertas,
            'unidad' => $unidad
        ]);
    }

    public static function actualizar(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $alertas = [];

        //validar id
        $id = validarORedireccionar('/unidades');
        //unidad a editar

        $unidad = Unidad::find($id);

        if(!$unidad) {
            header('Location:/unidades');
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()){
                header('Location: /');
            }

            $unidad->sincronizar($_POST);
            $alertas = $unidad->validar();

            if(empty($alertas)) {
                $resultado = $unidad->guardar();
                if($resultado) {
                    header('Location: /unidades?alert=success&action=update');
                }
            }
        }

        $router->render('unidades/actualizar-unidad', [
            'titulo' => 'Actualizar Datos de la Unidad',
            'alertas' => $alertas,
            'unidad' => $unidad,
            'mostrarLayout' => $mostrarLayout
        ]);
    }
    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()){
                header('Location: /');
            }
            $id = $_POST['id'];
            $unidad = Unidad::find($id);

            if(!isset($unidad)) {
                header('Location: /unidades');
            }

            $resultado = $unidad->eliminar();

            if($resultado) {
                header('Location: /unidades?alert=success&action=delete');
            }
        }
    }
}
