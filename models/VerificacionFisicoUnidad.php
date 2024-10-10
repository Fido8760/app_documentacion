<?php
 
namespace Model;

class VerificacionFisicoUnidad extends ActiveRecord {
    
    protected static $tabla = 'verif_fisico';
    protected static $columnasDB = ['id','folio_fis','fecha_verif_fis','subir_archivo_fisico','id_unidad'];

    public $id;
    public $folio_fis;
    public $fecha_verif_fis;
    public $subir_archivo_fisico;
    public $id_unidad;
    public $unidad;
    public $caja;
    public $placas;
    public $economico;
    public $pdf_actual;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->folio_fis = $args['folio_fis'] ?? '';
        $this->fecha_verif_fis = $args['fecha_verif_fis'] ?? '';
        $this->subir_archivo_fisico = $args['subir_archivo_fisico'] ?? '';
        $this->id_unidad = $args['id_unidad'] ?? '';
        
    }

    public function validar(){
        
        if(!$this->id_unidad) {
            self::$alertas['error'][] = 'Debe seleccionar el numero de unidad';
        }
        if(!$this->folio_fis) {
            self::$alertas['error'][] = 'Debe colocar el folio de la verificación';
        }
        if(!$this->fecha_verif_fis) {
            self::$alertas['error'][] = 'Debe seleccionar la fecha de verificación';
        }
        if(!$this->subir_archivo_fisico) {
            self::$alertas['error'][] = 'Debe adjuntar el archivo de verificación';
        }

        return self::$alertas;
    }
}