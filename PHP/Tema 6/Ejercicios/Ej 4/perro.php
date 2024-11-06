<?php

class Perro {
    private string $tamaño;
    private string $raza;
    private string $color;
    private string $nombre;

    public function __construct(string $tamaño, string $raza, string $color, string $nombre) {
        $this->set_tamaño($tamaño);
        $this->set_raza($raza);
        $this->set_color($color);
        $this->set_nombre($nombre);
    }

    public function mostrar_propiedades(): void {
        echo "El tamaño del perro es {$this->tamaño}, su color es {$this->color}, su raza es {$this->raza} y su nombre es: {$this->nombre}.\n";
    }

    public function speak(): void {
        echo "{$this->nombre} dice: ¡Guau, guau!\n";
    }

    // Getters
    public function get_tamaño(): string {
        return $this->tamaño;
    }

    public function get_raza(): string {
        return $this->raza;
    }

    public function get_color(): string {
        return $this->color;
    }

    public function get_nombre(): string {
        return $this->nombre;
    }

    // Setters con validaciones
    public function set_tamaño(string $tamaño): bool {
        if (in_array(strtolower($tamaño), ['pequeño', 'mediano', 'grande'])) {
            $this->tamaño = $tamaño;
            return true;
        } else {
            echo "Error: Tamaño inválido. Debe ser 'pequeño', 'mediano' o 'grande'.\n";
            return false;
        }
    }

    public function set_raza(string $raza): bool {
        if (strlen($raza) > 0) {
            $this->raza = $raza;
            return true;
        } else {
            echo "Error: La raza no puede estar vacía.\n";
            return false;
        }
    }

    public function set_color(string $color): bool {
        if (strlen($color) > 0) {
            $this->color = $color;
            return true;
        } else {
            echo "Error: El color no puede estar vacío.\n";
            return false;
        }
    }

    public function set_nombre(string $nombre): bool {
        if (strlen($nombre) > 0 && strlen($nombre) <= 21) {
            $this->nombre = $nombre;
            return true;
        } else {
            echo "Error: El nombre debe tener entre 1 y 21 caracteres.\n";
            return false;
        }
    }
}

?>
