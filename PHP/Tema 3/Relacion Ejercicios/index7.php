<?php
function esPrimo($numero) {
    if ($numero < 2) {
        return false;
    }

    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) {
            return false;
        }
    }

    return true;
}

// Programa para probar la función
function probarNumerosPrimos() {
    $numeros = [1, 2, 3, 4, 5, 16, 17, 19, 20, 23, 24, 29];
    
    foreach ($numeros as $numero) {
        if (esPrimo($numero)) {
            echo "$numero es primo\n";
        } else {
            echo "$numero no es primo\n";
        }
    }
}

probarNumerosPrimos();
?>
