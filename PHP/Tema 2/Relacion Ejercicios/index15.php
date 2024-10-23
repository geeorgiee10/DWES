<?php
    if (isset($_GET['num1']) && isset($_GET['num2']) && isset($_GET['op'])) {
        // Recoger los valores de la URL
        $num1 = $_GET['num1'];
        $num2 = $_GET['num2'];
        $op = $_GET['op'];


        if(is_numeric($num1) && is_numeric($num2)){
            switch($op){
                case "suma":
                    $resultado = $num1 + $num2;
                    echo "La suma de $num1 + $num2 es: $resultado";
                    break;
                case "resta":
                    $resultado = $num1 - $num2;
                    echo "La resta de $num1 - $num2 es: $resultado";
                    break;
                case "multiplicacion":
                    $resultado = $num1 * $num2;
                    echo "La multiplicacion de $num1 * $num2 es: $resultado";
                    break;
                case "division":
                    if ($num2 != 0) {
                        $resultado = $num1 / $num2;
                        echo "La división de $num1 entre $num2 es: $resultado";
                    } else {
                        echo "Error: No se puede dividir entre 0.";
                    }
                    break;
                default:
                    echo "Operación no válida. Usa 'suma', 'resta', 'multiplicacion' o 'division'.";
                    break;
            }
        }
        else{
            echo "Los valores no son numericos";
        }
    }
    else{
        echo "No se han ingresado los valores";
    }
?>
