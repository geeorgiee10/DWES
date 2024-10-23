<?php
// Iniciar el HTML y definir los estilos para la tabla
echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Tablas de Multiplicar</title>";

echo "</head>";
echo "<body>";


// Iniciar la tabla HTML
echo "<table border = '1'>";

// Generar la cabecera de la tabla
echo "<thead>";
echo "<tr>";
for ($i = 1; $i <= 10; $i++) {
    echo "<th>Tabla del " . $i . "</th>";
}
echo "</tr>";
echo "</thead>";

// Generar el cuerpo de la tabla con todas las tablas de multiplicar
echo "<tbody>";
for ($j = 1; $j <= 10; $j++) {
    echo "<tr>";
    for ($i = 1; $i <= 10; $i++) {
        echo "<td>" . $i . " x " . $j . " = " . ($i * $j) . "</td>";
    }
    echo "</tr>";
}
echo "</tbody>";

// Cerrar la tabla y el HTML
echo "</table>";
echo "</body>";
echo "</html>";
?>
