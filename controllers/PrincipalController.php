<?php
namespace Controllers;

use MVC\Router;

class PrincipalController {

    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }

        $mostrarLayout = true;

        $router->render('principal/index', [
            'titulo' => 'Dashboard',
            'nombre' => $_SESSION['nombre'],
            'mostrarLayout' => $mostrarLayout
        ]);
    }
}