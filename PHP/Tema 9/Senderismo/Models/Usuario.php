<?php

namespace Models;

use Lib\BaseDatos;
use Lib\Validar;
use PDO;
use PDOException;

class Usuario {
    private BaseDatos $conexion;
    private mixed $stmt;

    public function __construct(
        private ?int $id = null,
        private string $nombre = "",
        private string $apellidos = "",
        private string $correo = "",
        private string $direccion = "",
        private string $telefono = "",
        private string $fecha_nacimiento = "",
        private string $nombre_usuario = "",
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

    public function getDireccion(): string {
        return $this->direccion;
    }

    public function getTelefono(): string {
        return $this->telefono;
    }

    public function getFechaNacimiento(): string {
        return $this->fecha_nacimiento;
    }

    public function getNombreUsuario(): string {
        return $this->nombre_usuario;
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

    public function setDireccion(string $direccion): void {
        $this->direccion = $direccion;
    }

    public function setTelefono(string $telefono): void {
        $this->telefono = $telefono;
    }

    public function setFechaNacimiento(string $fecha_nacimiento): void {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function setNombreUsuario(string $nombre_usuario): void {
        $this->nombre_usuario = $nombre_usuario;
    }

    public function setContrasena(string $contrasena): void {
        $this->contrasena = $contrasena;
    }

    public function setRol(string $rol): void {
        $this->rol = $rol;
    }

    // Métodos de validación
    public function validarDatosRegistro(): array {
        $errores = [];

        // Validar campos requeridos
        if (empty($this->nombre_usuario) || empty($this->contrasena) || empty($this->rol)) {
            $errores[] = "Los campos 'Nombre Usuario', 'Contraseña' y 'Rol' son obligatorios";
        }

        // Validar nombre
        if(!Validar::validateString($this->nombre)){
            $errores['nombre'] = "El nombre no puede contener caracteres especiales";
        }  

        // Validar apellidos
        if(!Validar::validateString($this->apellidos)){
            $errores['apellidos'] = "Los apellidos no pueden contener caracteres especiales";
        }  

        // Validar email
        if(!Validar::validateEmail($this->correo)){
            $errores['email'] = "El correo electrónico no es válido";
        }

        // Validar dirección
        if(!Validar::validateString($this->direccion)){
            $errores['direccion'] = "El formato de la dirección no es valido";
        }  

        // Validar teléfono
        if(!Validar::validatePhone($this->telefono)){
            $errores['telefono'] = "El teléfono solo puede contener 9 números";
        }  

        // Validar fecha de nacimiento
        if (!Validar::validateDate($this->fecha_nacimiento)) {
            $errores['fecha_nacimiento'] = "La fecha de nacimiento no es válida.";
        }

        // Validar nombre de usuario
        if(!Validar::validateString($this->nombre_usuario)){
            $errores['nombre_usuario'] = "El nombre de usuario es obligatorio y no puede contener caracteres especiales";
        }  

        // Validar contraseña
        if(!Validar::validateString($this->contrasena) || strlen($this->contrasena) < 6){
            $errores['contrasena'] = "La contraseña debe de ser de al menos 6 caracteres y puede tener letras, caracteres especiales y numeros";
        }

        // Validar rol
        if(!in_array($this->rol, ["admin", "usur"])){
            $errores['rol'] = "El rol tiene que ser 'admin' o el rol 'usur'";
        }

        return $errores;
    }

    public function sanitizarDatos(): void {
        $this->id = Validar::sanitizeInt($this->id);
        $this->nombre = Validar::sanitizeString($this->nombre);
        $this->apellidos = Validar::sanitizeString($this->apellidos);
        $this->correo = Validar::sanitizeEmail($this->correo);
        $this->direccion = Validar::sanitizeString($this->direccion);
        $this->telefono = Validar::sanitizePhone($this->telefono);
        $this->fecha_nacimiento = Validar::sanitizeDate($this->fecha_nacimiento);
        $this->nombre_usuario = Validar::sanitizeString($this->nombre_usuario);
        $this->contrasena = Validar::sanitizeString($this->contrasena);
        $this->rol = Validar::sanitizeString($this->rol);
    }


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

    public function validarDatosEdicion(): array {
        $errores = [];

        if(!Validar::validateInt($this->id)){
            $errores['id'] = "El formato del id no es correcto";
        }

        if (empty($this->nombre)) {
            $errores['nombre'] = "El nombre es obligatorio y el formato no es válido";
        }

        if (empty($this->apellidos)) {
            $errores['apellidos'] = "Los apellidos son obligatorios y el formato no es válido";
        }

        if (empty($this->correo) || !Validar::validateEmail($this->correo)) {
            $errores['email'] = "El correo electrónico es obligatorio y el formato no es válido";
        }

        if (empty($this->direccion)) {
            $errores['direccion'] = "La dirección es obligatoria y el formato no es válido";
        }

        if (empty($this->telefono) || !Validar::validatePhone($this->telefono)) {
            $errores['telefono'] = "El teléfono es obligatorio y el formato no es válido";
        }

        if (empty($this->fecha_nacimiento) || !Validar::validateDate($this->fecha_nacimiento)) {
            $errores['fecha_nacimiento'] = "La fecha de nacimiento es obligatoria y el formato no es válido";
        }

        if (empty($this->nombre_usuario)) {
            $errores['nombre_usuario'] = "El nombre de usuario es obligatorio y el formato no es válido";
        }

        return $errores;
    }

}
