<?php

class Coche {
    // Constructor con promoción de propiedades en PHP 8
    public function __construct(
        public string $color,
        public string $marca,
        public string $modelo,
        public int $velocidad = 300,
        public int $caballos = 500,
        public int $plazas = 2
    ) {}

    public function acelerar() {
        $this->velocidad += 1;
    }
    public function frenar() {
        if ($this->velocidad > 0) {
            $this->velocidad -= 1;
        }
    }
}


?>