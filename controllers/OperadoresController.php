<?php
namespace Controllers;

use Model\Operador;
use Model\Puestos;
use MVC\Router;

class OperadoresController {
    public static function info() {
        $operadores = Operador::all();
        echo json_encode($operadores);
    }
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $operadores = Operador::all();
        foreach($operadores as $operador) {
            $operador->estatus_licencia = calcularEstatusGenerico($operador->vigencia_lic, $operador->id, __DIR__ . '/enviados_licencia.txt',$operador->nombre . ' ' . $operador->apellido_p . ' ' . $operador->apellido_m, null, null, 'licencia' );
            $operador->estatus_apto = calcularEstatusGenerico($operador->vigencia_apto,  $operador->id, __DIR__ . '/enviados_apto.txt',$operador->nombre . ' ' . $operador->apellido_p . ' ' . $operador->apellido_m, null, null, 'apto');
        }

        $router->render('operadores/index',[
            'titulo' => 'Operadores',
            'mostrarLayout' => $mostrarLayout,
            'operadores' => $operadores
        ]);
    }

    public static function crear(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $alertas = [];
        $operador = new Operador;
        $consulta = 'SELECT * FROM puestos';
        $puestos = Puestos::SQL($consulta);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()){
                header('Location: /');
            }

            $_POST['subir_archivo_licencia'] = manejarSubidaArchivo('operadores','subir_archivo_licencia');
            $_POST['subir_archivo_apto'] = manejarSubidaArchivo('operadores','subir_archivo_apto');
            $_POST['subir_archivo_ine'] = manejarSubidaArchivo('operadores','subir_archivo_ine');
            $_POST['subir_archivo_control'] = manejarSubidaArchivo('operadores','subir_archivo_control');

            $operador->sincronizar($_POST);
            $alertas = $operador->validar();

            if(empty($alertas)) {
                $resultado = $operador->guardar();
                if($resultado) {
                    header('Location: /operadores?alert=success&action=create');
                }
            }
        }

        $router->render('operadores/crear', [
            'titulo' => 'Agregar Operador',
            'mostrarLayout' => $mostrarLayout,
            'alertas' => $alertas,
            'operador' => $operador,
            'puestos' => $puestos
        ]);
    }
    public static function actualizar(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $alertas = [];
        $consulta = 'SELECT * FROM puestos';
        $puestos = Puestos::SQL($consulta);

        $id = validarORedireccionar('/operadores');
        $operador = Operador::find($id);
        if (!$operador) {
            header('Location: /operadores');
        }

        // Archivos PDF actuales
        $pdfsAnteriores = [
            'subir_archivo_licencia' => $operador->subir_archivo_licencia,
            'subir_archivo_apto' => $operador->subir_archivo_apto,
            'subir_archivo_ine' => $operador->subir_archivo_ine,
            'subir_archivo_control' => $operador->subir_archivo_control
        ];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Actualizar los archivos PDF y asignar a $_POST
            $_POST['subir_archivo_licencia'] = manejarSubidaArchivo('operadores','subir_archivo_licencia', $pdfsAnteriores['subir_archivo_licencia']);
            $_POST['subir_archivo_apto'] = manejarSubidaArchivo('operadores','subir_archivo_apto', $pdfsAnteriores['subir_archivo_apto']);
            $_POST['subir_archivo_ine'] = manejarSubidaArchivo('operadores','subir_archivo_ine', $pdfsAnteriores['subir_archivo_ine']);
            $_POST['subir_archivo_control'] = manejarSubidaArchivo('operadores','subir_archivo_control', $pdfsAnteriores['subir_archivo_control']);
            
            $operador->sincronizar($_POST);
            $alertas = $operador->validar();

            if(empty($alertas)) {
                $resultado = $operador->guardar();
                if($resultado) {
                    header('Location: /operadores?alert=success&action=update');
                }
            }
        }

        $router->render('operadores/actualizar', [
            'titulo' => 'Actualizar al Operador',
            'mostrarLayout' => $mostrarLayout,
            'alertas' => $alertas,
            'operador' => $operador,
            'puestos' => $puestos
        ]);
    }

    public static function eliminar() {
        if(!is_auth()) {
            header('Location: /');
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $operador = Operador::find($id);

            if(!$operador) {
                header('Location: /operadores');
            }

            $pdfs = [
                'subir_archivo_licencia',
                'subir_archivo_apto',
                'subir_archivo_ine',
                'subir_archivo_control'
            ];

            $carpetaPDF = '../public/build/pdf/operadores';

            foreach($pdfs as $pdf) {
                $pdfArchivo = $operador->$pdf;
                if (!empty($pdfArchivo) && file_exists($carpetaPDF . '/' . $pdfArchivo)){
                    unlink($carpetaPDF . '/' . $pdfArchivo);
                }
            }
            $resultado = $operador->eliminar();
            if ($resultado) {
                header('Location: /operadores?alert=success&action=delete');
            }
        }
    }

    public static function pdf() {
        if (isset($_GET['pdf'])) {
            $archivo = $_GET['pdf'];
            $rutaArchivo = __DIR__ . '../../public/build/pdf/operadores/' . $archivo; // Ajusta la ruta

            if (file_exists($rutaArchivo)) {
                // Establecer cabeceras para la descarga del archivo PDF
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . basename($rutaArchivo) . '"');
                header('Content-Length: ' . filesize($rutaArchivo));
                readfile($rutaArchivo);
                exit; // Termina el script después de enviar el archivo
            }
        }
    }
}