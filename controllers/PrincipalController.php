<?php
namespace Controllers;

use MVC\Router;

class PrincipalController {

    public static function index(Router $router) {
        session_start();
        isAuth();
        $showNavbar = true;

        $router->render('principal/index', [
            'nombre' => $_SESSION['nombre'],
            'showNavbar' => $showNavbar

        ]);
    }
}