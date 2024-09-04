<?php 

namespace Model;

class Operador extends ActiveRecord {
    protected static $tabla = 'operadores';
    protected static $columnasDB = ['id','nombre','apellido_p','apellido_m','curp','rfc','nss','fe_ingreso','subir_archivo_licencia',
                                    'subir_archivo_apto','subir_archivo_ine_control','vigencia_lic','vigencia_apto','id_puesto'];

    public $id;
    public $nombre;
    public $apellido_p;
    public $apellido_m;
    public $curp;
    public $rfc;
    public $nss;
    public $fe_ingreso;
    public $subir_archivo_licencia;
    public $subir_archivo_apto;
    public $subir_archivo_ine_control;
    public $vigencia_lic;
    public $vigencia_apto;
    public $id_puesto;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido_p = $args['apellido_p'] ?? '';
        $this->apellido_m = $args['apellido_m'] ?? '';
        $this->curp = $args['curp'] ?? '';
        $this->rfc = $args['rfc'] ?? '';
        $this->nss = $args['nss'] ?? '';
        $this->fe_ingreso = $args['fe_ingreso'] ?? '';
        $this->subir_archivo_licencia = $args['subir_archivo_licencia'] ?? '';
        $this->subir_archivo_apto = $args['subir_archivo_apto'] ?? '';
        $this->subir_archivo_ine_control = $args['subir_archivo_ine_control'] ?? '';
        $this->vigencia_lic = $args['vigencia_lic'] ?? '';
        $this->vigencia_apto = $args['vigencia_apto'] ?? '';
        $this->id_puesto = $args['id_puesto'] ?? '';
    }
}