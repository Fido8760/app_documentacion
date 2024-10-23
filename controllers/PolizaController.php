<?php

namespace Controllers;

use Model\Caja;
use MVC\Router;
use Model\Poliza;
use Model\Unidad;
use Model\PolizaCaja;
use Model\PolizaUnidad;

class PolizaController
{
    public static function info()
    {
        $polizas = Poliza::all();
        foreach ($polizas as $poliza) {

            $poliza->unidad = Unidad::find($poliza->id_unidad);
            $poliza->caja = Caja::find($poliza->id_caja);

            $poliza->economico = $poliza->unidad->no_unidad ?? $poliza->caja->numero_caja ?? '';
            $poliza->placas = $poliza->unidad->u_placas ?? $poliza->caja->c_placas ?? '';
            $poliza->tipo = $poliza->unidad->tipo_unidad ?? $poliza->caja->capacidad ?? '';
        }

        echo json_encode($polizas);
    }
    public static function index(Router $router)
    {
        if (!is_auth()) {
            header('Location: /');
        }

        $polizas = Poliza::all();
        foreach ($polizas as $poliza) {
            $poliza->unidad = Unidad::find($poliza->id_unidad);
            $poliza->caja = Caja::find($poliza->id_caja);

            $poliza->economico = $poliza->unidad->no_unidad ?? $poliza->caja->numero_caja ?? '';
            $poliza->placas = $poliza->unidad->u_placas ?? $poliza->caja->c_placas ?? '';
            $poliza->tipo = $poliza->unidad->tipo_unidad ?? $poliza->caja->capacidad ?? '';
            $poliza->estatus = calcularEstatusGenerico($poliza->fe_final, $poliza->id, __DIR__ . '/enviados.txt', null, $poliza->economico, $poliza->placas, 'poliza'); // Función para calcular el estatus

            // Verificar si es una unidad o una caja
            if ($poliza->unidad) {
                $poliza->url_detalle = "/polizas/actualizar-poliza-unidad?id=" . $poliza->id;
            } else if ($poliza->caja) {
                $poliza->url_detalle = "/polizas/actualizar-poliza-remolque?id=" . $poliza->id;
            }
        }

        $mostrarLayout = true;
        $router->render('polizas/index', [
            'titulo' => 'Pólizas de Seguro',
            'mostrarLayout' => $mostrarLayout,
            'polizas' => $polizas
        ]);
    }

    
    //--------------------------------------------- PÓLIZAS UNIDADES -----------------------------------------------------------------


    public static function crearPolizaUnidad(Router $router)
    {
        if (!is_auth()) {
            header('Location: /');
        }
        $consulta = 'SELECT u.id, u.no_unidad FROM unidades u LEFT JOIN polizas p ON u.id = p.id_unidad WHERE p.id_unidad IS NULL';
        $alertas = [];
        $mostrarLayout = true;
        $unidades = Unidad::SQL($consulta);
        $poliza_unidad = new PolizaUnidad;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('Location: /');
            }

             // Leer archivo PDF
             if (!empty($_FILES['subir_archivo']['tmp_name'])) {

                $carpetaPDF = '../public/build/pdf/polizas';

                // Crear la carpeta si no existe
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                // Generar un nombre único para el archivo
                $nombre_pdf = md5(uniqid(rand(), true));

                // Obtener la extensión del archivo para conservarla
                $extension = pathinfo($_FILES['subir_archivo']['name'], PATHINFO_EXTENSION);

                // Asignar el nombre completo del archivo
                $nombreArchivo = $nombre_pdf . '.' . $extension;

                // Guardar el nuevo nombre del archivo en $_POST
                $_POST['subir_archivo'] = $nombreArchivo;

                // Mover el archivo a la carpeta
                $pdf = $_FILES['subir_archivo']['tmp_name'];
                $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                if (move_uploaded_file($pdf, $rutaDestino)) {
                    // El archivo ha sido subido correctamente
                }
            }

            // Sincronizar con el modelo y validar
            $poliza_unidad->sincronizar($_POST);
            $alertas = $poliza_unidad->validar();

