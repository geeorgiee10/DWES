<?php 

class Coche {
    public $color = "Rojo";
    public $marca = "Ferrari";
    public $modelo = "Aventador";
    public $velocidad = 300;
    public $caballos = 500;
    public $plazas = 2;


    public function __construct($color, $marca, $modelo) {
        $this->color = $color;
        $this->marca = $marca;
        $this->modelo = $modelo;
    }

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