<?php

namespace Models;

use Lib\BaseDatos;
use Lib\Validar;
use PDO;
use PDOException;

class RutaComentario {
    private ?int $id;
    private int $id_ruta;
    private string $nombre;
    private string $texto;
    private string $fecha;
    private int $id_usuario;

    public function __construct(
        ?int $id = null,
        int $id_ruta = 0,
        string $nombre = "",
        string $texto = "",
        string $fecha = "",
        int $id_usuario = 0
    ) {
        $this->id = $id;
        $this->id_ruta = $id_ruta;
        $this->nombre = $nombre;
        $this->texto = $texto;
        $this->fecha = $fecha;
        $this->id_usuario = $id_usuario;
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getIdRuta(): int {
        return $this->id_ruta;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getTexto(): string {
        return $this->texto;
    }

    public function getFecha(): string {
        return $this->fecha;
    }

    public function getIdUsuario(): int {
        return $this->id_usuario;
    }

    // Setters
    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setIdRuta(int $id_ruta): void {
        $this->id_ruta = $id_ruta;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setTexto(string $texto): void {
        $this->texto = $texto;
    }

    public function setFecha(string $fecha): void {
        $this->fecha = $fecha;
    }

    public function setIdUsuario(int $id_usuario): void {
        $this->id_usuario = $id_usuario;
    }

    // Validación de campos
    public function validar(): array {
        $errores = [];

        if (empty($this->id_ruta) || $this->id_ruta <= 0) {
            $errores['id_ruta'] = "El ID de la ruta no es válido";
        }

        if (empty($this->id_usuario) || $this->id_usuario <= 0) {
            $errores['id_usuario'] = "El ID del usuario no es válido";
        }

        if (empty($this->nombre)) {
            $errores['nombre'] = "El nombre es obligatorio";
        }

        if (strlen($this->nombre) > 100) {
            $errores['nombre'] = "El nombre excede el limite de caracteres";
        }

        if (empty($this->texto)) {
            $errores['texto'] = "El comentario es obligatorio";
        }

        if (strlen($this->texto) > 500) {
            $errores['texto'] = "El comentario es demasiado largo";
        }

        if (empty($this->fecha)) {
            $errores['fecha'] = "La fecha es obligatoria";
        }

        if (!empty($this->fecha) && !Validar::validateDate($this->fecha)) {
            $errores['fecha'] = "La fecha no es válida";
        }

        return $errores;
    }

    // Sanitización de datos
    public function sanitizar(): void {
        $this->id = Validar::sanitizeInt($this->id);
        $this->id_ruta = Validar::sanitizeInt($this->id_ruta);
        $this->nombre = Validar::sanitizeString($this->nombre);
        $this->texto = Validar::sanitizeString($this->texto);
        $this->fecha = Validar::sanitizeDate($this->fecha);
        $this->id_usuario = Validar::sanitizeInt($this->id_usuario);
    }

    public function validarOcultos(): array {
        $errores = [];

        if (empty($this->id_ruta) || $this->id_ruta <= 0) {
            $errores['id_ruta'] = "El ID de la ruta no es válido";
        }

        if (empty($this->id_usuario) || $this->id_usuario <= 0) {
            $errores['id_usuario'] = "El ID del usuario no es válido";
        }

        if (empty($this->nombre)) {
            $errores['nombre'] = "El nombre es obligatorio";
        }

        if (strlen($this->nombre) > 100) {
            $errores['nombre'] = "El nombre excede el limite de caracteres";
        }

        return $errores;
    }

    // Sanitización de datos
    public function sanitizarOcultos(): void {
        $this->id_ruta = Validar::sanitizeInt($this->id_ruta);
        $this->nombre = Validar::sanitizeString($this->nombre);
        $this->id_usuario = Validar::sanitizeInt($this->id_usuario);
    }

    
}