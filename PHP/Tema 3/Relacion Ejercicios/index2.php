<?php
    function suma($numero1,$numero2){
        $resultado = 0;

        if(is_numeric($numero1) && is_numeric($numero2)){
            $resultado = $numero1 + $numero2;
            
        }
        else{
            echo "Los valores no son numericos";
        }
        return $resultado;
    }

function resta($numero1,$numero2){
    $resultado = 0;

    if(is_numeric($numero1) && is_numeric($numero2)){
        $resultado = $numero1 - $numero2;
        
    }
    else{
        echo "Los valores no son numericos";
    }
    return $resultado;
}

function multiplicar($numero1,$numero2){
    $resultado = 0;

    if(is_numeric($numero1) && is_numeric($numero2)){
        $resultado = $numero1 * $numero2;
        
    }
    else{
        echo "Los valores no son numericos";
    }
    return $resultado;
}

function dividir($numero1,$numero2){
    $resultado = 0;

    if(is_numeric($numero1) && is_numeric($numero2)){
        $resultado = $numero1 / $numero2;
        
    }
    else{
        echo "Los valores no son numericos";
    }
    return $resultado;
}

function calculadora($num1, $num2, $op){
    if (isset($_GET['num1']) && isset($_GET['num2']) && isset($_GET['op'])) {
    if(is_numeric($num1) && is_numeric($num2)){
        switch($op){
            case "+":
                echo "La suma de $num1 + $num2 es: " . suma($num1,$num2);
                break;
            case "-":
                echo "La suma de $num1 + $num2 es: " . resta($num1,$num2);
                break;
            case "*":
                echo "La suma de $num1 + $num2 es: " . multiplicar($num1,$num2);
                break;
            case "/":
                if ($num2 != 0) {
                    echo "La suma de $num1 + $num2 es: " . dividir($num1,$num2);
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
}
?>