<?php 

namespace Controllers;

use MVC\Router;

class TarjetaCirculacionController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $router->render('tarjeta-circulacion/index', [

            'titulo' => 'Tarjetas de Circulación',
            'mostrarLayout' => $mostrarLayout
        ]);
    }
}