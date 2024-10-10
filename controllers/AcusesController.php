<?php

namespace Controllers;

use Model\Caja;
use MVC\Router;
use Model\Acuses;
use Model\Unidad;
use Model\AcusesCaja;
use Model\AcusesUnidad;

class AcusesController {
    public static function index(Router $router) {
        if(!is_auth()){
            header('Location: /');
        }
        $mostrarLayout = true;

        $acuses = Acuses::all();
        foreach($acuses as $acuse) {
            $acuse->unidad = Unidad::find(($acuse->id_unidad));
            $acuse->caja = Caja::find(($acuse->id_caja));

            $acuse->economico = $acuse->unidad->no_unidad ?? $acuse->caja->numero_caja ?? '';
            $acuse->placas = $acuse->unidad->u_placas ?? $acuse->caja->c_placas ?? '';
            
            if($acuse->unidad) {
                $acuse->url_detalle = "/acuses/actualizarUnidad?id=" . $acuse->id;
            } else if ($acuse->caja) {
                $acuse->url_detalle = "/acuses/actualizarCaja?id=" . $acuse->id;
            }

        }

        $router->render('acuses/index', [
            'titulo' => 'Acuses de Entrega de Documentos',
            'mostrarLayout' => $mostrarLayout,
            'acuses' => $acuses
        ]);
    }

    public static function crearUnidad(Router $router) {
        $mostrarLayout = true;
        $alertas = [];
        $acuse = new AcusesUnidad;
    
        // Obtener las unidades que aún no tienen acuses registrados
        $consulta = 'SELECT u.id, u.no_unidad FROM unidades u LEFT JOIN acuses_unidades a ON u.id = a.id_unidad WHERE a.id_unidad IS NULL';
        $unidades = Unidad::SQL($consulta);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('Location: /');
            }
    
            // Manejar la subida de los archivos PDF
            $_POST['archivo_poliza_acuse'] = manejarSubidaArchivo('acuses','archivo_poliza_acuse');
            $_POST['archivo_tarcirc_acuse'] = manejarSubidaArchivo('acuses','archivo_tarcirc_acuse');
            $_POST['archivo_veriambiental_acuse'] = manejarSubidaArchivo('acuses','archivo_veriambiental_acuse');
            $_POST['archivo_verifisico_acuse'] = manejarSubidaArchivo('acuses','archivo_verifisico_acuse');
    
            // Sincronizar datos con el objeto AcusesUnidad
            $acuse->sincronizar($_POST);
    
            // Validar los datos
            $alertas = $acuse->validar();
    
