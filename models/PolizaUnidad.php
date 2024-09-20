<?php
namespace Model;

use Model\ActiveRecord;

class PolizaUnidad extends ActiveRecord {
    public static $tabla = 'polizas';
    protected static $columnasDB = ['id','t_poliza','id_unidad','beneficiario','fe_inicio','fe_final',
                                    'endoso_pref','aseguradora','grupo','subgrupo','n_poliza','robo_total','danios_mat',
                                    'resp_civil','costo_poliza','subir_archivo'];

    public $id;
    public $t_poliza;
    public $id_unidad;
    public $beneficiario;
    public $fe_inicio;
    public $fe_final;
    public $endoso_pref;
    public $aseguradora;
    public $grupo;
    public $subgrupo;
    public $n_poliza;
    public $robo_total;
    public $danios_mat;
    public $resp_civil;
    public $costo_poliza;
    public $subir_archivo;
    public $unidad; 
    public $caja;
    public $economico;
    public $placas;
    public $tipo;
    public $pdf_actual;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->t_poliza = $args['t_poliza'] ?? '';
        $this->id_unidad = $args['id_unidad'] ?? '';
        $this->beneficiario = $args['beneficiario'] ?? '';
        $this->fe_inicio = $args['fe_inicio'] ?? '';
        $this->fe_final = $args['fe_final'] ?? '';
        $this->endoso_pref = $args['endoso_pref'] ?? '';
        $this->aseguradora = $args['aseguradora'] ?? '';
        $this->grupo = $args['grupo'] ?? '';
        $this->subgrupo = $args['subgrupo'] ?? '';
        $this->n_poliza = $args['n_poliza'] ?? '';
        $this->robo_total = $args['robo_total'] ?? '';
        $this->danios_mat = $args['danios_mat'] ?? '';
        $this->resp_civil = $args['resp_civil'] ?? '';
        $this->costo_poliza = $args['costo_poliza'] ?? '';
        $this->subir_archivo = $args['subir_archivo'] ?? '';
        $this->unidad = $args['unidad'] ?? '';
        $this->caja = $args['caja'] ?? '';
        $this->economico = $args['economico'] ?? '';
        $this->placas = $args['placas'] ?? '';
        $this->tipo = $args['tipo'] ?? '';


    }

    public function validar(){
        
        if(!$this->t_poliza) {
            self::$alertas['error'][] = 'Debe seleccionar el tipo de póliza';
        }
        if(!$this->id_unidad) {
            self::$alertas['error'][] = 'Debe colocar el número economico';
        }
        
        if(!$this->beneficiario) {
            self::$alertas['error'][] = 'Debe colocar el beneficiario';
        }
        if(!$this->fe_inicio) {
            self::$alertas['error'][] = 'Debe colocar la fecha de inicio de la póliza';
        }
        if(!$this->fe_final) {
            self::$alertas['error'][] = 'Debe colocar la fecha de la vigencia de la póliza';
        }
        if(!$this->endoso_pref) {
            self::$alertas['error'][] = 'Debe colocar el endoso preferencial';
        }
        if(!$this->aseguradora) {
            self::$alertas['error'][] = 'Debe colocar el nombre de la empresa aseguradora';
        }
        if(!$this->grupo) {
            self::$alertas['error'][] = 'Debe seleccionar un grupo';
        }
        if(!$this->subgrupo) {
            self::$alertas['error'][] = 'Debe seleccionar un subgrupo';
        }
        if(!$this->n_poliza) {
            self::$alertas['error'][] = 'Debe colocar el folio de la póliza';
        }
        if(!$this->robo_total) {
            self::$alertas['error'][] = 'Debe seleccionar el valor en el robo total';
        }
        if(!$this->danios_mat) {
            self::$alertas['error'][] = 'Debe seleccionar el valor en los daños materiales';
        }
        if(!$this->resp_civil) {
            self::$alertas['error'][] = 'Debe colocar el monto por el cual está cubierto';
        }
        if(!$this->costo_poliza) {
            self::$alertas['error'][] = 'Debe colocar el costo total de la póliza';
        }
        if(!$this->subir_archivo) {
            self::$alertas['error'][] = 'El archivo es obligatorio';
        }

        return self::$alertas;
    }

}
