<?php
namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];
        $auth = new Usuario;
        $showNavbar = false;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                //comprobar existecia de usuario
                $usuario = Usuario::where('email', $auth->email);
                if($usuario->comprobarPassword($auth->password)) {
                    session_start();
                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;; 
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['login'] = true;
                    header('Location: /principal');
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth,
            'showNavbar' => $showNavbar
        ]);
    }
    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function olvide(Router $router) {
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                if($usuario){
                    //Generar Token de un solo uso
                    $usuario->crearToken();
                    $usuario->guardar();
                    //To Do: enviar el email
                    Usuario::setAlerta('exito', 'Correo enviado con éxito, revisa la bandeja de entrada de tu cuenta de correo' );
                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    
                    header("Refresh: 3; url=/");


                } else {
                    Usuario::setAlerta('error', 'Si el correo existe en nuestra base de datos, recibirás un mensaje para restablecer tu contraseña');
                    
                }
            }    
        }
        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-password', [
            'alertas' => $alertas

        ]);
    }

    public static function recuperar(Router $router) {
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        //buscar usuario por el token
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //LEER NUEVO PASS Y GUARDAR
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)) {
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar();
                if($resultado) {
                    header('Location: /');
                }
            }

        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function index(Router $router) {
        session_start();
        isAuth();
        $showNavbar = true;
        $usuarios = Usuario::all();

        $router->render('/auth/usuarios', [
            'usuarios' => $usuarios,
            'showNavbar' => $showNavbar
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAuth();
        $showNavbar = true;
        $usuario = new Usuario;
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarCrear();
            if(empty($alertas)) {
                //verificar si el correo existe
                $resultado = $usuario->esxisteUsuario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                } else {
                    //si no esta registrado, hasheamos el pass
                    $usuario->hashPassword();
                    $resultado = $usuario->guardar();
                    header('Location: /auth/usuarios');
                }
            }
        }
        
        $router->render('auth/crear-usuario', [
            'usuario' => $usuario,
            'alertas' => $alertas, 
            'showNavbar' => $showNavbar 
        ]);
    }
}