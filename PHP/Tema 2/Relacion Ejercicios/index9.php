<?php
// Arrays con los nombres de los números en inglés y en español
$numeros_ingles = ["One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten"];
$numeros_espanol = ["Uno", "Dos", "Tres", "Cuatro", "Cinco", "Seis", "Siete", "Ocho", "Nueve", "Diez"];

// Imprimir el encabezado HTML
echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Traducción de Números</title>";
echo "</head>";
echo "<body>";


// Crear la tabla
echo "<table border='1'>";
echo "<tr>";
    echo "<th>Número en Inglés</th>";
    echo "<th>Número en Español</th>";
echo "</tr>";

for ($i = 0; $i < 10; $i++) {
    echo "<tr>";
        echo "<td>{$numeros_ingles[$i]}</td>";
        echo "<td>{$numeros_espanol[$i]}</td>";
    echo "</tr>";
}

echo "</table>";

echo "</body>";
echo "</html>";
?>
