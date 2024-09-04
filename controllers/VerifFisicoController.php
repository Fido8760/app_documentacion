<?php 

namespace Controllers;

use MVC\Router;

class VerifFisicoController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $router->render('verif-fisico/index', [
            'titulo' => 'Verificaciones Fisco Mecánicas',
            'mostrarLayout' => $mostrarLayout
        ]);
    } 
}