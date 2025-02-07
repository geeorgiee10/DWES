<?php

namespace Services;

use Models\Order;
use Repositories\OrderRepository;

/**
 * Clase que recibe los datos de OrderController
 * y se los pasa al repository
 */
class OrderService {
    /**
     * Variable para establecer la conexion el repository
     */
    private OrderRepository $repository;

    /**
     * Constructor que inicializa las variables
     */
    public function __construct() {
        $this->repository = new OrderRepository();
    }

    /**
     * Metodo que llama al repository para guardar un pedido
     * @var array con los datos del pedido a guardar
     * @return bool|string
     */
    public function saveOrder(array $orderData): bool|string {
        try {
            $order = new Order(
                null,
                $orderData['usuario_id'],
                $orderData['provincia'],
                $orderData['localidad'],
                $orderData['direccion'],
                $orderData['coste'],
                $orderData['estado'],
                $orderData['fecha'],
                $orderData['hora']
            );

            return $this->repository->saveOrder($order);
        } 
        catch (\Exception $e) {
            error_log("Error al guardar el pedido: " . $e->getMessage());
            return false;
        }
    }

    
    /**
     * Metodo que llamar al repository para ver todos los datos de un pedido
     * @return array
     */
    public function selectOrder(): array {
        return $this->repository->selectOrder();
    }

    /**
     * Metodo que llamar al repository para ver todos los pedidos
     * @return array
     */
    public function seeOrders(): array {
        return $this->repository->seeOrders();
    }

    /**
     * Metodo que llamar al repository para ver todos los pedidos
     * @return array
     */
    public function seeAllOrders(): array {
        return $this->repository->seeAllOrders();
    }

    /**
     * Metodo que llama al repository para actualizar un pedido
     * @var array con los datos a actualizar
     * @var int id del pedido a actualizar
     * @return bool|string
     */
    public function updateOrder(array $userData, int $id): bool|string {
        try {
            $order = new Order(
                null,                        
                0,                            
                '',          
                '',          
                '',          
                0.0,                          
                $userData['estado'],                           
                '',                           
                ''                           
            );

            return $this->repository->updateOrder($order, $id);
        } 
        catch (\Exception $e) {
            error_log("Error al actualizar la categoria: " . $e->getMessage());
            return false;
        }
    }
}