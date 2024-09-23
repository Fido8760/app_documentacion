<?php
namespace Model;

class VerficacionAmbientalAnt extends ActiveRecord {

    protected static $tabla = 'verificacion_ambiental_ant';
    protected static $columnasDB = ['id','folio_verif_ant','fecha_verif_ant','id_actual'];

    public $id;
    public $folio_verif_ant;
    public $fecha_verif_ant;
    public $id_actual;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->folio_verif_ant = $args['folio_verif_ant'] ?? '';
        $this->fecha_verif_ant = $args['fecha_verif_ant'] ?? '';
        $this->id_actual = $args['id_actual'] ?? '';
    }

}