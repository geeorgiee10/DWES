<?php
function calcularMCD($a, $b) {
    $a = abs($a);
    $b = abs($b);

    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;  // Resto de la división
        $a = $temp;
    }

    return $a;  // El MCD
}

echo "El MCD de 56 y 98 es: " . calcularMCD(56, 98)
?>
