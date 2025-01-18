<?php 

namespace Lib;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Clase utilizada para mandar emails usando
 * la libreria de PHPMailer
 */
class Mail {
    
    /**
     * Metodo que manda el email al correo del usuario logueado
     * @var array Recibe los datos del pedido a mandar por correo
     * @return void
     */
    public function sendMail(array $order){

        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST']; 
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERNAME']; 
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = $_ENV['SMTPSECURE'];
            $mail->Port = $_ENV['SMTP_PORT'];




            $mail->setFrom($_ENV['SMTP_USERNAME'], 'Fake Web Store');
            $mail->addAddress($_SESSION['usuario']['email'], $_SESSION['usuario']['nombre']); 

            $mail->Subject = 'Datos del pedido';
            
            $contenido = $this->generateMail($order);
            $mail->isHTML(true);
            $mail->Body = $contenido;

            // Enviar el correo
            $mail->send();
            return true;
        }
        catch(Exception $e){
            error_log("Error al enviar el correo: " . $e->getMessage());
            return false;
        }

    }

    /**
     * Metodo que genera el contenido del correo a mandar
     * @var array Recibe una array con los datos del pedido
     * @return void
     */
    function generateMail(array $order){
        

        $contenido = "<h1>Pedido realizado a nombre de " . $_SESSION['usuario']['nombre'] .  "</h1>";
        $contenido .= "<h1>Datos de su pedido con el numero " .  $order[0]['id'] .":</h1>";
        $contenido .= "<table border='1'>";
        $contenido .= "<tr><th>Producto</th><th>Cantidad</th><th>Precio</th></tr>";

        // Recorremos el carrito y agregamos los productos al cuerpo del correo
        foreach ($_SESSION['carrito'] as $product) {
            $contenido .= "<tr>
                            <td>" . $product['nombre'] . "</td>
                            <td>" . $product['cantidad'] . "</td>
                            <td>" . $product['precio'] . "</td>
                        </tr>";
        }

        $total = $_SESSION['totalCost'];
        $contenido .= "</table>";
        $contenido .= "<p><strong>Estado: " . $order[0]['estado'] ." </strong></p>";
        $contenido .= "<p><strong>Total: {$total}</strong></p>";

        return $contenido;

    }


}