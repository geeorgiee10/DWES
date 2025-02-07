<?php

namespace Repositories;

use Lib\BaseDatos;
use Models\Order;
use PDO;
use PDOException;
use Repositories\OrderLineRepository;

/**
 * Clase que realiza las consultas a la tabla pedidos
 */
class OrderRepository {
    /**
     * Variables para establecer la conexion con la base de datos
     */
    private BaseDatos $conexion;
    private OrderLineRepository $OrderLineRepository;

    /**
     * Constructor que inicializa las variables
     */
    public function __construct() {
        $this->conexion = new BaseDatos();
        $this->OrderLineRepository = new OrderLineRepository();
    }

    /**
     * Metodo que guarda los pedidos en la base de datos y llama al repository
     * de lineas de pedido para que guarde todas sus lineas de pedido
     * @var Order objeto con los datos del pedido a guardar
     * @return bool|string
     */
    public function saveOrder(Order $order): bool|string {
        try {

            //$this->conexion->beginTransaction();

            $stmt = $this->conexion->prepare(
                "INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora)
                 VALUES (:usuario_id, :provincia, :localidad, :direccion, :coste, :estado, :fecha, :hora)"
            );

            $stmt->bindValue(':usuario_id', $order->getUsuarioId(), PDO::PARAM_INT);
            $stmt->bindValue(':provincia', $order->getProvincia(), PDO::PARAM_STR);
            $stmt->bindValue(':localidad', $order->getLocalidad(), PDO::PARAM_STR);
            $stmt->bindValue(':direccion', $order->getDireccion(), PDO::PARAM_STR);
            $stmt->bindValue(':coste', number_format($order->getCoste(), 2, '.', ''), PDO::PARAM_STR);
            $stmt->bindValue(':estado', $order->getEstado(), PDO::PARAM_STR);
            $stmt->bindValue(':fecha', $order->getFecha(), PDO::PARAM_STR);
            $stmt->bindValue(':hora', $order->getHora(), PDO::PARAM_STR);

            $stmt->execute();

            $pedidoId = $this->conexion->ultimoIDInsertado();

            $_SESSION['orderID'] = $pedidoId;

            $this->OrderLineRepository->saveOrderLines($pedidoId);

            //$this->conexion->commit();

            return true;
        } 
        catch (PDOException $e) {
           // $this->conexion->rollBack();
            return $e->getMessage();
        }
    }

    /**
     * Metodo que obtiene un pedido en especifico de la base de datos
     * @return array
     */
    public function selectOrder(): array {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM pedidos WHERE id = :id");
            $stmt->bindValue(':id', $_SESSION['orderID'], PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log("Error al obtener el pedido: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Metodo que obtiene todos los pedidos de un usuario de la base de datos
     * @return array
     */
    public function seeOrders(): array {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM pedidos WHERE usuario_id = :id");
            $stmt->bindValue(':id', $_SESSION['usuario']['id'], PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log("Error al obtener los pedidos: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Metodo que obtiene todos los pedidos de la base de datos
     * @return array
     */
    public function seeAllOrders(): array {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM pedidos");

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log("Error al obtener los pedidos: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Metodo que actualiza un pedido en la base de datos
     * @var Category objeto con los datos del pedido a actualizar
     * @var int id del pedido a actualizar
     * @return bool|string
     */
    public function updateOrder(Order $order, int $id): bool|string{
        try {
            $stmt = $this->conexion->prepare(
                "UPDATE pedidos SET estado = :estado WHERE id = :idPedido");

               
            $stmt->bindValue(':estado', $order->getEstado(), PDO::PARAM_STR);
            $stmt->bindValue(':idPedido', $id, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } 
        catch (PDOException $e) {
            return $e->getMessage();
        }
    }



}