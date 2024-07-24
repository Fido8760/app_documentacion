<?php
namespace Model;

class Unidad extends ActiveRecord {

    protected static $tabla = 'unidades';
    protected static $columnasDB = ['id','no_unidad','tipo_unidad','u_placas','u_serie','u_marca','modelo','u_anio','no_motor'];

    public $id;
    public $no_unidad;
    public $tipo_unidad;
    public $u_placas;
    public $u_serie;
    public $u_marca;
    public $modelo;
    public $u_anio;
    public $no_motor;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->no_unidad = $args ['no_unidad'] ?? '';
        $this->tipo_unidad = $args ['tipo_unidad'] ?? '';
        $this->u_placas = $args ['u_placas'] ?? '';
        $this->u_serie = $args ['u_serie'] ?? '';
        $this->u_marca = $args ['u_marca'] ?? '';
        $this->modelo = $args ['modelo'] ?? '';
        $this->u_anio = $args ['u_anio'] ?? '';
        $this->no_motor = $args ['no_motor'] ?? '';
    }

    public function validar() {
        if(!$this->no_unidad){
            self::$alertas['error'][] = 'Debe agregar un NÚMERO DE UNIDAD';
        }
        if(!is_numeric($this->no_unidad)){
            self::$alertas['error'][] = 'No se admiten letras u otros carácteres en el campo NÚMERO DE UNIDAD';
        }
        if(!$this->tipo_unidad){
            self::$alertas['error'][] = 'Debe agregar un TIPO DE UNIDAD';
        }
        if(!$this->u_placas){
            self::$alertas['error'][] = 'Debe agregar las PLACAS DE LA UNIDAD';
        }
        if(!$this->u_serie){
            self::$alertas['error'][] = 'Debe agregar la SERIE VEHICULAR';
        }
        if(!$this->u_marca){
            self::$alertas['error'][] = 'Debe agregar la MARCA';
        }
        if(!$this->modelo){
            self::$alertas['error'][] = 'Debe agregar el MODELO';
        }
        if(!$this->u_anio){
            self::$alertas['error'][] = 'Debe agregar el AÑO';
        }
        if(!is_numeric($this->u_anio)){
            self::$alertas['error'][] = 'No se admiten letras u otros carácteres en el campo AÑO';
        }
        if(!$this->no_motor){
            self::$alertas['error'][] = 'Debe agregar el NÚMERO DE MOTOR';
        }
        return self::$alertas;
    }
}