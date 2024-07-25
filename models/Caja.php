<?php
namespace Model;

class Caja extends ActiveRecord {
    protected static $tabla = 'cajas';
    protected static $columnasDB = ['id','numero_caja','c_placas','c_serie',
                                        'capacidad','c_marca','c_anio'];

    public $id;
    public $numero_caja;
    public $c_placas;
    public $c_serie;
    public $capacidad;
    public $c_marca;
    public $c_anio;
    
    public function __construct($args = [])
    {
       $this->id = $args['id'] ?? null;
       $this->numero_caja = $args['numero_caja'] ?? '';
       $this->c_placas = $args['c_placas'] ?? '';
       $this->c_serie = $args['c_serie'] ?? '';
       $this->capacidad = $args['capacidad'] ?? '';
       $this->c_marca = $args['c_marca'] ?? '';
       $this->c_anio = $args['c_anio'] ?? '';

    }

    public function validar() {
        if(!$this->numero_caja) {
            self::$alertas['error'][] = 'Debe agregar el ECONOMICO DE CAJA';
        }
        if(!is_numeric($this->numero_caja)) {
            self::$alertas['error'][] = 'No se admiten letras u otros carácteres en el ECONOMICO DE UNIDAD';
        }
        if(!$this->c_placas) {
            self::$alertas['error'][] = 'Debe agregar la PLACA';
        }
        if(!$this->c_serie) {
            self::$alertas['error'][] = 'Debe agregar la SERIE';
        }
        if(!$this->capacidad) {
            self::$alertas['error'][] = 'Debe agregar la CAPACIDAD';
        }
        if(!$this->c_marca) {
            self::$alertas['error'][] = 'Debe agregar la MARCA';
        }
        if(!$this->c_anio) {
            self::$alertas['error'][] = 'Debe agregar el AÑO';
        }
        if(!is_numeric($this->c_anio)) {
            self::$alertas['error'][] = 'No se admiten letras u otros carácteres en el campo AÑO';
        }

            return self::$alertas;
    }
}