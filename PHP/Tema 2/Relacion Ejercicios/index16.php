<?php
// Comprobar si los parámetros 'num1' y 'num2' están presentes en la URL
if (isset($_GET['num1']) && isset($_GET['num2'])) {
    // Recoger los valores de la URL
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];

    // Comprobar si los valores recibidos son numéricos
    if (is_numeric($num1) && is_numeric($num2)) {
        // Convertir los valores a enteros
        $num1 = (int)$num1;
        $num2 = (int)$num2;

        // Comprobar si el primer número es menor que el segundo
        if ($num1 < $num2) {
            // Mostrar los números comprendidos entre 'num1' y 'num2'
            echo "Los números comprendidos entre $num1 y $num2 son: <br>";
            for ($i = $num1 + 1; $i < $num2; $i++) {
                echo "$i<br>";
            }
        } else {
            echo "Error: El primer número debe ser menor que el segundo.";
        }
    } else {
        echo "Error: Los valores ingresados no son numéricos.";
    }
} else {
    echo "Por favor, ingrese los parámetros 'num1' y 'num2' en la URL.";
}
?>
