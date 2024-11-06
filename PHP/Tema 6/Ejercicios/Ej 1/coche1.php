<?php 

class Coche1 {
    public $color = "Rojo";
    public $marca = "Ferrari";
    public $modelo = "Aventador";
    public $velocidad = 300;
    public $caballos = 500;
    public $plazas = 2;

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