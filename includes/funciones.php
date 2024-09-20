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


// Función para verificar si se ha enviado un correo recientemente (en las últimas 24 horas)
function correoEnviadoRecientemente($id_poliza, $ruta_archivo) {
    // Verificamos si el archivo existe
    if (file_exists($ruta_archivo)) {
        $lineas = file($ruta_archivo);
        if ($lineas === false) {
            error_log("Error al leer el archivo $ruta_archivo");
            return false;
        }

        foreach ($lineas as $linea) {
            $datos = explode(',', trim($linea)); // Separar por comas y quitar espacios en blanco
            // Comprobamos si el ID de la póliza coincide y si el correo fue enviado en las últimas 24 horas
            if ($datos[0] == $id_poliza && (time() - strtotime($datos[1])) < 24 * 60 * 60) {
                return true;
            }
        }
    }
    return false;
}

// Función para registrar el envío del correo en el archivo
function registrarCorreoEnviado($id_poliza, $ruta_archivo) {
    $fechaEnvio = date('Y-m-d H:i:s'); // Fecha y hora actual
    $registro = $id_poliza . ',' . $fechaEnvio . PHP_EOL;
    
    if (file_put_contents($ruta_archivo, $registro, FILE_APPEND) === false) {
        error_log("Error al escribir en el archivo $ruta_archivo");
    }
}



