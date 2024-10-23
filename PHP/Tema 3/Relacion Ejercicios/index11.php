<?php
function calcularFactorial($numero) {
    if ($numero < 0) {
        throw new InvalidArgumentException("El argumento no puede ser un número negativo.");
    }

    $factorial = 1;

    for ($i = 1; $i <= $numero; $i++) {
        $factorial *= $i;
    }

    return $factorial;
}

try {
    echo "El factorial de 5 es: " . calcularFactorial(5) . "<br>"; 
    echo "El factorial de 0 es: " . calcularFactorial(0) . "<br>";
    echo "El factorial de -3 es: " . calcularFactorial(-3) . "<br>";
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
}
?>
