<?php
// Inicializar la variable que servirá como contador
$numero = 1;

// Bucle while para recorrer los primeros 40 números naturales
while ($numero <= 40) {
    // Calcular el cuadrado del número
    $cuadrado = $numero * $numero;
    
    // Mostrar el número y su cuadrado
    echo "El cuadrado de " . $numero . " es: " . $cuadrado . "<br>";
    
    // Incrementar el contador
    $numero++;
}
?>