<?php

namespace Services;

use Models\OrderLine;
use Repositories\OrderLineRepository;

/**
 * Clase que recibe los datos de ORrderController
 * y se los pasa al repository
 */
class OrderLineService {
    /**
     * Variable para establecer la conexion el repository
     */
    private OrderLineRepository $repository;

    /**
     * Constructor que inicializa las variables
     */
    public function __construct() {
        $this->repository = new OrderLineRepository();
    }

    

    /**
     * Metodo que llama al repository para listar todas las lineas
     * de pedido de un pedido
     * @var int id del pedido del que sacar las lineas de pedido
     * @return array
     */
    public function seeOrdersLine(int $id): array {
        return $this->repository->seeOrdersLine($id);
    }
}