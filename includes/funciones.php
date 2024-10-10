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

//---------------------------- Estatus polizas -------------------------------
function calcularEstatus($fechaVigencia, $numeroUnidad, $placas, $id_poliza) {
    $hoy = new DateTime(); // Fecha actual
    $vigencia = new DateTime($fechaVigencia); // Fecha de vigencia de la póliza
    $ruta_archivo = __DIR__ . '/enviados.txt'; // Ruta absoluta del archivo que registra los correos enviados

    // Calcular la diferencia en días
    $diferenciaDias = $hoy->diff($vigencia)->days;

    // Inicializar la variable del estado
    $estatus = '';

    // Si la póliza ya está vencida
    if ($vigencia < $hoy) {
        $estatus = 'Vencido'; // La fecha de vigencia ya pasó

        // Verificar si el correo ha sido enviado recientemente
        if (!correoEnviadoRecientemente($id_poliza, $ruta_archivo)) {
            $email = new Email();
            $email->notificacionEmailVencido($fechaVigencia, $numeroUnidad, $placas);

            // Registrar el envío en el archivo
            registrarCorreoEnviado($id_poliza, $ruta_archivo);
        }
    }
    // Si la póliza vence en 30 días o menos
    elseif ($diferenciaDias <= 30) {
        $estatus = 'Por Vencer'; // Queda menos de un mes

        // Verificar si el correo ha sido enviado recientemente
        if (!correoEnviadoRecientemente($id_poliza, $ruta_archivo)) {
            $email = new Email();
            $email->notificacionEmailPorVencer($fechaVigencia, $numeroUnidad, $placas);

            // Registrar el envío en el archivo
            registrarCorreoEnviado($id_poliza, $ruta_archivo);
        }
    }
    // Si la póliza sigue vigente
    else {
        $estatus = 'Vigente'; // La póliza sigue siendo válida
    }

    return $estatus; // Devolver siempre el estatus
}
//---------------------------- Estatus Licencias -------------------------------
function calcularEstatusLicencia($fechaVigencia, $nombreOperador, $id_operador) {
    $hoy = new DateTime(); // Fecha actual
    $vigencia = new DateTime($fechaVigencia); // Fecha de vigencia de la póliza
    $ruta_archivo = __DIR__ . '/enviados_licencia.txt'; // Ruta absoluta del archivo que registra los correos enviados

    // Calcular la diferencia en días
    $diferenciaDias = $hoy->diff($vigencia)->days;

    // Inicializar la variable del estado
    $estatus = '';

    // Si la póliza ya está vencida
    if ($vigencia < $hoy) {
        $estatus = 'Vencido'; // La fecha de vigencia ya pasó

        // Verificar si el correo ha sido enviado recientemente
        if (!correoEnviadoRecientemente($id_operador, $ruta_archivo)) {
            $email = new Email();
            $email->notificacionEmailLicenciaVencido($fechaVigencia, $nombreOperador);

            // Registrar el envío en el archivo
            registrarCorreoEnviado($id_operador, $ruta_archivo);
        }
    }
    // Si la póliza vence en 30 días o menos
    elseif ($diferenciaDias <= 30) {
        $estatus = 'Por Vencer'; // Queda menos de un mes

        // Verificar si el correo ha sido enviado recientemente
        if (!correoEnviadoRecientemente($id_operador, $ruta_archivo)) {
            $email = new Email();
            $email->notificacionEmailLicenciaPorVencer($fechaVigencia, $nombreOperador);

            // Registrar el envío en el archivo
            registrarCorreoEnviado($id_operador, $ruta_archivo);
        }
    }
    // Si la póliza sigue vigente
    else {
        $estatus = 'Vigente'; // La póliza sigue siendo válida
    }

    return $estatus; // Devolver siempre el estatus
}


// Función para verificar si se ha enviado un correo recientemente (en las últimas 24 horas)
function correoEnviadoRecientemente($id, $ruta_archivo) {
    // Verificamos si el archivo existe
    if (file_exists($ruta_archivo)) {
        $lineas = file($ruta_archivo);
        if ($lineas === false) {
            error_log("Error al leer el archivo {$ruta_archivo}");
            return false;
        }

        foreach ($lineas as $linea) {
            $datos = explode(',', trim($linea)); // Separar por comas y quitar espacios en blanco
            // Comprobamos si el ID de la póliza coincide y si el correo fue enviado en las últimas 24 horas
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
    
    if (file_put_contents($ruta_archivo, $registro, FILE_APPEND) === false) {
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




