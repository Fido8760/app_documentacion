<?php 

namespace Model;

class GPS extends ActiveRecord {
    protected static $tabla = 'gps';
    protected static $columnasDB = ['id','marca_gps','modelo','imei_gps','linea','apn', 'id_unidades'];
    
    public $id;
    public $marca_gps;
    public $modelo;
    public $imei_gps;
    public $linea;
    public $apn;
    public $id_unidades;
    public $unidades;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->marca_gps = $args['marca_gps'] ?? '';
        $this->modelo = $args['modelo'] ?? '';
        $this->imei_gps = $args['imei_gps'] ?? '';
        $this->linea = $args['linea'] ?? '';
        $this->apn = $args['apn'] ?? '';
        $this->id_unidades = $args['id_unidades'] ?? '';
        
    }

    public function validar()
    {
        if(!$this->id_unidades) {
            self::$alertas['error'][] = 'Seleccione el el número de unidad';
        }

        if(!$this->marca_gps) {
            self::$alertas['error'][] = 'Colque la marca del GPS';
        }
        
        if(!$this->modelo) {
            self::$alertas['error'][] = 'Coloque el modelo del gps';
        }
        
        if (!$this->imei_gps) {
            self::$alertas['error'][] = 'falta colocar el imei';
        }
        if (!$this->linea) {
            self::$alertas['error'][] = 'falta colocar el numero teléfonico';
        }
        if (!$this->apn) {
            self::$alertas['error'][] = 'coloque el apn';
        }

        return self::$alertas;
    }
}