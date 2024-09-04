<?php

namespace Controllers;

use MVC\Router;

class PuestoController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $router->render('puestos/index', [
            'titulo' => 'Puestos',
            'mostrarLayout' => $mostrarLayout
        ]);
    }
}