<?php 

namespace Model;

class TarjetaCirculacion extends ActiveRecord {
    protected static $tabla = 'tajetas_circulacion';
    protected static $columnasDB = ['id','folio_tarjeta','permiso_sct','fecha_exped','subir_archivo_circulacion','id_unidad','id_caja',];

    public $id;
    public $folio_tarjeta;
    public $permiso_sct;
    public $fecha_exped;
    public $subir_archivo_circulacion;
    public $id_unidad;
    public $id_caja;
    public $caja;
    public $unidad;
    public $economico;
    public $placas;
    public $url_detalle;
    public $pdf_actual;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->folio_tarjeta = $args['folio_tarjeta'] ?? '';
        $this->permiso_sct = $args['permiso_sct'] ?? '';
        $this->subir_archivo_circulacion = $args['subir_archivo_circulacion'] ?? '';
        $this->id_unidad = $args['id_unidad'] ?? '';
        $this->id_caja = $args['id_caja'] ?? '';
    }

}