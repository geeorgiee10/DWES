<?php 

namespace Controllers;

use Models\Barajaes;
use Lib\Pages;

class BarajaController {
    private Barajaes $baraja;
    private Pages $pages;

    public function __construct() {
        $this->baraja = new Barajaes();
        $this->pages = new Pages();
    }

    public function mostrarBaraja(): void {
        $this->pages->render("muestraBaraja", [
            "mazo" => $this->baraja->getBaraja()
        ]);
    }

    public function barajar(): void {
        $this->baraja->mezclar();
        $this->pages->render("muestraMezclar", [
            "mazo" => $this->baraja->getBaraja()
        ]);
    }

    public function sacar(): void {
        $cartaASacar = $this->baraja->tomarCarta(); 
        $this->pages->render("muestraCartaSacada", [
            "carta" => $cartaASacar,
            "mazo" => $this->baraja->getBaraja()
        ]);
    }

    public function repartir(): void {
        if (isset($_POST['numero'])) {
            $numeroDeJugadores = (int)$_POST['numero'];

            if ($numeroDeJugadores >= 1 && $numeroDeJugadores <= 6) {
                $cartasPorJugador = floor($this->baraja->cartasRestantes() / $numeroDeJugadores);
                $cartasRepartidas = [];
    
                for ($i = 0; $i < $numeroDeJugadores; $i++) {
                    $jugador = [];
                    for ($j = 0; $j < $cartasPorJugador; $j++) {
                        $jugador[] = $this->baraja->tomarCarta();
                    }
                    $cartasRepartidas[] = $jugador;
                }
    
                $this->pages->render("repartirCartas", [
                    "cartasRepartidas" => $cartasRepartidas,
                    "numeroDeJugadores" => $numeroDeJugadores
                ]);
            } else {
                $this->pages->render("repartirCartas", [
                    "error" => "Por favor, ingrese un número válido de jugadores entre 1 y 6."
                ]);
            }
        } else {
            $this->pages->render("repartirCartas", [
                "error" => "Por favor, ingrese un número de jugadores."
            ]);
        }
    }
    

    
}


?>