<?php

namespace Models;

use Lib\Validar;

class Ruta {

    public function __construct(
        private ?int $id = null,
        private string $titulo = "",
        private string $descripcion = "",
        private int $desnivel = 0,
        private float $distancia = 0.0,
        private string $notas = "",
        private string $dificultad = ""
    ) {}

    // Variables para búsqueda
    private string $campo = "";
    private string $elementoABuscar = "";

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getDesnivel(): int {
        return $this->desnivel;
    }

    public function getDistancia(): float {
        return $this->distancia;
    }

    public function getNotas(): string {
        return $this->notas;
    }

    public function getDificultad(): string {
        return $this->dificultad;
    }

    // Getters para búsqueda
    public function getCampo(): string {
        return $this->campo;
    }

    public function getElementoABuscar(): string {
        return $this->elementoABuscar;
    }

    // Setters
    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setTitulo(string $titulo): void {
        $this->titulo = $titulo;
    }

    public function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setDesnivel(int $desnivel): void {
        $this->desnivel = $desnivel;
    }

    public function setDistancia(float $distancia): void {
        $this->distancia = $distancia;
    }

    public function setNotas(string $notas): void {
        $this->notas = $notas;
    }

    public function setDificultad(string $dificultad): void {
        $this->dificultad = $dificultad;
    }

    // Setters para búsqueda
    public function setCampo(string $campo): void {
        $this->campo = $campo;
    }

    public function setElementoABuscar(string $elementoABuscar): void {
        $this->elementoABuscar = $elementoABuscar;
    }

    // Métodos de validación
    public function validarDatosRegistro(): array {
        $errores = [];

        // Validar campos requeridos
        if (empty($this->titulo)) {
            $errores["titulo"] = "El campo 'Título' es obligatorio";
        }

        if (empty($this->descripcion)) {
            $errores["descripcion"] = "El campo 'Descripción' es obligatorio";
        }

        if (empty($this->desnivel)) {
            $errores["desnivel"] = "El campo 'Desnivel' es obligatorio";
        }

        // Validar titulo
        if (!empty($this->titulo) && !Validar::validateString($this->titulo)) {
            $errores['titulo'] = "El titulo no puede contener caracteres especiales";
        }  

        // Validar descripción
        if(!empty($this->descripcion) && strlen($this->descripcion) > 65535){
            $errores['descripcion'] = "La longitud de la descripción supera la longitud máxima";
        }

        // Validar desnivel
        if(!empty($this->desnivel) && !Validar::validateInt($this->desnivel)){
            $errores['desnivel'] = "El desnivel debe ser un número entero";
        }  

        // Validar distancia (opcional)
        if(!empty($this->distancia) && !Validar::validateDouble($this->distancia)){
            $errores['distancia'] = "La distancia debe ser un número decimal";
        }  

        // Validar notas (opcional)
        if(!empty($this->notas) && strlen($this->notas) > 65535){
            $errores['notas'] = "La longitud de notas es demasiado grande";
        }
        
        // Validar dificultad (opcional)
        if(!empty($this->dificultad) && !in_array($this->dificultad, ["baja", "media", "alta"])){
            $errores['dificultad'] = "La dificultad debe ser baja, media o alta";
        }
        
        return $errores;
    }

    public function validarDatosBusqueda(): array {
        $errores = [];

        if (empty($this->campo)) {
            $errores['campo'] = "Tienes que seleccionar un campo para buscar";
        }

        if (empty($this->elementoABuscar)) {
            $errores['buscador'] = "Debes introducir el valor que quieres buscar";
        }

        $campos = ["titulo", "descripcion", "desnivel", "distancia", "notas", "dificultad"];
        if (!in_array($this->campo, $campos)) {
            $errores['campo'] = "El campo seleccionado no esta en la base de datos";
        }

        if (empty($errores)) {
            switch($this->campo) {
                case 'desnivel':
                    if (!is_numeric($this->elementoABuscar)) {
                        $errores['buscador'] = "El formato de desnivel no es validoo";
                    }
                    break;
                case 'distancia':
                    if (!is_numeric($this->elementoABuscar)) {
                        $errores['buscador'] = "La distancia tiene que ser un número";
                    }
                    break;
                case 'dificultad':
                    if (!empty($this->elementoABuscar) && !in_array(strtolower($this->elementoABuscar), ["baja", "media", "alta"])) {
                        $errores['buscador'] = "El valor de la dificultad no es valido";
                    }
                    break;
            }
        }

        return $errores;
    }

    // Métodos de sanetización
    public function sanitizarDatos(): void {
        $this->titulo = Validar::sanitizeString($this->titulo);
        $this->descripcion = Validar::sanitizeString($this->descripcion);
        $this->desnivel = Validar::sanitizeInt($this->desnivel);
        $this->distancia = Validar::sanitizeDouble($this->distancia);
        $this->dificultad = Validar::sanitizeString($this->dificultad);
        $this->notas = Validar::sanitizeString($this->notas);
    }


    public function sanitizarDatosBusqueda(): void {
        $this->campo = Validar::sanitizeString($this->campo);
        
        switch($this->campo) {
            case 'desnivel':
                $this->elementoABuscar = Validar::sanitizeInt($this->elementoABuscar);
                break;
            case 'distancia':
                $this->elementoABuscar = Validar::sanitizeDouble($this->elementoABuscar);
                break;
            default:
                $this->elementoABuscar = Validar::sanitizeString($this->elementoABuscar);
        }
    }
}