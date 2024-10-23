<?php

$numeros = array();
for ($i = 0; $i < 15; $i++) {
    $numeros[] = rand(1, 100);
}

echo "Array original:<br>";
echo implode(", " ,$numeros);

$ultimo = array_pop($numeros);
array_unshift($numeros, $ultimo);

echo "<br>Array rotado:<br>";
echo implode(", " ,$numeros);
?>
