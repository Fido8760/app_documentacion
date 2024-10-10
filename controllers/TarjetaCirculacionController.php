<?php 

namespace Controllers;

use Model\Caja;
use Model\TarjetaCirculacion;
use Model\TarjetaCirculacionCaja;
use Model\TarjetaCirculacionUnidad;
use Model\Unidad;
use MVC\Router;

class TarjetaCirculacionController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;
        $tarjetas = TarjetaCirculacion::all();

        foreach($tarjetas as $tarjeta) {
            $tarjeta->unidad = Unidad::find(($tarjeta->id_unidad));
            $tarjeta->caja = Caja::find(($tarjeta->id_caja));

            $tarjeta->economico = $tarjeta->unidad->no_unidad ?? $tarjeta->caja->numero_caja ?? '';
            $tarjeta->placas = $tarjeta->unidad->u_placas ?? $tarjeta->caja->c_placas ?? '';
            
            if($tarjeta->unidad) {
                $tarjeta->url_detalle = "/tarjetas-circulacion/actualizarUnidad?id=" . $tarjeta->id;
            } else if ($tarjeta->caja) {
                $tarjeta->url_detalle = "/tarjetas-circulacion/actualizarCaja?id=" . $tarjeta->id;
            }

        }

        $router->render('tarjeta-circulacion/index', [

            'titulo' => 'Tarjetas de Circulación',
            'mostrarLayout' => $mostrarLayout,
            'tarjetas' => $tarjetas
        ]);
    }

    public static function crearUnidad(Router $router) {
        $mostrarLayout = true;
        $alertas = [];
        $tarjeta = new TarjetaCirculacionUnidad;
        $consulta = 'SELECT u.id, u.no_unidad FROM unidades u LEFT JOIN tajetas_circulacion t ON u.id = t.id_unidad WHERE t.id_unidad IS NULL';
        $unidades = Unidad::SQL($consulta);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!is_auth()) {
                header('Location: /');
            }

            // Leer archivo PDF
            if (!empty($_FILES['subir_archivo_circulacion']['tmp_name'])) {

                $carpetaPDF = '../public/build/pdf/tarjetas-circulacion';
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                $nombre_pdf = md5(uniqid(rand(), true));
                $extension = pathinfo($_FILES['subir_archivo_circulacion']['name'], PATHINFO_EXTENSION);
                $nombreArchivo = $nombre_pdf . '.' . $extension;
                $_POST['subir_archivo_circulacion'] = $nombreArchivo;

                $pdf = $_FILES['subir_archivo_circulacion']['tmp_name'];
                $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                if (move_uploaded_file($pdf, $rutaDestino)) {
                    // El archivo ha sido subido correctamente
                }
            }

            $tarjeta->sincronizar($_POST);
            $alertas = $tarjeta->validar();

            if(empty($alertas)) {
                $resultado = $tarjeta->guardar();
                if($resultado) {
                    header('Location: /tarjetas-circulacion?alert=success&action=create');
                }
            }
        }

        $router->render('tarjeta-circulacion/crear-unidad', [
            
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Agregar Tarjeta de Circulación de Unidad',
            'alertas' => $alertas,
            'actualizando' => false,
            'tarjeta' => $tarjeta,
            'unidades' => $unidades

        ]);
    }

    public static function crearCaja(Router $router) {
        $mostrarLayout = true;
        $alertas = [];
        $tarjeta = new TarjetaCirculacionCaja;
        $consulta = 'SELECT c.id, c.numero_caja FROM cajas c LEFT JOIN tajetas_circulacion t ON c.id = t.id_caja WHERE t.id_caja IS NULL';
        $cajas = Caja::SQL($consulta);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!is_auth()) {
                header('Location: /');
            }

            // Leer archivo PDF
            if (!empty($_FILES['subir_archivo_circulacion']['tmp_name'])) {

                $carpetaPDF = '../public/build/pdf/tarjetas-circulacion';
                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                $nombre_pdf = md5(uniqid(rand(), true));
                $extension = pathinfo($_FILES['subir_archivo_circulacion']['name'], PATHINFO_EXTENSION);
                $nombreArchivo = $nombre_pdf . '.' . $extension;
                $_POST['subir_archivo_circulacion'] = $nombreArchivo;

                $pdf = $_FILES['subir_archivo_circulacion']['tmp_name'];
                $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                if (move_uploaded_file($pdf, $rutaDestino)) {
                    // El archivo ha sido subido correctamente
                }
            }

            $tarjeta->sincronizar($_POST);
            $alertas = $tarjeta->validar();

            if(empty($alertas)) {
                $resultado = $tarjeta->guardar();
                if($resultado) {
                    header('Location: /tarjetas-circulacion?alert=success&action=create');
                }
            }
        }

        $router->render('tarjeta-circulacion/crear-caja', [
            
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Agregar Tarjeta de Circulación de Remolque',
            'alertas' => $alertas,
            'actualizando' => false,
            'tarjeta' => $tarjeta,
            'cajas' => $cajas

        ]);
    }

    public static function actualizarUnidad(Router $router) {
        $mostrarLayout = true;
        $alertas = [];

        $id = validarORedireccionar('/tarjetas-circulacion');

        $tarjeta = TarjetaCirculacionUnidad::find($id);
        if (!$tarjeta) {
            header('Location: /tarjetas-circulacion');
        }

        $tarjeta->unidad = Unidad::find($tarjeta->id_unidad);
        // Guardamos el archivo actual (PDF) para su posible eliminación

        $tarjeta->pdf_actual = $tarjeta->subir_archivo_circulacion;
        $pdfAnterior = $tarjeta->pdf_actual; // Guardamos el nombre del archivo actual
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['subir_archivo_circulacion']['tmp_name'])) {
                $carpetaPDF = '../public/build/pdf/tarjetas-circulacion';

                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                $nombre_pdf = md5(uniqid(rand(), true));
                $extension = pathinfo($_FILES['subir_archivo_circulacion']['name'], PATHINFO_EXTENSION);
                $nombreArchivo = $nombre_pdf . '.' . $extension;
                $_POST['subir_archivo_circulacion'] = $nombreArchivo;
                if (file_exists($carpetaPDF . '/' . $pdfAnterior)) {
                    unlink($carpetaPDF . '/' . $pdfAnterior); // Eliminar el archivo anterior
                }
            } else {
                // Mantener el archivo actual si no se sube uno nuevo
                $_POST['subir_archivo_circulacion'] = $tarjeta->pdf_actual;
            }

            $tarjeta->sincronizar($_POST);
            $alertas = $tarjeta->validar();

            if (empty($alertas)) {
                if (isset($nombreArchivo)) {
                    // Mover el archivo a la carpeta
                    $pdf = $_FILES['subir_archivo_circulacion']['tmp_name'];
                    $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                    if (move_uploaded_file($pdf, $rutaDestino)) {
                        // El archivo ha sido subido correctamente
                    }
                }
                $resultado = $tarjeta->guardar();

                if ($resultado) {
                    header('Location:/tarjetas-circulacion?alert=success&action=update');
                }
            }
        }
        
        $router->render('tarjeta-circulacion/actualizar-unidad', [
            
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Agregar Tarjeta de Circulación de Remolque',
            'alertas' => $alertas,
            'actualizando' => true,
            'tarjeta' => $tarjeta

        ]);
    }

    public static function actualizarCaja(Router $router) {
        $mostrarLayout = true;
        $alertas = [];

        $
        $id = validarORedireccionar('/tarjetas-circulacion');

        $tarjeta = TarjetaCirculacionCaja::find($id);
        if (!$tarjeta) {
            header('Location: /tarjetas-circulacion');
        }

        $tarjeta->caja = Caja::find($tarjeta->id_caja);
        // Guardamos el archivo actual (PDF) para su posible eliminación

        $tarjeta->pdf_actual = $tarjeta->subir_archivo_circulacion;
        $pdfAnterior = $tarjeta->pdf_actual; // Guardamos el nombre del archivo actual
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['subir_archivo_circulacion']['tmp_name'])) {
                $carpetaPDF = '../public/build/pdf/tarjetas-circulacion';

                if (!is_dir($carpetaPDF)) {
                    mkdir($carpetaPDF, 0755, true);
                }

                $nombre_pdf = md5(uniqid(rand(), true));
                $extension = pathinfo($_FILES['subir_archivo_circulacion']['name'], PATHINFO_EXTENSION);
                $nombreArchivo = $nombre_pdf . '.' . $extension;
                $_POST['subir_archivo_circulacion'] = $nombreArchivo;
                if (file_exists($carpetaPDF . '/' . $pdfAnterior)) {
                    unlink($carpetaPDF . '/' . $pdfAnterior); // Eliminar el archivo anterior
                }
            } else {
                // Mantener el archivo actual si no se sube uno nuevo
                $_POST['subir_archivo_circulacion'] = $tarjeta->pdf_actual;
            }

            $tarjeta->sincronizar($_POST);
            $alertas = $tarjeta->validar();

            if (empty($alertas)) {
                if (isset($nombreArchivo)) {
                    // Mover el archivo a la carpeta
                    $pdf = $_FILES['subir_archivo_circulacion']['tmp_name'];
                    $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;

                    if (move_uploaded_file($pdf, $rutaDestino)) {
                        // El archivo ha sido subido correctamente
                    }
                }
                $resultado = $tarjeta->guardar();

                if ($resultado) {
                    header('Location:/tarjetas-circulacion?alert=success&action=update');
                }
            }
        }
        
        $router->render('tarjeta-circulacion/actualizar-caja', [
            
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Agregar Tarjeta de Circulación de Remolque',
            'alertas' => $alertas,
            'actualizando' => true,
            'tarjeta' => $tarjeta

        ]);
    }
    public static function eliminar() {
        if (!is_auth()) {
            header('Location: /');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $tarjeta = TarjetaCirculacion::find($id);

            if (!$tarjeta) {
                header('Location: /verif-fisico');
            }

            // Obtener el archivo PDF asociado
            $pdfArchivo = $tarjeta->subir_archivo_circulacion;
            $carpetaPDF = '../public/build/pdf/tarjetas-circulacion';

            // Eliminar el archivo PDF del servidor si existe
            if (!empty($pdfArchivo) && file_exists($carpetaPDF . '/' . $pdfArchivo)) {
                unlink($carpetaPDF . '/' . $pdfArchivo); // Eliminar el archivo del servidor
            }

            // Eliminar la póliza de la base de datos
            $resultado = $tarjeta->eliminar();
            if ($resultado) {
                header('Location: /tarjetas-circulacion?alert=success&action=delete');
            }
        }
    }   
}