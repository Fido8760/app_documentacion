<?php
namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }


    public function comprobarRutas() {

        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET' ){
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        if($fn){
            //la url existe y hay una funcion asociada
            call_user_func($fn, $this);

        } else {
            echo "Error 404";
        }
    }

    public function render($view, $datos = []) {

        foreach($datos as $key => $value){
            $$key = $value;
        }
        ob_start();//Almacenamiento en memoria
        include __DIR__ . "/views/$view.php";

        $contenido =ob_get_clean(); //Limpia el buffer

        include __DIR__ . "/views/layout.php";
    }

}