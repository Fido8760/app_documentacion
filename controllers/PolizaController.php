<?php

namespace Controllers;

use Model\Poliza;
use MVC\Router;

class PolizaController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        //Consultar bd
        $consulta = "SELECT polizas.id, CONCAT_WS('',unidades.no_unidad, cajas.numero_caja) AS economico, ";
        $consulta .= "n_poliza, ";
        $consulta .= "CONCAT_WS('',tipo_unidad, cajas.capacidad) AS tipo, ";
        $consulta .= "CONCAT_WS('',unidades.u_placas, cajas.c_placas) AS placas, ";
        $consulta .= "fe_final, subir_archivo ";
        $consulta .= "FROM polizas ";
        $consulta .= "LEFT JOIN unidades ON polizas.id_unidad = unidades.id ";
        $consulta .= "LEFT JOIN cajas ON polizas.id_caja = cajas.id";

        $polizas = Poliza::SQL($consulta);

        $router->render('polizas/polizas', [
            'titulo' => 'Pólizas de Seguro',
            'polizas' => $polizas,
            'mostrarLayout' => $mostrarLayout

        ]);
    }
    //Modal seleccion tipo de póliza
    public static function seleccionarTipoPoliza() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipoPoliza = $_POST['tipo_poliza'];
            // Redirigir al formulario correspondiente
            if ($tipoPoliza === 'vehicular') {
                header('Location: /polizas/crear-poliza-vehicular');
            } else if ($tipoPoliza === 'remolque') {
                header('Location: /crear-poliza-remolque');
            }
        }
    }

    public static function crearPolizaVehicular(Router $router){
        if(!is_auth()){
            header('Location: /');
        }
        $showNavbar = true;
        $poliza = new Poliza;
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_auth()){
                header('Location: /');
            }
            if (isset($_FILES['subir_archivo']) && $_FILES['subir_archivo']['error'] === UPLOAD_ERR_OK) {
                $pdf = $_FILES['subir_archivo'];
                
                // Procesa el archivo
                $carpetaPDF = '../public/build/pdf/';
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF);
                }
                $nombrePDF = md5(uniqid(rand(), true));
                move_uploaded_file($pdf['tmp_name'], $carpetaPDF . $nombrePDF . ".pdf");
                $poliza->setPDF($nombrePDF);
            } else {
                // Manejo de errores si el archivo no se ha subido correctamente
                $alertas['error'][] = 'No se ha subido ningún archivo o hubo un error en la carga.';
            }
            
            $poliza->sincronizar($_POST);
            $alertas = $poliza->validar();

            if(empty($alertas)){
                $poliza->guardar();
                $carpetaPDF = '../public/build/pdf/';
                if(!is_dir($carpetaPDF)){
                    mkdir($carpetaPDF);
                }
                //generamos nombre único
                $nombrePDF = md5( uniqid( rand(), true) );
                //subir pdf
                move_uploaded_file($pdf['tmp_name'], $carpetaPDF . $nombrePDF . ".pdf");
                $poliza->setPDF($nombrePDF);
                header('Location: /polizas');
            }
        }

        $router->render('polizas/crear-poliza-vehicular', [
            'showNavbar' => $showNavbar,
            'poliza' => $poliza,
            'alertas' => $alertas
        ]); 

    }
    
    public static function actualizar(){
        if(!is_auth()){
            header('Location: /');
        }

    }

    public static function eliminart(){
        if(!is_auth()){
            header('Location: /');
        }

    }
}