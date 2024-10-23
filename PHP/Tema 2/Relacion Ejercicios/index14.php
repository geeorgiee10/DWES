<?php
// Iniciar el HTML
echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Tabla de Números en Diferentes Bases</title>";

echo "</head>";
echo "<body>";


// Iniciar la tabla
echo "<table border = '1'>";
echo "<tr>";
echo "<th>Decimal</th>";
echo "<th>Binario</th>";
echo "<th>Octal</th>";
echo "<th>Hexadecimal</th>";
echo "</tr>";
// Bucle para los 20 primeros números
for ($i = 1; $i <= 20; $i++) {
    echo "<tr>";
    // Decimal
    printf("<td>%02d</td>", $i);
    // Binario
    printf("<td>%b</td>", $i);
    // Octal
    printf("<td>%o</td>", $i);
    // Hexadecimal
    printf("<td>%X</td>", $i);
    echo "</tr>";
}

echo "</table>";
echo "</body>";
echo "</html>";
?>
