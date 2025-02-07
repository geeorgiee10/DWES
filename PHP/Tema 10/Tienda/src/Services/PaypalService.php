<?php 


namespace Services;

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;

class PayPalService {

    private $apiContext;

    public function __construct() {
        // Configuración de PayPal
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $_ENV['PAYPAL_CLIENT_ID'],     
                $_ENV['PAYPAL_SECRET']         
            )
        );

        $this->apiContext->setConfig([
                'mode' => $_ENV['PAYPAL_API_URL'], // Cambia a 'live' cuando estés listo para producción
        ]);
    }

 
    public function createPayment($totalAmount, $currency, $description, $returnUrl, $cancelUrl) {
        // Crear un objeto Payer
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Crear el monto total a pagar
        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($totalAmount); // Monto total

        // Crear la transacción
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription($description);

        // URLs de redirección
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($returnUrl)
            ->setCancelUrl($cancelUrl);

        // Crear el objeto Payment
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            // Crear el pago
            $payment->create($this->apiContext);

            // Redirigir al usuario a la URL de PayPal
            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    return $link->getHref(); // URL de redirección de PayPal
                }
            }
        } catch (PayPalConnectionException $e) {
            // Log de error o manejo de excepciones
            error_log("Error al crear el pago: " . $e->getData());
            return null;
        }
    }

    
    public function executePayment($paymentId, $payerId) {
        try {
            $payment = Payment::get($paymentId, $this->apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            // Ejecutar el pago
            $result = $payment->execute($execution, $this->apiContext);

            return true; // El pago fue exitoso
        } catch (PayPalConnectionException $e) {
            // Log de error o manejo de excepciones
            error_log("Error al ejecutar el pago: " . $e->getData());
            return false;
        }
    }
}
