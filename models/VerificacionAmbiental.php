<?php
namespace Model;

class VerficcaionAmbiental extends ActiveRecord {

    protected static $tabla = 'verificacion_ambiental';
    protected static $columnasDB = ['id','folio_amb','fecha_semestre_actual','subir_archivo_amb','id_unidad_ver'];

    public $id;
    public $folio_amb;
    public $fecha_semestre_actual;
    public $subir_archivo_amb;
    public $id_unidad_ver;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->folio_amb = $args ['folio_amb'] ?? '';
        $this->fecha_semestre_actual = $args ['fecha_semestre_actual'] ?? '';
        $this->subir_archivo_amb = $args ['subir_archivo_amb'] ?? '';
        $this->id_unidad_ver = $args ['id_unidad_ver'] ?? '';

    }

}