            if (empty($alertas)) {

                $resultado = $poliza_unidad->guardar();

                if ($resultado) {
                    header('Location: /polizas?alert=success&action=create');
                }
            }
        }

        $router->render('polizas/poliza-unidad', [
            'titulo' => 'Póliza de Seguro Para Unidades',
            'mostrarLayout' => $mostrarLayout,
            'alertas' => $alertas,
            'poliza_unidad' => $poliza_unidad,
            'unidades' => $unidades,
            'actualizando' => false
        ]);
    }

    public static function actualizarPolizaUnidad(Router $router)
    {
        $mostrarLayout = true;
        $alertas = [];
        $id = validarORedireccionar('/polizas');
        $poliza_unidad = PolizaUnidad::find($id);
        if (!$poliza_unidad) {
            header('Location: /polizas');
        }

        $poliza_unidad->unidad = Unidad::find($poliza_unidad->id_unidad);
        // Guardamos el archivo actual (PDF) para su posible eliminación

        $poliza_unidad->pdf_actual = $poliza_unidad->subir_archivo;
        $pdfAnterior = $poliza_unidad->pdf_actual; // Guardamos el nombre del archivo actual

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['subir_archivo']['tmp_name'])) {
                $carpetaPDF = '../public/build/pdf/polizas';

                // Crear la carpeta si no existe
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                // Generar un nombre único para el archivo
                $nombre_pdf = md5(uniqid(rand(), true));

                // Obtener la extensión del archivo para conservarla
                $extension = pathinfo($_FILES['subir_archivo']['name'], PATHINFO_EXTENSION);

                // Asignar el nombre completo del archivo
                $nombreArchivo = $nombre_pdf . '.' . $extension;

                // Guardar el nuevo nombre del archivo en $_POST
                $_POST['subir_archivo'] = $nombreArchivo;

                // Eliminar el archivo anterior si existe
                if (file_exists($carpetaPDF . '/' . $pdfAnterior)) {
                    unlink($carpetaPDF . '/' . $pdfAnterior); // Eliminar el archivo anterior
                }
            } else {
                // Mantener el archivo actual si no se sube uno nuevo
                $_POST['subir_archivo'] = $poliza_unidad->pdf_actual;
            }

            // Sincronizar el modelo con los datos del formulario
            $poliza_unidad->sincronizar($_POST);
            $alertas = $poliza_unidad->validar();

            if (empty($alertas)) {
                if (isset($nombreArchivo)) {
                    // Mover el archivo a la carpeta
                    $pdf = $_FILES['subir_archivo']['tmp_name'];
                    $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                    if (move_uploaded_file($pdf, $rutaDestino)) {
                        // El archivo ha sido subido correctamente
                    }
                }
                $resultado = $poliza_unidad->guardar();

                if ($resultado) {
                    header('Location:/polizas?alert=success&action=update');
                }
            }
        }

        $router->render('polizas/actualizar-poliza-u', [
            'titulo' => 'Actualización de Póliza de Unidad',
            'mostrarLayout' =>  $mostrarLayout,
            'alertas' => $alertas,
            'poliza_unidad' => $poliza_unidad,
            'actualizando' => true
        ]);
    }
 
    //--------------------------------------- Polizas de Remolques ----------------------------

    public static function crearPolizaRemolque(Router $router)
    {

        $mostrarLayout = true;
        $alertas = [];
        $poliza_caja = new PolizaCaja;
        $consulta = 'SELECT c.id, c.numero_caja FROM cajas c LEFT JOIN polizas p ON c.id = p.id_caja WHERE p.id_caja IS NULL';
        $cajas = Caja::SQL($consulta);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['subir_archivo']['tmp_name'])) {

                $carpetaPDF = '../public/build/pdf/polizas';

                // Crear la carpeta si no existe
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }
                $nombre_pdf = md5(uniqid(rand(), true));

                $extension = pathinfo($_FILES['subir_archivo']['name'], PATHINFO_EXTENSION);

                $nombreArchivo = $nombre_pdf . '.' . $extension;
                $_POST['subir_archivo'] = $nombreArchivo;

                $pdf = $_FILES['subir_archivo']['tmp_name'];
                $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                if (move_uploaded_file($pdf, $rutaDestino)) {
                    // El archivo ha sido subido correctamente
                }
            }
            $poliza_caja->sincronizar($_POST);
            $alertas = $poliza_caja->validar();

            if (empty($alertas)) {
                $resultado = $poliza_caja->guardar();

                if ($resultado) {
                    header('Location: /?alert=success&action=create');
                }
            }
        }

        $router->render('polizas/poliza-caja', [
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Póliza de Seguro Para Remolques',
            'alertas' => $alertas,
            'poliza_caja' => $poliza_caja,
            'actualizando' => false,
            'cajas' => $cajas

        ]);
    }
    public static function actualizarPolizaRemolque(Router $router)
    {
        $mostrarLayout = true;
        $alertas = [];

        $id = validarORedireccionar('/polizas');

        $poliza_caja = PolizaCaja::find($id);
        if (!$poliza_caja) {
            header('Location: /polizas');
        }
        $poliza_caja->caja = Caja::find($poliza_caja->id_caja);

        $poliza_caja->pdf_actual = $poliza_caja->subir_archivo;
        $pdfAnterior = $poliza_caja->pdf_actual;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['subir_archivo']['tmp_name'])) {
                $carpetaPDF = '../public/build/pdf/polizas';

                // Crear la carpeta si no existe
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                // Generar un nombre único para el archivo
                $nombre_pdf = md5(uniqid(rand(), true));

                // Obtener la extensión del archivo para conservarla
                $extension = pathinfo($_FILES['subir_archivo']['name'], PATHINFO_EXTENSION);

                // Asignar el nombre completo del archivo
                $nombreArchivo = $nombre_pdf . '.' . $extension;

                // Guardar el nuevo nombre del archivo en $_POST
                $_POST['subir_archivo'] = $nombreArchivo;

                // Eliminar el archivo anterior si existe
                if (file_exists($carpetaPDF . '/' . $pdfAnterior)) {
                    unlink($carpetaPDF . '/' . $pdfAnterior); // Eliminar el archivo anterior
                }
            } else {
                // Mantener el archivo actual si no se sube uno nuevo
                $_POST['subir_archivo'] = $poliza_unidad->pdf_actual;
            }

            // Sincronizar el modelo con los datos del formulario
            $poliza_caja->sincronizar($_POST);
            $alertas = $poliza_caja->validar();

            if (empty($alertas)) {
                if (isset($nombreArchivo)) {
                    // Mover el archivo a la carpeta
                    $pdf = $_FILES['subir_archivo']['tmp_name'];
                    $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                    if (move_uploaded_file($pdf, $rutaDestino)) {
                        // El archivo ha sido subido correctamente
                    }
                }
                $resultado = $poliza_caja->guardar();

                if ($resultado) {
                    header('Location:/polizas?alert=success&action=update');
                }
            }
        }

        $router->render('polizas/actualizar-poliza-r', [
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Actualizar Póliza de Remolque',
            'poliza_caja' => $poliza_caja,
            'actualizando' => true,
            'alertas' => $alertas
        ]);
    }

    //--------------------------------------------- ELIMINAR PÓLIZAS -----------------------------------------------------------------
    public static function eliminar() {
        if (!is_auth()) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $poliza = Poliza::find($id);

            if (!$poliza) {
                header('Location: /polizas');
            }

            // Obtener el archivo PDF asociado
            $pdfArchivo = $poliza->subir_archivo;
            $carpetaPDF = '../public/build/pdf/polizas';

            // Eliminar el archivo PDF del servidor si existe
            if (!empty($pdfArchivo) && file_exists($carpetaPDF . '/' . $pdfArchivo)) {
                unlink($carpetaPDF . '/' . $pdfArchivo); // Eliminar el archivo del servidor
            }

            // Eliminar la póliza de la base de datos
            $resultado = $poliza->eliminar();
            if ($resultado) {
                header('Location: /polizas?alert=success&action=delete');
            }
        }
    }
    public static function pdf() {
        if (isset($_GET['pdf'])) {
            $archivo = basename($_GET['pdf']); // Asegúrate de sanitizar la entrada
            //$rutaArchivo = '/home1/mudanzd2/app_documentacion/public/build/pdf/polizas/' . $archivo; --Ruta Abosluta para producción
            $rutaArchivo = '/home1/mudanzd2/app_documentacion/public/build/pdf/polizas/' . $archivo; // Ajusta la ruta
    
            // Verifica si el archivo existe
            if (file_exists($rutaArchivo)) {
                // Establecer cabeceras para la descarga del archivo PDF
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . basename($rutaArchivo) . '"');
                header('Content-Length: ' . filesize($rutaArchivo));
                readfile($rutaArchivo);
                exit; // Termina el script después de enviar el archivo
            } else {
                echo "El archivo no existe.";
                exit;
            }
        }
    }
    
}
