<?php
// Comprobar si el parámetro 'longitud' está presente en la URL
if (isset($_GET['longitud'])) {
    // Recoger el valor de la longitud de la URL
    $longitud = $_GET['longitud'];

    // Comprobar si la longitud es numérica y está dentro del rango permitido
    if (is_numeric($longitud) && $longitud >= 10 && $longitud <= 1000) {
        $longitud = (int)$longitud; // Convertir la longitud a un entero
    } else {
        // Si no es válida, usar un valor predeterminado
        $longitud = 100;
        echo "Error: La longitud debe estar entre 10 y 1000 píxeles. Usando valor predeterminado de 100 píxeles.<br>";
    }
} else {
    // Si no se recibe ningún parámetro, usar un valor predeterminado
    echo "No se ha recibido ninguna longitud.<br>";
}

// Mostrar la línea usando SVG
echo "<svg height='10' width='$longitud'>
        <line x1='0' y1='0' x2='$longitud' y2='0' style='stroke:rgb(0,0,0);stroke-width:2' />
      </svg>";
?>
