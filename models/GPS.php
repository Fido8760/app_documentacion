<?php 

namespace Model;

class GPS extends ActiveRecord {
    protected static $tabla = 'gps';
    protected static $gps = ['id','marca_gps','modelo','imei_gps','linea','apn', 'id_unidades'];
    
    public $id;
    public $marca_gps;
    public $modelo;
    public $imei_gps;
    public $linea;
    public $apn;
    public $id_unidades;

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
}