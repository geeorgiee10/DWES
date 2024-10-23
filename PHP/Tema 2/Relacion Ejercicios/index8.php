

<?php
// Definir la altura de la pirámide (5 niveles)
$altura = 5;

// Bucle para generar la pirámide
for ($i = 1; $i <= $altura; $i++) {
    // Pintar los espacios en blanco para alinear la pirámide
    echo str_repeat("&nbsp;", ($altura - $i) * 2);

    // Si es la primera fila, solo imprime un asterisco
    if ($i == 1) {
        echo "*";
    } 
    // Si es la última fila, imprime la base completa de asteriscos
    else if ($i == $altura) {
        echo str_repeat("*", 2 * $i - 1);
    } 
    // Para las filas intermedias, imprime asteriscos solo al inicio y al final
    else {
        echo "*"; // Primer asterisco
        echo str_repeat("&nbsp;", (2 * $i - 3) * 2); // Espacios internos
        echo "*"; // Último asterisco
    }

    // Salto de línea
    echo "<br>";
}
?>


