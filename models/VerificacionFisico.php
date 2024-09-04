<?php
 
namespace Model;

class VerificacionFisico extends ActiveRecord {
    
    protected static $tabla = 'verif_fisico';
    protected static $columnasDB = ['id','folio_fis','subir_archivo_fisico','id_unidad','id_caja'];

    public $id;
    public $folio_fis;
    public $subir_archivo_fisico;
    public $id_unidad;
    public $id_caja;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->folio_fis = $args['folio_fis'] ?? '';
        $this->subir_archivo_fisico = $args['subir_archivo_fisico'] ?? '';
        $this->id_unidad = $args['id_unidad'] ?? '';
        $this->id_caja = $args['id_caja'] ?? '';
        
    }
}