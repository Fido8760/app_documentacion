<?php

namespace Model;

class Puestos extends ActiveRecord {

    protected static $tabla = 'puestos';
    protected static $columnasDB = ['id','puesto'];

    public $id;
    public $puesto;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->puesto = $args['puesto'] ?? '';
    }

}