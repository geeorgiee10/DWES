<?php
$provincias = [
    "Almería",
    "Cádiz",
    "Córdoba",
    "Granada",
    "Huelva",
    "Jaén",
    "Málaga",
    "Sevilla"
];

echo "Array original de provincias:<br>";
echo implode(", ",$provincias);

unset($provincias[2]);

echo "<br>Array después de borrar el elemento de índice 2 (Córdoba):<br>";
echo implode(", ", $provincias);
?>
