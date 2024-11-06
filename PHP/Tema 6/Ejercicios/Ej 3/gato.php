<?php

require_once 'animal.php';


class Gato extends Animal {
    public string $colorPelaje;
    public int $energia;

    public function __construct(int $edad = 2, bool $esDomestico = true, string $colorPelaje = "gris") {
        parent::__construct("Gato", $edad, $esDomestico);
        
        $this->colorPelaje = $colorPelaje;
        $this->energia = 100; 
    }

    public function hacerSonido() {
        echo "El gato maúlla: ¡Miau!\n";
    }

    public function ronronear() {
        echo "El gato está ronroneando contento.\n";
    }

    public function jugar() {
        if ($this->energia > 20) {
            $this->energia -= 20;
            echo "El gato juega y ahora tiene " . $this->energia . "% de energía.\n";
        } else {
            echo "El gato está cansado y necesita descansar.\n";
        }
    }
}

?>
