<?php

namespace Services;

use Models\Category;
use Repositories\CategoryRepository;

/**
 * Clase que recibe los datos de CategoryController
 * y se los pasa al repository
 */
class CategoryService {
    /**
     * Variable para establecer la conexion el repository
     */
    private CategoryRepository $repository;

    /**
     * Constructor que inicializa las variables
     */
    public function __construct() {
        $this->repository = new CategoryRepository();
    }

    /**
     * Metodo que llama al repository para guardar una categoria
     * @var array con los datos de la categoria a guardar
     * @return bool|string
     */
    public function guardarCategoria(array $userData): bool|string {
        try {
            $categoria = new Category(
                null,
                $userData['nombre']
            );

            return $this->repository->guardarCategoria($categoria);
        } 
        catch (\Exception $e) {
            error_log("Error al guardar la categoria: " . $e->getMessage());
            return false;
        }
    }
    

    /**
     * Metodo que llama al repository para listar todas las categorias
     * @return array
     */
    public function listarCategorias(): array {
        return $this->repository->listarCategorias();
    }

    /**
     * Metodo que llama al repository para actualizar una categoria
     * @var array con los datos a actualizar
     * @var int id de la categoria a actualizar
     * @return bool|string
     */
    public function actualizarCategoria(array $userData, int $id): bool|string {
        try {
            $categoria = new Category(
                null,
                $userData['nombre']
            );

            return $this->repository->actualizarCategoria($categoria, $id);
        } 
        catch (\Exception $e) {
            error_log("Error al actualizar la categoria: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Metodo que llama al repository para borrar una categoria
     * @var int con la categoria a borrar
     * @return bool
     */
    public function borrarCategoria(int $id): bool {
        return $this->repository->borrarCategoria($id);
    }


}