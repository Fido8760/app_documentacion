<?php 

namespace Model;

class TarjetaCirculacionCaja extends ActiveRecord {
    protected static $tabla = 'tajetas_circulacion';
    protected static $columnasDB = ['id','folio_tarjeta','permiso_sct','fecha_exped','subir_archivo_circulacion','id_caja'];

    public $id;
    public $folio_tarjeta;
    public $permiso_sct;
    public $fecha_exped;
    public $subir_archivo_circulacion;
    public $id_caja;
    public $caja;
    public $unidad;
    public $economico;
    public $placas;
    public $url_detalle;
    public $pdf_actual ;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->folio_tarjeta = $args['folio_tarjeta'] ?? '';
        $this->permiso_sct = $args['permiso_sct'] ?? '';
        $this->subir_archivo_circulacion = $args['subir_archivo_circulacion'] ?? '';
        $this->id_caja = $args['id_caja'] ?? '';
    }
    public function validar(){
        
        if(!$this->id_caja) {
            self::$alertas['error'][] = 'Debe seleccionar el numero de remolque';
        }
        if(!$this->folio_tarjeta) {
            self::$alertas['error'][] = 'Debe colocar el folio de la tarjeta de circulación';
        }
        if(!$this->permiso_sct) {
            self::$alertas['error'][] = 'Debe colocar el permiso sct';
        }
        if(!$this->fecha_exped) {
            self::$alertas['error'][] = 'Seleccione la fecha de expedición';
        }
        if(!$this->subir_archivo_circulacion) {
            self::$alertas['error'][] = 'Debe adjuntar el PDF de la tarjeta de circulación';
        }

        return self::$alertas;
    }

}