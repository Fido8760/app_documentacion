<?php

use Classes\Email;

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path) : bool {
    return str_contains($_SERVER['PATH_INFO'] ?? '/',$path) ? true : false;
}

function pagina_inicio($path) : bool {
    // Verifica si la ruta está contenida en la URL actual
    return str_contains($_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI'], $path);
}


function is_auth() : bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['nombre']) && !empty($_SESSION['nombre']);
}

function is_admin() : bool {
    session_start();
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

// Función para calcular el estatus genérico de póliza, licencia o apto
function calcularEstatusGenerico($fechaVigencia, $identificador, $rutaArchivo, $nombreOperador = null, $numeroUnidad = null, $placas = null, $tipo = 'poliza') {
    $hoy = new DateTime(); // Fecha actual
    
    try {
        $vigencia = new DateTime($fechaVigencia); // Fecha de vigencia
    } catch (Exception $e) {
        error_log("Error al crear la fecha: " . $e->getMessage());
        return 'Fecha inválida'; // Retornar un estado de error si la fecha no es válida
    }

    $diferenciaDias = $hoy->diff($vigencia)->days; // Diferencia en días
    $estatus = ''; // Inicializar el estado

    if ($vigencia < $hoy) {
        $estatus = 'Vencido';
        verificarYEnviarNotificacion($identificador, $rutaArchivo, $tipo, 'vencido', $fechaVigencia, $nombreOperador, $numeroUnidad, $placas);
    } elseif ($diferenciaDias <= 30) {
        $estatus = 'Por Vencer';
        verificarYEnviarNotificacion($identificador, $rutaArchivo, $tipo, 'por_vencer', $fechaVigencia, $nombreOperador, $numeroUnidad, $placas);
    } else {
        $estatus = 'Vigente';
    }

    return $estatus;
}

// Función para verificar si se ha enviado un correo y, si no, enviarlo
function verificarYEnviarNotificacion($identificador, $rutaArchivo, $tipo, $estado, $fechaVigencia, $nombreOperador = null, $numeroUnidad = null, $placas = null) {
    if (!correoEnviadoRecientemente($identificador, $rutaArchivo)) {
        enviarNotificacion($tipo, $estado, $fechaVigencia, $nombreOperador, $numeroUnidad, $placas);
        registrarCorreoEnviado($identificador, $rutaArchivo);
    }
}

// Función para enviar la notificación de correo
function enviarNotificacion($tipo, $estado, $fechaVigencia, $nombreOperador = null, $numeroUnidad = null, $placas = null) {
    $email = new Email();
    switch ($tipo) {
        case 'poliza':
            if ($estado === 'vencido') {
                $email->notificacionEmailVencido($fechaVigencia, $numeroUnidad, $placas);
            } else {
                $email->notificacionEmailPorVencer($fechaVigencia, $numeroUnidad, $placas);
            }
            break;
        case 'licencia':
            if ($estado === 'vencido') {
                $email->notificacionEmailLicenciaVencido($fechaVigencia, $nombreOperador);
            } else {
                $email->notificacionEmailLicenciaPorVencer($fechaVigencia, $nombreOperador);
            }
            break;
        case 'apto':
            if ($estado === 'vencido') {
                $email->notificacionEmailAptoVencido($fechaVigencia, $nombreOperador);
            } else {
                $email->notificacionEmailAptoPorVencer($fechaVigencia, $nombreOperador);
            }
            break;
    }
}

// Función para verificar si se ha enviado un correo recientemente (en las últimas 24 horas)
function correoEnviadoRecientemente($id, $ruta_archivo) {
    if (file_exists($ruta_archivo)) {
        $lineas = file($ruta_archivo);
        if ($lineas === false) {
            error_log("Error al leer el archivo {$ruta_archivo}");
            return false;
        }

        foreach ($lineas as $linea) {
            $datos = explode(',', trim($linea)); // Separar por comas y quitar espacios en blanco
            if (count($datos) < 2) {
                continue; // Si los datos están incompletos, ignorar la línea
            }

            if ($datos[0] == $id && (time() - strtotime($datos[1])) < 24 * 60 * 60) {
                return true;
            }
        }
    }
    return false;
}

// Función para registrar el envío del correo en el archivo
function registrarCorreoEnviado($id, $ruta_archivo) {
    $fechaEnvio = date('Y-m-d H:i:s'); // Fecha y hora actual
    $registro = $id . ',' . $fechaEnvio . PHP_EOL;

    // Intentar escribir en el archivo, loguear error si falla
    if (file_put_contents($ruta_archivo, $registro, FILE_APPEND | LOCK_EX) === false) {
        error_log("Error al escribir en el archivo $ruta_archivo");
    }
}


//actualización de archivo en acuses

function manejarSubidaArchivo($nombreCarpeta, $campo, &$pdfAnterior = null) {
    if (!empty($_FILES[$campo]['tmp_name'])) {
        $carpetaPDF = '../public/build/pdf/'.$nombreCarpeta;

        // Crear la carpeta si no existe
        if (!is_dir($carpetaPDF)) {
            mkdir($carpetaPDF, 0755, true);
        }

        // Crear un nombre único para el archivo
        $nombre_pdf = md5(uniqid(rand(), true));
        $extension = pathinfo($_FILES[$campo]['name'], PATHINFO_EXTENSION);
        $nombreArchivo = $nombre_pdf . '.' . $extension;

        // Mover el archivo subido a la carpeta de destino
        $pdf = $_FILES[$campo]['tmp_name'];
        $rutaDestino = $carpetaPDF . '/' . $nombreArchivo;
        if (move_uploaded_file($pdf, $rutaDestino)) {
            // Si se pasa un archivo anterior, eliminarlo
            if ($pdfAnterior && file_exists($carpetaPDF . '/' . $pdfAnterior)) {
                unlink($carpetaPDF . '/' . $pdfAnterior);
            }
        }

        // Devolver el nombre del archivo nuevo
        return $nombreArchivo;
    }
    // Devolver el archivo actual si no se ha subido uno nuevo
    return $pdfAnterior;
}

function validarORedireccionar($url) {
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: {$url}");
    }

    return $id;
}




