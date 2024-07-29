<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)

    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarInstrucciones() {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '708da5b85c715f';
        $mail->Password = '809715d4523f4a';
        
        $mail->setFrom('cuentas@mudanzasamado.mx');
        $mail->addAddress('cuentas@mudanzasamado.mx', 'Sistema de Gestión de Archivos');
        $mail->Subject = 'Reestablece tu Password';

        //Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong>. Has solicitado restablecer tu password, da click en el siguiente enlace para hacerlo. </p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=". $this->token ."'> Reestablecer password</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta puedes ignorar el mensaje</p>";
        $contenido .= "<p>Este correo fue enviado desde un sistemas automático de correos, NO CONTESTAR, esta dirección de correo no es administrada por una personas</p>";
        $contenido .= "</html> ";

        $mail->Body = $contenido;

        $mail->send();

       

    }
}

