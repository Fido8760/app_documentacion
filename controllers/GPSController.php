<?php 
namespace Controllers;

use MVC\Router;

class GPSController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $router->render('gps/index',[
            'titulo' => 'Inventarios de GPS',
            'mostrarLayout' => $mostrarLayout
        ]);
    }
}