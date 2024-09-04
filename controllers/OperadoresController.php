<?php
namespace Controllers;

use MVC\Router;

class OperadoresController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $router->render('operadores/index',[
            'titulo' => 'Operadores',
            'mostrarLayout' => $mostrarLayout
        ]);
    }
}