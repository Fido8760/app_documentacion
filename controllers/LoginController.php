<?php
namespace Controllers;

use Classes\Email;
use Model\Roles;
use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];
        $auth = new Usuario;
        $mostrarLayout = false;


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
                    $_SESSION['rol'] = $usuario->id_rol;
                    $_SESSION['login'] = true;
                    header('Location: /principal');
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();

        $router->render('auth/login2', [
            'alertas' => $alertas,
            'auth' => $auth,
            'mostrarLayout' => $mostrarLayout
        ]);
    }
    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
       
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

        $router->render('auth/olvide-password2', [
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
        $router->render('auth/recuperar-password2', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }
//----------------------------------------------------------------Administración y creación de usuarios-------------------------------------

    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $usuarios = Usuario::all();
        foreach($usuarios as $usuario) {
            $usuario->roles = Roles::find($usuario->id_rol);
        }



        $router->render('/usuarios/index', [
            'titulo' => 'Usuarios Registrados',
            'mostrarLayout' => $mostrarLayout,
            'usuarios' => $usuarios
        ]);
    }

    public static function crear(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $usuario = new Usuario;
        $alertas = [];
        $consulta = 'SELECT * FROM roles';
        $roles = Roles::SQL($consulta);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_auth()){
                header('Location: /');
            }

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
                    header('Location: /usuarios?alert=success&action=create');
                }
            }
        }
        
        $router->render('usuarios/crear-usuario', [
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Agregar Usuario',
            'usuario' => $usuario,
            'alertas' => $alertas,
            'roles' => $roles,
            'actualizando' => false
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()){
                header('Location: /');
            }

            $id = $_POST['id'];
            $usuario = Usuario::find($id);

            if(!isset($usuario)) {
                header('Location: /usuarios');
            }

            $resultado = $usuario->eliminar();
            if($resultado) {
                header('Location: /usuarios?alert=success&action=delete');

            }
        }
    }

}