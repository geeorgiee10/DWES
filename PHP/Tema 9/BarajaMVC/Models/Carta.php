<?php 

namespace Models;

class Carta {
    const PALOS = ["ESPADAS", "OROS", "COPAS", "BASTOS"];
    const CARTAS = [
        1 => 'as', 2 => 'dos', 3 => 'tres', 4 => 'cuatro',
        5 => 'cinco', 6 => 'seis', 7 => 'siete', 8 => 'ocho',
        9 => 'nueve', 10 => 'sota', 11 => 'caballo', 12 => 'rey'
    ];

    public function __construct(
        private int $numero,
        private string $palo
    ) {}

    public function getNumero(): int {
        return $this->numero;
    }

    public function getPalo(): string {
        return $this->palo;
    }

    public function setNumero(int $numero): void {
        if (!self::compruebaNumero($numero)) {
            throw new \InvalidArgumentException("El número debe estar entre 1 y 12.");
        }
        $this->numero = $numero;
    }

    public function setPalo(string $palo): void {
        if (!self::compruebaPalo($palo)) {
            throw new \InvalidArgumentException("Palo inválido. Debe ser uno de: " . implode(", ", self::PALOS));
        }
        $this->palo = $palo;
    }

    public function getNombre(): string {
        return self::CARTAS[$this->numero] . " de " . $this->palo;
    }

    public function __toString(): string {
        return $this->getNombre();
    }

    public static function compruebaNumero(int $numero): bool {
        return $numero >= 1 && $numero <= 12;
    }

    public static function compruebaPalo(string $palo): bool {
        return in_array($palo, self::PALOS);
    }
}

?>
