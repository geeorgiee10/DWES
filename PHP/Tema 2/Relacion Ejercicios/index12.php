<?php
// Tirar los dos dados al azar (valores entre 1 y 6)
$dado1 = rand(1, 6);
$dado2 = rand(1, 6);

// Mostrar los resultados de los dos dados
echo "Resultado del dado 1: " . $dado1 . "<br>";
echo "Resultado del dado 2: " . $dado2 . "<br>";

// Verificar si ha salido una pareja de valores iguales
if ($dado1 == $dado2) {
    echo "¡Ha salido una pareja de valores iguales!<br>";
} else {
    echo "No ha salido una pareja de valores iguales.<br>";
}

// Determinar el mayor de los dos valores
$mayor = max($dado1, $dado2);

// Mostrar el mayor valor obtenido
echo "El mayor valor de los dados es: " . $mayor . "<br>";
?>