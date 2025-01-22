<?php 

namespace Lib;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Clase utilizada para mandar emails usando
 * la libreria de PHPMailer
 */
class Email {

    public $email;
    public $nombre;
    public $token;

    
    /**
     * Metodo que manda el email al correo para confirmar el registro
     * @return void
     */
    public function confirmacionCuenta(string $email, string $nombre, string $token)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST']; 
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERNAME']; 
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = $_ENV['SMTPSECURE'];
            $mail->Port = $_ENV['SMTP_PORT'];

        $mail->setFrom($_ENV['SMTP_USERNAME'], "Fake Web Storage");
        $mail->addAddress($email);
        $mail->Subject = 'Confirma tu Cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola ". $nombre . "</strong> Has Creado tu cuenta en Fake Web Storage, solo debes confirmarla presionando en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . BASE_URL . "User/token?token=" . $token . "'>Confirmar cuenta</a>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        $mail->send();
            return true;
        } catch(Exception $e){
            error_log("Error al enviar el correo: " . $e->getMessage());
            return false;
        }
    }


}