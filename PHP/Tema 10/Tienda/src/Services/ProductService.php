<?php

namespace Services;

use Models\Product;
use Repositories\ProductRepository;

/**
 * Clase que recibe los datos de ProductController
 * y se los pasa al repository
 */
class ProductService {
    /**
     * Variable para establecer la conexion el repository
     */
    private ProductRepository $repository;

    /**
     * Constructor que inicializa las variables
     */
    public function __construct() {
        $this->repository = new ProductRepository();
    }

    /**
     * Metodo que llama al repository para guardar un producto
     * @var array con los datos del producto a guardar
     * @return bool|string
     */
    public function guardarProductos(array $productData): bool|string {
        try {
            $producto = new Product(
                null,
                $productData['categoria_id'],
                $productData['nombre'],
                $productData['descripcion'],
                $productData['precio'],
                $productData['stock'],
                $productData['oferta'],
                $productData['fecha'],
                $productData['imagen']
            );

            return $this->repository->guardarProductos($producto);
        } 
        catch (\Exception $e) {
            error_log("Error al guardar el producto: " . $e->getMessage());
            return false;
        }
    }

     /**
      * Método que llama a repository para ver todos los productos
      * @return array
      */
    public function mostrarProductos(): array {
        return $this->repository->mostrarProductos();
    }

     /**
      * Método que llama a repository para ver todos los productos de una categoria
      * @var int con el id de la categoria de la que mostrar los productos
      * @return array
      */
    public function mostrarProductosXCategoria(int $id): array {
        return $this->repository->mostrarProductosXCategoria($id);
    }


     /**
      * Método que llama a repository para contar todos los productos de una categoria
      * @var int con el id de la categoria de la que contar los productos
      * @return int
      */
    public function contarProductosXCategoria(int $id): int {
        return $this->repository->contarProductosXCategoria($id);
    }

    /**
      * Método que llama a repository para actualizar los productos de la categoria a borrar
      * @var int con el id de la categoria de la que actualizar los productos
      * @return bool|string
      */
    public function actualizarProductosXCategoria(int $id): bool|string {
        try {

            return $this->repository->actualizarProductosXCategoria($id);
        } 
        catch (\Exception $e) {
            error_log("Error al cambiar la categoria de los productos: " . $e->getMessage());
            return false;
        }
    }

    /**
      * Método que llama a repository para ver todos los datos de un producto
      * @var int con el id del producto del que tomar los detallers
      * @return array
      */
    public function detailProduct(int $id): array {
        return $this->repository->detailProduct($id);
    }

    /**
      * Método que llama a repository para borrar un producto
      * @var int con el id del producto a borrar
      * @return bool
      */
    public function deleteProduct(int $id): bool {
        return $this->repository->deleteProduct($id);
    }

    /**
      * Método que llama a repository para actualizar un producto
      * @var array con los datos a actualizar
      * @var int con el id del producto a actualizar
      * @return bool|string
      */
     public function updateProduct(array $productData, int $id): bool|string {
        try {
            $producto = new Product(
                null,
                $productData['categoria_id'],
                $productData['nombre'],
                $productData['descripcion'],
                $productData['precio'],
                $productData['stock'],
                $productData['oferta'],
                $productData['fecha'],
                $productData['imagen']
            );

            return $this->repository->updateProduct($producto, $id);
        } 
        catch (\Exception $e) {
            error_log("Error al actualizar el producto: " . $e->getMessage());
            return false;
        }
    }

    /**
      * Método que llama a repository para actualizar el stock de un producto
      * despues de un pedido
      * @return bool|string
      */
    public function updateStockProduct(): bool|string {
        
        return $this->repository->updateStockProduct();
        
    }


    /**
      * Método que llama a repository para actualizar la categoria de un producto que
      * va a ser borrado pero esta en un pedido
      * @var int con el id del producto de la que actualizar la categoria
      * @return bool|string
      */
      public function updateCategoryProduct(int $id): bool|string {
        try {

            return $this->repository->updateCategoryProduct($id);
        } 
        catch (\Exception $e) {
            error_log("Error al cambiar la categoria de los productos: " . $e->getMessage());
            return false;
        }
    }

}