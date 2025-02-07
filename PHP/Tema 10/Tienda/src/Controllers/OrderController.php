<?php

namespace Controllers;

use Lib\Pages;
use Lib\Mail;
use Models\Order;
use Models\OrderLine;
use Lib\Utils;
use Services\OrderService;
use Services\OrderLineService;
use Services\ProductService;
use Services\PayPalService;



/**
 * Clase para controlar los pedidos
 */
class OrderController {

    /**
     * Variables que se usan en los pedidos
     */
    private Pages $pages;
    private Mail $mail;
    private Utils $utils;
    private OrderService $orderService;
    private OrderLineService $orderLineService;
    private ProductService $productService;
    private PayPalService $paypalService;

    
    /**
     * Constructor para inicializar las variables
     */
    public function __construct() {
        $this->pages = new Pages();
        $this->mail = new Mail();
        $this->utils = new Utils();
        $this->orderService = new OrderService();
        $this->orderLineService = new OrderLineService();
        $this->productService = new ProductService();
        $this->paypalService = new PayPalService();
    }

    /**
     * Metodo que comprueba si esta logueado antes de confirmar
     * los pedidos
     * @return void
     */
    public function authOrder(){
        if(isset($_SESSION['usuario'])){
            $this->saveOrder();
        }
        else{
            $this->pages->render('User/iniciaSesionOrder');
        }

    }

    /**
     * Metodo que guarda un pedido pidiendo los datos de localizacion,
     * actualizando el stock tras guardar el pedido y sus lineas y enviando
     * un correo para con los datos del pedido
     * @return void
     */
    public function saveOrder(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){

            $this->pages->render('Order/formOrder');
        }

        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            

            
            $order = new Order(
                null,                        
                0,                            
                $_POST['provincia'],          
                $_POST['localidad'],          
                $_POST['direccion'],          
                0.0,                          
                '',                           
                '',                           
                ''                           
            );

                // Sanitizar datos
                $order->sanitizarDatos();

                // Validar datos
                $errores = $order->validarDatos();

