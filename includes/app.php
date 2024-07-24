<?php

require 'funciones.php';
require 'database.php';
require __DIR__ . '/../vendor/autoload.php';

//conectar a bd
use Model\ActiveRecord;

ActiveRecord::setDB($db);