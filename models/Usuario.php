<?php
namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios'; 
    protected static $columnasDB = ['nombre','password','email', 'token','apellido','id_rol'];

    public $id;
    public $nombre;
    public $password;
    public $email;
    public $token;
    public $apellido;
    public $id_rol;
    public $roles;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->token = $args['token'] ?? null;
        $this->apellido = $args['apellido'] ?? '';
        $this->id_rol = $args['id_rol'] ?? '';

    }
    //mensajes de validación para crear un usuario
    public function validarCrear(){
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        if(!$this->apellido) {
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }


        if(!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }

        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 carácteres';
        }
        
        return self::$alertas;
    }


    public function esxisteUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '". $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado->num_rows  ) {
            self::$alertas['alertas'][] = 'El usuario ya está registrado';
        }

        return $resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function validarLogin(){
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }

        return self::$alertas;
    }

    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        return self::$alertas;
    }

    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }

        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 carácteres';
        }

        return self::$alertas;
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function comprobarPassword($password){
        $resultado = password_verify($password, $this->password);
        if(!$resultado){
            self::$alertas['error'][] = 'Password Incorrecto';
        } else {
            return true;
        }
    }

}