                if (empty($errores)) {
                    
                    $orderData = [
                        'usuario_id' => $_SESSION['usuario']['id'],
                        'provincia' => $order->getProvincia(),
                        'localidad' => $order->getLocalidad(),
                        'direccion' => $order->getDireccion(),
                        'coste' => $_SESSION['totalCost'],
                        'estado' => 'confirmado',
                        'fecha' => (new \DateTime())->format('Y-m-d'),
                        'hora' => (new \DateTime())->format('H:i:s'),
                    ];
                    //die("No hay errores");
                    
                    $totalAmount = $_SESSION['totalCost']; 
                    $currency = 'EUR'; 
                    $description = 'Pedido en Fake Web Storage'; 
                    $returnUrl = BASE_URL . 'order/paymentSuccess';
                    $cancelUrl = BASE_URL . 'order/paymentCancel'; 

                    $paypalUrl = $this->paypalService->createPayment($totalAmount, $currency, $description, $returnUrl, $cancelUrl);
                    if ($paypalUrl) {
                        header("Location: " . $paypalUrl);
                    } 
                    else {
                        $errores['payment'] = 'No se pudo procesar el pago. Intenta nuevamente.';
                        $this->pages->render('Order/formOrder', ["errores" => $errores]);
                        return; 
                    }

                    $resultado = $this->orderService->saveOrder($orderData);
                    

                    if ($resultado === true) {
                        $stock = $this->productService->updateStockProduct();
                        if($stock === true){
                            $order = $this->orderService->selectOrder();
                            $this->mail->sendMail($order);
                            $_SESSION['order'] = true;
                            unset($_SESSION['carrito']);
                            unset($_SESSION['totalCost']);
                            unset($_SESSION['orderID']);
                            $this->pages->render('Order/formOrder');
                            exit;
                        }
                        else{
                            $errores['db'] = "Error al actualizar el stock" . $stock;
                            $this->pages->render('Order/formOrder', ["errores" => $errores]);
                        }
                    } 
                    else {
                        $errores['db'] = "Error al guardar el pedido: " . $resultado;
                        $this->pages->render('Order/formOrder', ["errores" => $errores]);
                    }
                } 
                else {
                    $this->pages->render('Order/formOrder', ["errores" => $errores]);
                }
                    
            
        }
    }

   /**
    * Metodo que renderiza la vista con los pedidos, sus lineas y los productos
    * de cada linea de pedido
    * @return void
    */
    public function seeOrders() {

        if(!$this->utils->isSession()){
            header("Location: " . BASE_URL ."");
        }
        else{

            $orders = $this->orderService->seeOrders();
            $ordersLine = [];
            $products = []; 
            foreach ($orders as $order) {
                $ordersLineIndividual = $this->orderLineService->seeOrdersLine($order['id']);
    
                foreach ($ordersLineIndividual as $line) {
                    $product = $this->productService->detailProduct($line['producto_id']);
    
                    if (!empty($product) && $product[0]['id'] == $line['producto_id']) {
                        $products[$line['producto_id']] = $product[0]['nombre'];
                    }
                }
    
                $ordersLine[] = $ordersLineIndividual;
            }
    
            $_SESSION['productsOrders'] = $products;
    
            //die(var_dump($_SESSION['productsOrders']));
    
            $this->pages->render('Order/orders', [
                'orders' => $orders,
                'ordersLine' => $ordersLine,
                // 'products' => $products  
            ]);
        }
    }

    /**
    * Metodo que renderiza la vista con los pedidos, sus lineas y los productos
    * de cada linea de pedido
    * @return void
    */
    public function seeAllOrders() {

        if(!$this->utils->isSession() && !$this->utils->isAdmin()){
            header("Location: " . BASE_URL ."");
        }
        else{
            if ($this->utils->isAdmin()){
                $admin = true;
            }
            else{
                $admin = false;
            }

            $orders = $this->orderService->seeAllOrders();
            $ordersLine = [];
            $products = []; 
            foreach ($orders as $order) {
                $ordersLineIndividual = $this->orderLineService->seeOrdersLine($order['id']);
    
                foreach ($ordersLineIndividual as $line) {
                    $product = $this->productService->detailProduct($line['producto_id']);
    
                    if (!empty($product) && $product[0]['id'] == $line['producto_id']) {
                        $products[$line['producto_id']] = $product[0]['nombre'];
                    }
                }
    
                $ordersLine[] = $ordersLineIndividual;
            }
    
            $_SESSION['productsOrders'] = $products;
    
            //die(var_dump($_SESSION['productsOrders']));
    
            $this->pages->render('Order/orders', [
                'orders' => $orders,
                'ordersLine' => $ordersLine,
                'admin' => $admin
                // 'products' => $products  
            ]);
        }
    }

    public function updateStateOrder(int $id){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){

            $this->pages->render('Order/formUpdateOrder', ["idPedido" => $id]);
        }

        else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $order = new Order(
                null,                        
                0,                            
                '',          
                '',          
                '',          
                0.0,                          
                $_POST['orderState'],                           
                '',                           
                ''                           
            );

                // Sanitizar datos
                $order->sanitizarDatosActualizado();

                // Validar datos
                $errores = $order->validarDatosActualizado();

                if (empty($errores)) {
                    
                    $orderData = [
                        'estado' => $order->getEstado(),
                    ];
                    //die("No hay errores");
                    
                    $resultado = $this->orderService->updateOrder($orderData, $id);
                    

                    if ($resultado === true) {
                        $_SESSION['actualizado'] = true;
                        $this->pages->render('Order/formUpdateOrder');
                        exit;
                    } 
                    else {
                        $errores['db'] = "Error al actualizar el pedido: " . $resultado;
                        $this->pages->render('Order/formUpdateOrder', ["errores" => $errores]);
                    }
                } 
                else {
                    $this->pages->render('Order/formUpdateOrder', ["errores" => $errores]);
                }
        }

    }
    
    
    
    public function paymentCancel() {
        $this->pages->render('Order/paymentCancel');
    }
    
    public function paymentSuccess() {
        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];
    
        $paymentExecuted = $this->paypalService->executePayment($paymentId, $payerId);
    
        if ($paymentExecuted) {
            return true;
        } else {
            // Si el pago no fue exitoso
            $errores['payment'] = 'El pago no se completó correctamente.';
            $this->pages->render('Order/formOrder', ["errores" => $errores]);
        }
    }
    




}
