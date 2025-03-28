<?php

namespace Controllers;

use MVC\Router;
use Model\Unidad;
use Model\VerficacionAmbiental;
use Model\VerficacionAmbientalAnt;

class VerifAmbientalController {
    public static function info() {
        $verificaciones_amb = VerficacionAmbiental::all();
        foreach ($verificaciones_amb as $verif_amb) {
            $verif_amb->unidad = Unidad::find($verif_amb->id_unidad_ver);
        }

        echo json_encode($verificaciones_amb);
    }
    
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $verificaciones_amb = VerficacionAmbiental::all();

        foreach($verificaciones_amb as $verficacion) {
            $verficacion->unidad = Unidad::find($verficacion->id_unidad_ver);
            $verficacion->anterior = VerficacionAmbientalAnt::find($verficacion->id);
        }

        $mostrarLayout = true;
        $router->render('verif-ambiental/index', [
            'titulo' => 'Verificaciones Ambientales',
            'mostrarLayout' => $mostrarLayout,
            'verificaciones_amb' => $verificaciones_amb
        ]);
    }

    public static function crear(Router $router) {
        $mostrarLayout = true;
        $alertas = [];
        $verificacion_amb = new VerficacionAmbiental;
        $consulta = 'SELECT u.id, u.no_unidad FROM unidades u LEFT JOIN verificacion_ambiental v ON u.id = v.id_unidad_ver WHERE v.id_unidad_ver IS NULL';
        $unidades = Unidad::SQL($consulta);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!is_auth()) {
                header('Location: /');
            }

            if (!empty($_FILES['subir_archivo_amb']['tmp_name'])) {
        
                $carpetaPDF = '../public/build/pdf/verif-ambiental';
    
                // Crear la carpeta si no existe
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }
    
                // Generar un nombre único para el archivo
                $nombre_pdf = md5(uniqid(rand(), true));
    
                // Obtener la extensión del archivo para conservarla
                $extension = pathinfo($_FILES['subir_archivo_amb']['name'], PATHINFO_EXTENSION);
    
                // Asignar el nombre completo del archivo
                $nombreArchivo = $nombre_pdf . '.' . $extension;
    
                // Guardar el nuevo nombre del archivo en $_POST
                $_POST['subir_archivo_amb'] = $nombreArchivo;
    
                // Mover el archivo a la carpeta
                $pdf = $_FILES['subir_archivo_amb']['tmp_name'];
                $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;
    
                if (move_uploaded_file($pdf, $rutaDestino)) {
                    // El archivo ha sido subido correctamente
                }
            }
        
            // Combinar $_POST con $_FILES
            $verificacion_amb->sincronizar($_POST);
            $alertas = $verificacion_amb->validar();
        
            if (empty($alertas)) {

                $resultado = $verificacion_amb->guardar();
                if($resultado) {
                    header('Location: /verif-ambiental?alert=success&action=create');
                }

            }
        }
        
        $router->render('verif-ambiental/crear-ambiental', [
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Agregar Verificación Ambiental ',
            'alertas' => $alertas,
            'verificacion_amb' => $verificacion_amb,
            'actualizando' => false,
            'unidades' => $unidades
        ]);
    }

    public static function actualizar(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $alertas = [];
        $id = validarORedireccionar('/verif-ambiental');

        $verificacion_amb = VerficacionAmbiental::find($id);
        if (!$verificacion_amb) {
            header('Location: /polizas');
        }
        $verificacion_amb->unidad = Unidad::find($verificacion_amb->id_unidad_ver);
        
        // Guardamos el archivo actual (PDF) para su posible eliminación
        $verificacion_amb->pdf_actual = $verificacion_amb->subir_archivo_amb;
        $pdfAnterior = $verificacion_amb->pdf_actual;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['subir_archivo_amb']['tmp_name'])) {
                $carpetaPDF = '../public/build/pdf/verif-ambiental';

                // Crear la carpeta si no existe
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                // Generar un nombre único para el archivo
                $nombre_pdf = md5(uniqid(rand(), true));

                // Obtener la extensión del archivo para conservarla
                $extension = pathinfo($_FILES['subir_archivo_amb']['name'], PATHINFO_EXTENSION);

                // Asignar el nombre completo del archivo
                $nombreArchivo = $nombre_pdf . '.' . $extension;

                // Guardar el nuevo nombre del archivo en $_POST
                $_POST['subir_archivo_amb'] = $nombreArchivo;

                // Eliminar el archivo anterior si existe
                if (file_exists($carpetaPDF . '/' . $pdfAnterior)) {
                    unlink($carpetaPDF . '/' . $pdfAnterior); // Eliminar el archivo anterior
                }
            } else {
                // Mantener el archivo actual si no se sube uno nuevo
                $_POST['subir_archivo_amb'] = $verificacion_amb->pdf_actual;
            }

            // Sincronizar el modelo con los datos del formulario
            $verificacion_amb->sincronizar($_POST);
            $alertas = $verificacion_amb->validar();

            if (empty($alertas)) {
                if (isset($nombreArchivo)) {
                    // Mover el archivo a la carpeta
                    $pdf = $_FILES['subir_archivo_amb']['tmp_name'];
                    $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                    if (move_uploaded_file($pdf, $rutaDestino)) {
                        // El archivo ha sido subido correctamente
                    }
                }
                $resultado = $verificacion_amb->guardar();

                if ($resultado) {
                    header('Location:/verif-ambiental?alert=success&action=update');
                }
            }
        }

        $router->render('verif-ambiental/actualizar-ambiental',  [
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Actualizar Verificación para la Unidad',
            'alertas' => $alertas,
            'actualizando' => true,
            'verificacion_amb' => $verificacion_amb
        ]);
    }

    public static function eliminar() {
        if (!is_auth()) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $verificacion_amb = VerficacionAmbiental::find($id);

            if (!$verificacion_amb) {
                header('Location: /verif-ambiental');
            }

            // Obtener el archivo PDF asociado
            $pdfArchivo = $verificacion_amb->subir_archivo_amb;
            $carpetaPDF = '../public/build/pdf/verif-ambiental';

            // Eliminar el archivo PDF del servidor si existe
            if (!empty($pdfArchivo) && file_exists($carpetaPDF . '/' . $pdfArchivo)) {
                unlink($carpetaPDF . '/' . $pdfArchivo); // Eliminar el archivo del servidor
            }

            // Eliminar la póliza de la base de datos
            $resultado = $verificacion_amb->eliminar();
            if ($resultado) {
                header('Location: /verif-ambiental?alert=success&action=delete');
            }
        }
    }

    public static function pdf() {
        if (isset($_GET['pdf'])) {
            $archivo = $_GET['pdf'];
            $rutaArchivo = '/home1/mudanzd2/app_documentacion/public/build/pdf/verif-ambiental/' . $archivo; // Ajusta la ruta

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