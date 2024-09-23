<?php
namespace Model;

class VerficacionAmbiental extends ActiveRecord {

    protected static $tabla = 'verificacion_ambiental';
    protected static $columnasDB = ['id','folio_amb','fecha_semestre_actual','subir_archivo_amb','id_unidad_ver'];

    public $id;
    public $folio_amb;
    public $fecha_semestre_actual;
    public $subir_archivo_amb;
    public $id_unidad_ver;
    public $unidad;
    public $anterior;
    public $pdf_actual ;
    

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->folio_amb = $args ['folio_amb'] ?? '';
        $this->fecha_semestre_actual = $args ['fecha_semestre_actual'] ?? '';
        $this->subir_archivo_amb = $args ['subir_archivo_amb'] ?? '';
        $this->id_unidad_ver = $args ['id_unidad_ver'] ?? '';

    }

    public function validar()
    {
        if(!$this->id_unidad_ver) {
            self::$alertas['error'][] = 'Seleccione el el número de unidad';
        }

        if(!$this->folio_amb) {
            self::$alertas['error'][] = 'Debe colocar el folio de verficación ambiental';
        }
        
        if(!$this->fecha_semestre_actual) {
            self::$alertas['error'][] = 'Debe colocar la fecha de verificación';
        }
        
        if (!$this->subir_archivo_amb) {
            self::$alertas['error'][] = 'Debe subir el archivo de verificación';
        }

        return self::$alertas;
    }

}