<?php

namespace Models;

use Lib\BaseDatos;
use Lib\Validar;

/**
 * Clase para crear los objetos category
 */
class Category {
    private BaseDatos $conexion;
    private mixed $stmt;

    /**
     * Constructor que inicializa los campos del objeto Category
     */
    public function __construct(
        private ?int $id = null,
        private string $nombre = "",
        private string $apellidos = "",
        private string $correo = "",
        private string $contrasena = "",
        private string $rol = ""
    ) {
        $this->conexion = new BaseDatos();
    }

    // Metodos Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    // Metodos Setters
    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * Metodo para validar los campos de los formularios
     * @return array array con los errores en caso de que haya
     */
    public function validarDatos(): array {
        $errores = [];

        // Validar campos requeridos
        if (empty($this->nombre)) {
            $errores['nombre'] = "El campo 'Nombre' es obligatorio";
        }

        // Validar nombre
        if(!Validar::validateNombre($this->nombre)){
            $errores['nombre'] = "El nombre no puede contener caracteres especiales ni números";
        }  

        return $errores;
    }

    /**
     * Metodo para validar los campos del formulario de borrado
     * @return array array con los errores en caso de que haya
     */
    public function validarBorrado(int $id): array {
        $errores = [];

        // Validar campos requeridos
        if (empty($id)) {
            $errores['id'] = "LA categoria es obligatoria";
        }

        // Validar ID
        if(!Validar::validateInt($id)){
            $errores['id'] = "La categoria seleccionada no es correcta";
        }  

        return $errores;
    }

    /**
     * Metodo para sanetizar los datos recibidos por el formulario
     * @return void
     */
    public function sanitizarDatos(): void {
        $this->id = Validar::sanitizeInt($this->id);
        $this->nombre = Validar::sanitizeString($this->nombre);
    }

    /**
     * Metodo para sanetizar los datos recibidos por el formulario de borrado
     * @return void
     */
    public function sanitizarBorrado(int $id): void {
        $this->id = Validar::sanitizeInt($id);
    }

    /**
     * Metodo para combertir un array en un objeto category
     * @var array array a convertir en objeto
     * @return Category array convertido a objeto
     */
    public static function fromArray(array $data): Category{
        return new Category(
            $data['id'] ?? null,
            $data['nombre'] ?? ""
        );
    }

}
