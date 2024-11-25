<?php 

namespace Models;

class Barajaes {
    private array $baraja;

    function __construct() {
        $baraja = [];
        $palos = Carta::PALOS;
        for ($i = 0; $i < sizeof($palos); $i++) {
            for ($j = 1; $j <= 12; $j++) {
                $carta = new Carta($j, $palos[$i]);
                $baraja[] = $carta;
            }
        }
        $this->setBaraja($baraja);
    }

    public function getBaraja(): array {
        return $this->baraja;
    }

    public function setBaraja(array $baraja): void {
        $this->baraja = $baraja;
    }

    public function mezclar(): void {
        shuffle($this->baraja);
    }

    public function tomarCarta(): ?Carta {
        $indice_aleatorio = array_rand($this->baraja);
        $cartaSacar = $this->baraja[$indice_aleatorio];
        unset($this->baraja[$indice_aleatorio]);
        $this->baraja = array_values($this->baraja);
        return $cartaSacar;
        
    }

    public function cartasRestantes(): int {
        return count($this->baraja);
    }

    public function mostrarBaraja(): void {
        foreach ($this->baraja as $carta) {
            echo $carta->getNombre() . PHP_EOL;
        }
    }

    
}

?>
