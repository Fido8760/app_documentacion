<?php

namespace Controllers;

use MVC\Router;

class AcusesController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $router->render('acuses/index', [
            'titulo' => 'Acuses de Entrega de Documentos',
            'mostrarLayout' => $mostrarLayout
        ]);
    }
}