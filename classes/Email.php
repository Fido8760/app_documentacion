<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    public $economico;

    public function __construct($email = '', $nombre = '', $token = '', $economico = '')

    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
        $this->economico = $economico;
        
    }

    public function datosEmail() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->SMTPSecure = 'ssl';
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        return $mail;
    }

    public function enviarInstrucciones() {

        $mail = $this->datosEmail();
        
        $mail->setFrom('alertas@mudanzasamado.mx', 'Sistema de Gestión de Archivos Amado');
        $mail->addAddress($this->email);
        $mail->Subject = 'Reestablece tu Password';

        //Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong>. Has solicitado restablecer tu password, da click en el siguiente enlace para hacerlo. </p>";
        $contenido .= "<p>Presiona aquí: <a href='". $_ENV['APP_URL'] ."/recuperar?token=". $this->token ."'> Reestablecer password</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta puedes ignorar el mensaje</p>";
        $contenido .= "<p>Este correo fue enviado desde un sistemas automático de correos, NO CONTESTAR, esta dirección de correo no es administrada por una personas</p>";
        $contenido .= "</html> ";

        $mail->Body = $contenido;
        $mail->send();
        $mail->clearAddresses();

    }

    public function notificacionEmailPorVencer($vigencia, $economico, $placas) {
        $mail = $this->datosEmail();

        $usuarios = ['soporte@mudanzasamado.mx', 'magnum.avila@mudanzasamado.mx'];

        foreach($usuarios as $usuario) {

            $mail->setFrom('alertas@mudanzasamado.mx', 'Sistema de Gestión de Archivos Amado');
            $mail->addAddress($usuario);
            $mail->Subject = 'Póliza Por Vencer';

            //Set HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $contenido = "<html>";
            $contenido .= "<p>Está por vencerse la póliza del económico <strong>" . $economico . "</strong>. Con placas <strong>" . $placas . "</strong> </p>";
            $contenido .= "<p>Vence el <strong>" . $vigencia . "</strong>. Se debe tramitar al renovación de la póliza con la aseguradora. </p>";
            $contenido .= "<p>Presiona aquí para: <a href='". $_ENV['APP_URL'] ."'>Actualizar Póliza</a> una vez renovada.</p>";
            $contenido .= "<br><p>Solicita el archivo PDF actualizado para poder actualizar la póliza</p>";
            $contenido .= "<br><p>Este correo fue enviado desde un sistemas automático de correos, NO CONTESTAR, esta dirección de correo no es administrada por una persona</p>";
            $contenido .= "</html> ";

            $mail->Body = $contenido;
            $mail->send();

            $mail->clearAddresses();
        }
    }

    public function notificacionEmailVencido($vigencia, $economico, $placas) {
        $mail = $this->datosEmail();

        $usuarios = ['soporte@mudanzasamado.mx', 'magnum.avila@mudanzasamado.mx'];

        foreach($usuarios as $usuario) {
        
            $mail->setFrom('alertas@mudanzasamado.mx', 'Sistema de Gestión de Archivos Amado');
            $mail->addAddress($usuario);
            $mail->Subject = 'Póliza Vencida';

            //Set HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $contenido = "<html>";
            $contenido .= "<p>Se ha vencido la póliza del económico <strong>" . $economico . "</strong>. Con placas <strong>" . $placas . "</strong> </p>";
            $contenido .= "<p>Se ha vencido el <strong>" . $vigencia . "</strong>. Se debe actualizar la póliza ahora mismo. </p>";
            $contenido .= "<p>Presiona aquí para: <a href='". $_ENV['APP_URL'] ."'>Actualizar Póliza</a></p>";
            $contenido .= "<br><p>Solicita el archivo PDF actualizado para poder actualizar la póliza</p>";
            $contenido .= "<br><p>Este correo fue enviado desde un sistemas automático de correos, NO CONTESTAR, esta dirección de correo no es administrada por una persona</p>";
            $contenido .= "</html> ";

            $mail->Body = $contenido;
            $mail->send();

            $mail->clearAddresses();
        }
    }

    //---------------------------------- Notificacion Licencia --------------------------------------------

    public function notificacionEmailLicenciaPorVencer($vigencia, $nombre) {
        $mail = $this->datosEmail();

        $usuarios = ['reclutamientorh@mudanzasamado.mx', 'nominasrh@mudanzasamado.mx'];

        foreach($usuarios as $usuario) {
        
            $mail->setFrom('alertas@mudanzasamado.mx', 'Sistema de Gestión de Archivos Amado');
            $mail->addAddress($usuario);
            $mail->Subject = 'Licencia Por Vencer';

            //Set HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $contenido = "<html>";
            $contenido .= "<p>Está por vencerse la licencia del Operador <strong>" . $nombre . "</strong>.";
            $contenido .= "<p>Vence el <strong>" . $vigencia . "</strong>. Se debe solicitar la renovacion de la licencia con el Operador. </p>";
            $contenido .= "<p>Presiona aquí para: <a href='". $_ENV['APP_URL'] ."'>Actualizar Licencia de Operador</a> una vez hecho el trámite.</p>";
            $contenido .= "<br><p>Solicita el archivo PDF actualizado para poder actualizar la licencia</p>";
            $contenido .= "<br><p>Este correo fue enviado desde un sistemas automático de correos, NO CONTESTAR, esta dirección de correo no es administrada por una persona</p>";
            $contenido .= "</html> ";

            $mail->Body = $contenido;
            $mail->send();

            $mail->clearAddresses();
        }
    }

    public function notificacionEmailLicenciaVencido($vigencia, $nombre) {
        $mail = $this->datosEmail();

        $usuarios = ['reclutamientorh@mudanzasamado.mx', 'nominasrh@mudanzasamado.mx'];

        foreach($usuarios as $usuario) {
        
            $mail->setFrom('alertas@mudanzasamado.mx', 'Sistema de Gestión de Archivos Amado');
            $mail->addAddress($usuario);
            $mail->Subject = 'Licencia Vencida';

            //Set HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $contenido = "<html>";
            $contenido .= "<p>Se ha VENCIDO la licencia del Operador <strong>" . $nombre . "</strong>.";
            $contenido .= "<p>Venció el <strong>" . $vigencia . "</strong>. El Operador NO puede ser asignado a viaje, hasta que se renueve la licencia. </p>";
            $contenido .= "<p>Presiona aquí para: <a href='". $_ENV['APP_URL'] ."'>Actualizar Licencia de Operador</a> una vez hecho el trámite.</p>";
            $contenido .= "<br><p>Solicita el archivo PDF actualizado para poder actualizar la licencia</p>";
            $contenido .= "<br><p>Este correo fue enviado desde un sistemas automático de correos, NO CONTESTAR, esta dirección de correo no es administrada por una persona</p>";
            $contenido .= "</html> ";

            $mail->Body = $contenido;
            $mail->send();
            $mail->clearAddresses();
        }
    }

     //---------------------------------- Notificacion APTO --------------------------------------------

     public function notificacionEmailAptoPorVencer($vigencia, $nombre) {
        $mail = $this->datosEmail();
        $usuarios = ['reclutamientorh@mudanzasamado.mx', 'nominasrh@mudanzasamado.mx'];

        foreach($usuarios as $usuario) {
        
            $mail->setFrom('alertas@mudanzasamado.mx', 'Sistema de Gestión de Archivos Amado');
            $mail->addAddress($usuario);
            $mail->Subject = 'Apto Médico Por Vencer';

            //Set HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $contenido = "<html>";
            $contenido .= "<p>Estimado/a,</p>";
            $contenido .= "<p>El <strong>APTO MÉDICO</strong> del Operador <strong>" . $nombre . "</strong> está próximo a vencer.</p>";
            $contenido .= "<p>La fecha de vencimiento es el <strong>" . $vigencia . "</strong>. Por favor, solicita la renovación del apto médico del Operador a la brevedad.</p>";
            $contenido .= "<p>Haz clic aquí para: <a href='". $_ENV['APP_URL'] ."'>Actualizar el Apto Médico del Operador</a> una vez completado el trámite.</p>";
            $contenido .= "<br><p>Recuerda solicitar el archivo PDF actualizado para proceder con la actualización.</p>";
            $contenido .= "<br><p>Este correo ha sido enviado automáticamente, por favor no respondas. Esta dirección de correo no es monitoreada.</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;
            $mail->send();
            $mail->clearAddresses();
        }
    }

    public function notificacionEmailAptoVencido($vigencia, $nombre) {
        $mail = $this->datosEmail();

        $usuarios = ['reclutamientorh@mudanzasamado.mx', 'nominasrh@mudanzasamado.mx'];

        foreach($usuarios as $usuario) {
            
            $mail->setFrom('alertas@mudanzasamado.mx', 'Sistema de Gestión de Archivos Amado');
            $mail->addAddress($usuario);
            $mail->Subject = 'Apto Médico Vencido';

            //Set HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $contenido = "<html>";
            $contenido .= "<p>Estimado/a,</p>";
            $contenido .= "<p>El <strong>APTO MÉDICO</strong> del Operador <strong>" . $nombre . "</strong> se ha VENCIDO.</p>";
            $contenido .= "<p>La fecha de vencimiento fue el <strong>" . $vigencia . "</strong>. El operador no puede ser asigando a viaje, hasta que obtenga su Apto Renovado.</p>";
            $contenido .= "<p>Haz clic aquí para: <a href='". $_ENV['APP_URL'] ."'>Actualizar el Apto Médico del Operador</a> una vez completado el trámite.</p>";
            $contenido .= "<br><p>Recuerda solicitar el archivo PDF actualizado para proceder con la actualización.</p>";
            $contenido .= "<br><p>Este correo ha sido enviado automáticamente, por favor no respondas. Esta dirección de correo no es monitoreada.</p>";
            $contenido .= "</html>";


            $mail->Body = $contenido;
            $mail->send();

            $mail->clearAddresses();
        }
    }
}