            // Guardar en la base de datos si no hay alertas
            if (empty($alertas)) {
                $resultado = $acuse->guardar();
                if ($resultado) {
                    header('Location: /acuses?alert=success&action=create');
                }
            }
        }
    
        // Renderizar la vista
        $router->render('acuses/crear-unidad', [
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Agregar Acuses de Unidad',
            'alertas' => $alertas,
            'actualizando' => false,
            'acuse' => $acuse,
            'unidades' => $unidades
        ]);
    }
    
    public static function crearCaja(Router $router) {
        $mostrarLayout = true;
        $alertas = [];
        $acuse = new AcusesCaja;
        $consulta = 'SELECT u.id, u.numero_caja FROM cajas u LEFT JOIN acuses_unidades a ON u.id = a.id_caja WHERE a.id_caja IS NULL';
        $cajas = Caja::SQL($consulta);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('Location: /');
            }
    
            // Manejar la subida de los archivos PDF
            $_POST['archivo_poliza_acuse'] = manejarSubidaArchivo('acuses','archivo_poliza_acuse');
            $_POST['archivo_tarcirc_acuse'] = manejarSubidaArchivo('acuses','archivo_tarcirc_acuse');
            $_POST['archivo_veriambiental_acuse'] = manejarSubidaArchivo('acuses','archivo_veriambiental_acuse');
            $_POST['archivo_verifisico_acuse'] = manejarSubidaArchivo('acuses','archivo_verifisico_acuse');
    
            // Sincronizar datos con el objeto AcusesUnidad
            $acuse->sincronizar($_POST);
    
            // Validar los datos
            $alertas = $acuse->validar();
    
            // Guardar en la base de datos si no hay alertas
            if (empty($alertas)) {
                $resultado = $acuse->guardar();
                if ($resultado) {
                    header('Location: /acuses?alert=success&action=create');
                }
            }
        }
    
        // Renderizar la vista
        $router->render('acuses/crear-caja', [
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Agregar Acuses del Remolque',
            'alertas' => $alertas,
            'actualizando' => false,
            'acuse' => $acuse,
            'cajas' => $cajas
        ]);
    }

    //-------------------------------- ACTUALIZAR -----------------------------------------
    public static function actualizarUnidad(Router $router) {
        $mostrarLayout = true;
        $alertas = [];
    
        $id = validarORedireccionar('/acuses');

    
        $acuse = AcusesUnidad::find($id);
        if (!$acuse) {
            header('Location: /acuses');
        }
    
        $acuse->unidad = Unidad::find($acuse->id_unidad);
    
        // Archivos PDF actuales
        $pdfsAnteriores = [
            'archivo_poliza_acuse' => $acuse->archivo_poliza_acuse,
            'archivo_tarcirc_acuse' => $acuse->archivo_tarcirc_acuse,
            'archivo_veriambiental_acuse' => $acuse->archivo_veriambiental_acuse,
            'archivo_verifisico_acuse' => $acuse->archivo_verifisico_acuse
        ];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Actualizar los archivos PDF y asignar a $_POST
            $_POST['archivo_poliza_acuse'] = manejarSubidaArchivo('acuses','archivo_poliza_acuse', $pdfsAnteriores['archivo_poliza_acuse']);
            $_POST['archivo_tarcirc_acuse'] = manejarSubidaArchivo('acuses','archivo_tarcirc_acuse', $pdfsAnteriores['archivo_tarcirc_acuse']);
            $_POST['archivo_veriambiental_acuse'] = manejarSubidaArchivo('acuses','archivo_veriambiental_acuse', $pdfsAnteriores['archivo_veriambiental_acuse']);
            $_POST['archivo_verifisico_acuse'] = manejarSubidaArchivo('acuses','archivo_verifisico_acuse', $pdfsAnteriores['archivo_verifisico_acuse']);
    
            // Sincronizar los cambios
            $acuse->sincronizar($_POST);
            $alertas = $acuse->validar();
    
            if (empty($alertas)) {
                $resultado = $acuse->guardar();
                if ($resultado) {
                    header('Location: /acuses?alert=success&action=update');
                }
            }
        }
    
        $router->render('acuses/actualizar-unidad', [
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Actualizar Acuses de Unidad',
            'alertas' => $alertas,
            'actualizando' => true,
            'acuse' => $acuse
        ]);
    }  
    
    public static function actualizarCaja(Router $router) {
        $mostrarLayout = true;
        $alertas = [];
    
        $id = validarORedireccionar('/acuses');
    
        $acuse = AcusesCaja::find($id);
        if (!$acuse) {
            header('Location: /acuses');
        }
    
        $acuse->caja = Caja::find($acuse->id_caja);
    
        // Archivos PDF actuales
        $pdfsAnteriores = [
            'archivo_poliza_acuse' => $acuse->archivo_poliza_acuse,
            'archivo_tarcirc_acuse' => $acuse->archivo_tarcirc_acuse,
            'archivo_veriambiental_acuse' => $acuse->archivo_veriambiental_acuse,
            'archivo_verifisico_acuse' => $acuse->archivo_verifisico_acuse
        ];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Actualizar los archivos PDF y asignar a $_POST
            $_POST['archivo_poliza_acuse'] = manejarSubidaArchivo('acuses','archivo_poliza_acuse', $pdfsAnteriores['archivo_poliza_acuse']);
            $_POST['archivo_tarcirc_acuse'] = manejarSubidaArchivo('acuses','archivo_tarcirc_acuse', $pdfsAnteriores['archivo_tarcirc_acuse']);
            $_POST['archivo_veriambiental_acuse'] = manejarSubidaArchivo('acuses','archivo_veriambiental_acuse', $pdfsAnteriores['archivo_veriambiental_acuse']);
            $_POST['archivo_verifisico_acuse'] = manejarSubidaArchivo('acuses','archivo_verifisico_acuse', $pdfsAnteriores['archivo_verifisico_acuse']);
    
            // Sincronizar los cambios
            $acuse->sincronizar($_POST);
            $alertas = $acuse->validar();
    
            if (empty($alertas)) {
                $resultado = $acuse->guardar();
                if ($resultado) {
                    header('Location: /acuses?alert=success&action=update');
                }
            }
        }
    
        $router->render('acuses/actualizar-caja', [
            'mostrarLayout' => $mostrarLayout,
            'titulo' => 'Actualizar Acuses del Remolque',
            'alertas' => $alertas,
            'actualizando' => true,
            'acuse' => $acuse
        ]);
    }

    public static function eliminar() {
        if (!is_auth()) {
            header('Location: /');
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $acuse = Acuses::find($id);
    
            if (!$acuse) {
                header('Location: /acuses');
            }
    
            // Lista de archivos PDF a eliminar
            $pdfs = [
                'archivo_poliza_acuse',
                'archivo_tarcirc_acuse',
                'archivo_veriambiental_acuse',
                'archivo_verifisico_acuse'
            ];
    
            $carpetaPDF = '../public/build/pdf/acuses';
    
            // Eliminar los archivos PDF del servidor
            foreach ($pdfs as $pdf) {
                $pdfArchivo = $acuse->$pdf; // Obtener el valor del archivo
                if (!empty($pdfArchivo) && file_exists($carpetaPDF . '/' . $pdfArchivo)) {
                    unlink($carpetaPDF . '/' . $pdfArchivo); // Eliminar el archivo si existe
                }
            }
    
            // Eliminar el registro de la base de datos
            $resultado = $acuse->eliminar();
            if ($resultado) {
                header('Location: /acuses?alert=success&action=delete');
            }
        }
    }
}


