<?php

class Animal {
    public string $especie;
    public int $edad;
    public bool $esDomestico;

    public function __construct(string $especie, int $edad, bool $esDomestico) {
        $this->especie = $especie;
        $this->edad = $edad;
        $this->esDomestico = $esDomestico;
    }

    public function hacerSonido() {
        echo "El animal hace un sonido.\n";
    }
}

?>
