<?php
if (isset($_GET['num1']) && isset($_GET['num2'])) {
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];

    if (is_numeric($num1) && is_numeric($num2)) {
        $num1 = (int)$num1;
        $num2 = (int)$num2;

        if ($num1 < $num2) {
            echo "Los números impares comprendidos entre $num1 y $num2 son: <br>";
            for ($i = $num1 + 1; $i < $num2; $i++) {
                if ($i % 2 != 0) { 
                    echo "$i<br>";
                }
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

