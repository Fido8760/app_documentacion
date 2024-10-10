<?php 

namespace Model;

class Operador extends ActiveRecord {
    protected static $tabla = 'operadores';
    protected static $columnasDB = ['id','nombre','apellido_p','apellido_m','curp','rfc','nss','fe_ingreso',
                                    'subir_archivo_licencia', 'subir_archivo_apto','subir_archivo_ine',
                                    'vigencia_lic', 'subir_archivo_control','vigencia_apto','id_puesto'];

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
    public $subir_archivo_ine;
    public $subir_archivo_control;
    public $vigencia_lic;
    public $vigencia_apto;
    public $id_puesto;
    public $estatus_licencia;
    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido_p = $args['apellido_p'] ?? '';
        $this->apellido_m = $args['apellido_m'] ?? '';
        $this->curp = $args['curp'] ?? '';
        $this->rfc = $args['rfc'] ?? '';
        $this->nss = $args['nss'] ?? '';
        $this->fe_ingreso = $args['fe_ingreso'] ?? '';
        $this->subir_archivo_licencia = $args['subir_archivo_licencia'] ?? '';
        $this->subir_archivo_apto = $args['subir_archivo_apto'] ?? '';
        $this->subir_archivo_ine = $args['subir_archivo_ine'] ?? '';
        $this->subir_archivo_control = $args['subir_archivo_control'] ?? '';
        $this->vigencia_lic = $args['vigencia_lic'] ?? '';
        $this->vigencia_apto = $args['vigencia_apto'] ?? '';
        $this->id_puesto = $args['id_puesto'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'Coloque el Nombre del Operador';
        }

        if(!$this->apellido_p) {
            self::$alertas['error'][] = 'Coloque el Apellido Paterno del Operador';
        }
        
        if(!$this->apellido_m) {
            self::$alertas['error'][] = 'Coloque el Apellido Materno del Operador';
        }
        
        if (!$this->curp) {
            self::$alertas['error'][] = 'Escriba el CURP';
        }
        if (!$this->rfc) {
            self::$alertas['error'][] = 'Escriba el RFC';
        }
        if (!$this->nss) {
            self::$alertas['error'][] = 'Escriba el NSS';
        }
        if (!$this->fe_ingreso) {
            self::$alertas['error'][] = 'Seleccione la Fecha de ingreso';
        }

        if (!$this->vigencia_lic) {
            self::$alertas['error'][] = 'Seleccione la Fecha de Vigencia de la Licencia';
        }
        if (!$this->vigencia_apto) {
            self::$alertas['error'][] = 'Seleccione la Fecha de Vigencia del Apto Médico';
        }
        if (!$this->id_puesto) {
            self::$alertas['error'][] = 'Seleccione el puesto del Operador';
        }

        return self::$alertas;
    }
}