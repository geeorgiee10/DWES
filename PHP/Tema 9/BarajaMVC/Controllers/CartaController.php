<?php 

namespace Controllers;

use Models\Carta;
use Lib\Pages;

class CartaController {
    private Pages $pages;

    public function __construct() {
        $this->pages = new Pages();
    }

    public function mostrarCarta(): void {
        $numero = $_POST['numero'] ?? null;
        $palo = $_POST['palo'] ?? null;
        $cartaSeleccionada = null;
        $error = null;

        if ($numero !== null && ($numero < 1 || $numero > 12)) {
            $error = "El número de la carta debe estar entre 1 y 12.";
        }

        if ($palo && !in_array($palo, ['ESPADAS', 'OROS', 'COPAS', 'BASTOS'])) {
            $error = "El palo de la carta no es válido.";
        }

        if (!$error && $numero && $palo) {
            $cartaSeleccionada = new Carta((int)$numero, $palo);
        }

        $this->pages->render("muestraCarta", [
            "carta" => $cartaSeleccionada,
            "error" => $error
        ]);
    }
}
