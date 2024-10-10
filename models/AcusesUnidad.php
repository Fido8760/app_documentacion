<?php 

namespace Model;

class AcusesUnidad extends ActiveRecord {
    protected static $tabla = 'acuses_unidades';
    protected static $columnasDB = ['id','archivo_poliza_acuse','archivo_tarcirc_acuse','archivo_veriambiental_acuse','archivo_verifisico_acuse','id_unidad'];

    public $id;
    public $archivo_poliza_acuse;
    public $archivo_tarcirc_acuse;
    public $archivo_veriambiental_acuse;
    public $archivo_verifisico_acuse;
    public $id_unidad;
    public $unidad;
    public $caja;
    public $economico;
    public $placas;
    public $url_detalle;
    public $pdf_actual_poliza;
    public $pdf_actual_tarjeta;
    public $pdf_actual_ambiental;
    public $pdf_actual_fisico;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->archivo_poliza_acuse = $args['archivo_poliza_acuse'] ?? '';
        $this->archivo_tarcirc_acuse = $args['archivo_tarcirc_acuse'] ?? '';
        $this->archivo_veriambiental_acuse = $args['archivo_veriambiental_acuse'] ?? '';
        $this->archivo_verifisico_acuse = $args['archivo_verifisico_acuse'] ?? '';
        $this->id_unidad = $args['id_unidad'] ?? '';

    }

}