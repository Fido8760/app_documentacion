<?php

namespace Controllers;

use MVC\Router;

class VerifAmbientalController {
    
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $router->render('verif-ambiental/index', [
            'titulo' => 'Verificaciones Ambientales',
            'mostrarLayout' => $mostrarLayout
        ]);
    }
}