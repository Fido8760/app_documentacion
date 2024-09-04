<?php 

namespace Model;

class Acuses extends ActiveRecord {
    protected static $tabla = 'acuses';
    protected static $columnasDB = ['id','archivo_poliza_acuse','archivo_tarcirc_acuse','archivo_veriambiental_acuse','archivo_verifisico_acuse','id_unidad','id_caja'];

    public $id;
    public $archivo_poliza_acuse;
    public $archivo_tarcirc_acuse;
    public $archivo_veriambiental_acuse;
    public $archivo_verifisico_acuse;
    public $id_unidad;
    public $id_caja;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->archivo_poliza_acuse = $args['archivo_poliza_acuse'] ?? '';
        $this->archivo_tarcirc_acuse = $args['archivo_tarcirc_acuse'] ?? '';
        $this->archivo_veriambiental_acuse = $args['archivo_veriambiental_acuse'] ?? '';
        $this->archivo_verifisico_acuse = $args['archivo_verifisico_acuse'] ?? '';
        $this->id_unidad = $args['id_unidad'] ?? '';
        $this->id_caja = $args['id_caja'] ?? '';

    }

}

