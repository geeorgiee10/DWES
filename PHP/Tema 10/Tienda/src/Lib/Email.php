<?php 

namespace Lib;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Clase que manda un correo usando
 * la libreria de PHPMailer
 */
class Email {

    public $email;
    public $nombre;
    public $token;

    
    /**
     * Metodo que manda el email al correo para confirmar el registro del usuario
     * @var string correo al que mandar el correo
     * @var string con el nombre del usuario
     * @var string con el token que confirmar
     * @return void
     */
    public function confirmacionCuenta(string $email, string $nombre, string $token)
    {
        header("Authorization: Bearer {$token}");

        //die(var_dump(getallheaders()));


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
        $mail->Subject = 'Confirmar tu Cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Buenos días ". $nombre . "</strong> te has registrado en Fake Web Storage, lo unico que te queda es confirmarlo con el siguiente enlace</p>";
        $contenido .= "<p>Haz click aquí: <a href='" . BASE_URL . "User/token?token=" . $token . "'>Confirmar cuenta</a>";
        $contenido .= "<p>Si no te has registrado con nosotros, ignore este mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        $mail->send();
            return true;
        } catch(Exception $e){
            error_log("Error al enviar el correo: " . $e->getMessage());
            return false;
        }
    }


    /**
     * Metodo que manda el email al correo para recuperar la contraseña del usuario
     * @var string correo al que mandar el correo
     * @var string con el nombre del usuario
     * @var string con el token que confirmar
     * @return void
     */
    public function recuperarContrasela(string $email, string $nombre, string $token)
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
        $mail->Subject = 'Recuperar contraseña';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Buenos días ". $nombre . "</strong> has olvidado tu contraseña de Fake Web Storage, lo unico que tienes que haces es darle al siguiente enlace</p>";
        $contenido .= "<p>Haz click aquí: <a href='" . BASE_URL . "User/changePassword?token=" . $token . "'>Recuperar Contraseña</a>";
        $contenido .= "<p>Si no has pedido este cambio, ignore este mensaje</p>";
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