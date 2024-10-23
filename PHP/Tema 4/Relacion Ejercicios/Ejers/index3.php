<?php
function generarArrayAleatorio($tamaño) {
    $array = [];
    for ($i = 0; $i < $tamaño; $i++) {
        $array[] = rand(0, 1); 
    }
    return $array;
}

function calcularComplementario($array) {
    $complementario = [];
    foreach ($array as $valor) {
        $complementario[] = $valor == 0 ? 1 : 0; 
    }
    return $complementario;
}

$tamañoArray = 10;
$arrayOriginal = generarArrayAleatorio($tamañoArray);

$arrayComplementario = calcularComplementario($arrayOriginal);

echo "Array Original: <br>";
echo "A: " . implode("&nbsp;",$arrayOriginal);

echo "<br>Array Complementario: <br>";
echo "A: " . implode("&nbsp;",$arrayComplementario);

?>