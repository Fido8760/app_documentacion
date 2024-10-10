<?php 

namespace Controllers;

use Model\Caja;
use MVC\Router;
use Model\Unidad;
use Model\VerificacionFisico;
use Model\VerificacionFisicoUnidad;
use Model\VerificacionFisicoRemolque;

class VerifFisicoController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $verificaciones_fisico = VerificacionFisico::all();
        foreach ($verificaciones_fisico as $verificacion) {
            $verificacion->unidad = Unidad::find($verificacion->id_unidad);
            $verificacion->caja = Caja::find($verificacion->id_caja);

            $verificacion->economico = $verificacion->unidad->no_unidad ?? $verificacion->caja->numero_caja ?? '';
            $verificacion->placas = $verificacion->unidad->u_placas ?? $verificacion->caja->c_placas ?? '';

            if ($verificacion->unidad) {
                $verificacion->url_detalle = "/verif-fisico/actualizarUnidad?id=" . $verificacion->id;
            } else if ($verificacion->caja) {
                $verificacion->url_detalle = "/verif-fisico/actualizarCaja?id=" . $verificacion->id;
            }
        }

        $mostrarLayout = true;
        $router->render('verif-fisico/index', [
            'titulo' => 'Verificaciones Fisco-Mecánicas',
            'mostrarLayout' => $mostrarLayout,
            'verificaciones_fisico' => $verificaciones_fisico
        ]);
    }
    
    public static function crearUnidad(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $alertas = [];
        $verificacion_fisico = new VerificacionFisicoUnidad;
        $consulta = 'SELECT u.id, u.no_unidad FROM unidades u LEFT JOIN verif_fisico v ON u.id = v.id_unidad WHERE v.id_unidad IS NULL';
        $unidades = Unidad::SQL($consulta);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('Location: /');
            }

             // Leer archivo PDF
             if (!empty($_FILES['subir_archivo_fisico']['tmp_name'])) {

                $carpetaPDF = '../public/build/pdf/verif-fisico';

                // Crear la carpeta si no existe
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                // Generar un nombre único para el archivo
                $nombre_pdf = md5(uniqid(rand(), true));

                // Obtener la extensión del archivo para conservarla
                $extension = pathinfo($_FILES['subir_archivo_fisico']['name'], PATHINFO_EXTENSION);

                // Asignar el nombre completo del archivo
                $nombreArchivo = $nombre_pdf . '.' . $extension;

                // Guardar el nuevo nombre del archivo en $_POST
                $_POST['subir_archivo_fisico'] = $nombreArchivo;

                // Mover el archivo a la carpeta
                $pdf = $_FILES['subir_archivo_fisico']['tmp_name'];
                $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                if (move_uploaded_file($pdf, $rutaDestino)) {
                    // El archivo ha sido subido correctamente
                }
            }

            // Sincronizar con el modelo y validar
            $verificacion_fisico->sincronizar($_POST);
            $alertas = $verificacion_fisico->validar();

            if (empty($alertas)) {

                $resultado = $verificacion_fisico->guardar();

                if ($resultado) {
                    header('Location: /verif-fisico?alert=success&action=create');
                }
            }
        }
        
        $router->render('verif-fisico/crear-fisico-unidad', [

            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Agregar Verificación Físico-Mecánica de Unidad',
            'alertas' => $alertas,
            'actualizando' => false,
            'verificacion_fisico' => $verificacion_fisico,
            'unidades' => $unidades

        ]);
    }

    public static function crearCaja(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $alertas = [];
        $verificacion_fisico = new VerificacionFisicoRemolque;
        $consulta = 'SELECT c.id, c.numero_caja FROM cajas c LEFT JOIN verif_fisico v ON c.id = v.id_caja WHERE v.id_caja IS NULL';
        $cajas = Caja::SQL($consulta);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('Location: /');
            }

             // Leer archivo PDF
             if (!empty($_FILES['subir_archivo_fisico']['tmp_name'])) {

                $carpetaPDF = '../public/build/pdf/verif-fisico';

                // Crear la carpeta si no existe
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                // Generar un nombre único para el archivo
                $nombre_pdf = md5(uniqid(rand(), true));

                // Obtener la extensión del archivo para conservarla
                $extension = pathinfo($_FILES['subir_archivo_fisico']['name'], PATHINFO_EXTENSION);

                // Asignar el nombre completo del archivo
                $nombreArchivo = $nombre_pdf . '.' . $extension;

                // Guardar el nuevo nombre del archivo en $_POST
                $_POST['subir_archivo_fisico'] = $nombreArchivo;

                // Mover el archivo a la carpeta
                $pdf = $_FILES['subir_archivo_fisico']['tmp_name'];
                $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                if (move_uploaded_file($pdf, $rutaDestino)) {
                    // El archivo ha sido subido correctamente
                }
            }

            // Sincronizar con el modelo y validar
            $verificacion_fisico->sincronizar($_POST);
            $alertas = $verificacion_fisico->validar();

            if (empty($alertas)) {

                $resultado = $verificacion_fisico->guardar();

                if ($resultado) {
                    header('Location: /verif-fisico?alert=success&action=create');
                }
            }
        }
        
        $router->render('verif-fisico/crear-fisico-caja', [

            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Agregar Verificación Físico-Mecánica de Remolque',
            'alertas' => $alertas,
            'actualizando' => false,
            'verificacion_fisico' => $verificacion_fisico,
            'cajas' => $cajas

        ]);
    }

    public static function actualizarUnidad(Router $router) {

        $mostrarLayout = true;
        $alertas = [];

        $id = validarORedireccionar('/verif-fisico');

        $verificacion_fisico = VerificacionFisicoUnidad::find($id);
        if (!$verificacion_fisico) {
            header('Location: /verif-fisico');
        }

        $verificacion_fisico->unidad = Unidad::find($verificacion_fisico->id_unidad);
        // Guardamos el archivo actual (PDF) para su posible eliminación

        $verificacion_fisico->pdf_actual = $verificacion_fisico->subir_archivo_fisico;
        $pdfAnterior = $verificacion_fisico->pdf_actual; // Guardamos el nombre del archivo actual

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['subir_archivo_fisico']['tmp_name'])) {
                $carpetaPDF = '../public/build/pdf/verif-fisico';

                // Crear la carpeta si no existe
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                // Generar un nombre único para el archivo
                $nombre_pdf = md5(uniqid(rand(), true));

                // Obtener la extensión del archivo para conservarla
                $extension = pathinfo($_FILES['subir_archivo_fisico']['name'], PATHINFO_EXTENSION);

                // Asignar el nombre completo del archivo
                $nombreArchivo = $nombre_pdf . '.' . $extension;

                // Guardar el nuevo nombre del archivo en $_POST
                $_POST['subir_archivo_fisico'] = $nombreArchivo;

                // Eliminar el archivo anterior si existe
                if (file_exists($carpetaPDF . '/' . $pdfAnterior)) {
                    unlink($carpetaPDF . '/' . $pdfAnterior); // Eliminar el archivo anterior
                }
            } else {
                // Mantener el archivo actual si no se sube uno nuevo
                $_POST['subir_archivo_fisico'] = $verificacion_fisico->pdf_actual;
            }

            // Sincronizar el modelo con los datos del formulario
            $verificacion_fisico->sincronizar($_POST);
            $alertas = $verificacion_fisico->validar();

            if (empty($alertas)) {
                if (isset($nombreArchivo)) {
                    // Mover el archivo a la carpeta
                    $pdf = $_FILES['subir_archivo_fisico']['tmp_name'];
                    $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                    if (move_uploaded_file($pdf, $rutaDestino)) {
                        // El archivo ha sido subido correctamente
                    }
                }
                $resultado = $verificacion_fisico->guardar();

                if ($resultado) {
                    header('Location:/verif-fisico?alert=success&action=update');
                }
            }
        }

        $router->render('verif-fisico/actualizar-fisico-unidad', [
            'titulo' => 'Actualización de Verificación de Unidad',
            'mostrarLayout' =>  $mostrarLayout,
            'alertas' => $alertas,
            'verificacion_fisico' => $verificacion_fisico,
            'actualizando' => true
        ]);

    }

    public static function actualizarCaja(Router $router) {
        $mostrarLayout = true; 
        $alertas = [];
        $id = validarORedireccionar('/verif-fisico');

        $verificacion_fisico = VerificacionFisicoRemolque::find($id);
        if (!$verificacion_fisico) {
            header('Location: /verif-fisico');
        }

        $verificacion_fisico->caja = Caja::find($verificacion_fisico->id_caja);
        // Guardamos el archivo actual (PDF) para su posible eliminación

        $verificacion_fisico->pdf_actual = $verificacion_fisico->subir_archivo_fisico;
        $pdfAnterior = $verificacion_fisico->pdf_actual;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['subir_archivo_fisico']['tmp_name'])) {
                $carpetaPDF = '../public/build/pdf/verif-fisico';

                // Crear la carpeta si no existe
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                // Generar un nombre único para el archivo
                $nombre_pdf = md5(uniqid(rand(), true));
                $extension = pathinfo($_FILES['subir_archivo_fisico']['name'], PATHINFO_EXTENSION);

                $nombreArchivo = $nombre_pdf . '.' . $extension;
                $_POST['subir_archivo_fisico'] = $nombreArchivo;

                if (file_exists($carpetaPDF . '/' . $pdfAnterior)) {
                    unlink($carpetaPDF . '/' . $pdfAnterior); // Eliminar el archivo anterior
                }
            } else {
                // Mantener el archivo actual si no se sube uno nuevo
                $_POST['subir_archivo_fisico'] = $verificacion_fisico->pdf_actual;
            }

            $verificacion_fisico->sincronizar($_POST);
            $alertas = $verificacion_fisico->validar();

            if (empty($alertas)) {
                if (isset($nombreArchivo)) {
                    // Mover el archivo a la carpeta
                    $pdf = $_FILES['subir_archivo_fisico']['tmp_name'];
                    $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                    if (move_uploaded_file($pdf, $rutaDestino)) {
                        // El archivo ha sido subido correctamente
                    }
                }
                $resultado = $verificacion_fisico->guardar();

                if ($resultado) {
                    header('Location:/verif-fisico?alert=success&action=update');
                }
            }
        }

        $router->render('verif-fisico/actualizar-fisico-caja', [
            'titulo' => 'Actualización de Verificación de Caja',
            'mostrarLayout' =>  $mostrarLayout,
            'alertas' => $alertas,
            'verificacion_fisico' => $verificacion_fisico,
            'actualizando' => true
        ]);

    }

    public static function eliminar() {
        if (!is_auth()) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $verificacion_fisico = VerificacionFisico::find($id);

            if (!$verificacion_fisico) {
                header('Location: /verif-fisico');
            }

            // Obtener el archivo PDF asociado
            $pdfArchivo = $verificacion_fisico->subir_archivo;
            $carpetaPDF = '../public/build/pdf/verif-fisico';

            // Eliminar el archivo PDF del servidor si existe
            if (!empty($pdfArchivo) && file_exists($carpetaPDF . '/' . $pdfArchivo)) {
                unlink($carpetaPDF . '/' . $pdfArchivo); // Eliminar el archivo del servidor
            }

            // Eliminar la póliza de la base de datos
            $resultado = $verificacion_fisico->eliminar();
            if ($resultado) {
                header('Location: /verif-fisico?alert=success&action=delete');
            }
        }
    }    
    
}