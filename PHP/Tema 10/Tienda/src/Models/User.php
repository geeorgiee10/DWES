<?php

namespace Models;

use Lib\BaseDatos;
use Lib\Validar;

/**
 * Clase para crear los objetos User
 */
class User {
    private BaseDatos $conexion;
    private mixed $stmt;

    /**
     * Constructor que inicializa los campos del objeto User
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

    public function getApellidos(): string {
        return $this->apellidos;
    }

    public function getCorreo(): string {
        return $this->correo;
    }

    public function getContrasena(): string {
        return $this->contrasena;
    }

    public function getRol(): string {
        return $this->rol;
    }

    // Metodos Setters
    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setApellidos(string $apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function setCorreo(string $correo): void {
        $this->correo = $correo;
    }

    public function setContrasena(string $contrasena): void {
        $this->contrasena = $contrasena;
    }

    public function setRol(string $rol): void {
        $this->rol = $rol;
    }

    /**
     * Metodo para validar los campos del formulario de registro
     * @return array array con los errores en caso de que haya
     */
    public function validarDatosRegistro(): array {
        $errores = [];

        // Validar campos requeridos
        if (empty($this->nombre) || empty($this->contrasena) || empty($this->rol)) {
            $errores[] = "Los campos 'Nombre', 'Contraseña' y 'Rol' son obligatorios";
        }

        // Validar nombre
        if(!Validar::validateNombre($this->nombre)){
            $errores['nombre'] = "El nombre no puede contener caracteres especiales";
        }  

        // Validar apellidos
        if(!Validar::validateApellidos($this->apellidos)){
            $errores['apellidos'] = "Los apellidos no pueden contener caracteres especiales";
        }  

        // Validar email
        if(!Validar::validateEmail($this->correo)){
            $errores['email'] = "El correo electrónico no es válido";
        }

        // Validar contraseña
        if(!Validar::validatePassword($this->contrasena) || strlen($this->contrasena) < 6){
            $errores['contrasena'] = "La contraseña debe de ser de al menos 6 caracteres y puede tener letras, caracteres especiales y numeros";
        }

        // Validar rol
        if(!in_array($this->rol, ["admin", "usur"])){
            $errores['rol'] = "El rol tiene que ser 'admin' o el rol 'usur'";
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
        $this->apellidos = Validar::sanitizeString($this->apellidos);
        $this->correo = Validar::sanitizeEmail($this->correo);
        $this->contrasena = Validar::sanitizeString($this->contrasena);
        $this->rol = Validar::sanitizeString($this->rol);
    }

    /**
     * Metodo para validar los campos del formulario de inicio de sesion
     * @return array array con los errores en caso de que haya
     */
    public function validarDatosLogin(): array {
        $errores = [];

        if (empty($this->correo)) {
            $errores['correo'] = "El campo correo es obligatorio.";
        }

        if (empty($this->contrasena)) {
            $errores['contrasena'] = "El campo contraseña es obligatorio.";
        }

        return $errores;
    }

    /**
     * Metodo para combertir un array en un objeto User
     * @var array array a convertir en objeto
     * @return User array convertido a objeto
     */
    public static function fromArray(array $data): User{
        return new User(
            $data['id'] ?? null,
            $data['nombre'] ?? "",
            $data['apellidos'] ?? "",
            $data['email'] ?? "",
            $data['contrasena'] ?? "",
            $data['rol'] ?? 'usur'
        );
    }

    

}
