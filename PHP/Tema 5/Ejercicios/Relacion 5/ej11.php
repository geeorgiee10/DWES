<!DOCTYPE html>
<html>
<head>
    <title>Calculadora en PHP</title>
</head>
<body>
    <form method="post" action="">
        <input type="text" name="num1" placeholder="Número 1" required>
        <input type="text" name="num2" placeholder="Número 2" required>
        <br><br>
        <button type="submit" name="operacion" value="sumar">Sumar</button>
        <button type="submit" name="operacion" value="restar">Restar</button>
        <button type="submit" name="operacion" value="multiplicar">Multiplicar</button>
        <button type="submit" name="operacion" value="dividir">Dividir</button>
        <br><br>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $numero1 = $_POST["num1"];
        $numero2 = $_POST["num2"];
        
        $num1 = filter_var($numero1,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $num2 = filter_var($numero2,  FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $operacion = filter_input(INPUT_POST, 'operacion', FILTER_SANITIZE_SPECIAL_CHARS);


        if (filter_var($numero1,FILTER_VALIDATE_FLOAT) && filter_var($numero2,FILTER_VALIDATE_FLOAT)) {
            switch ($operacion) {
                case 'sumar':
                    $resultado = $numero1 + $numero2;
                    break;
                case 'restar':
                    $resultado = $numero1 - $numero2;
                    break;
                case 'multiplicar':
                    $resultado = $numero1 * $numero2;
                    break;
                case 'dividir':
                    if ($numero2 != 0) {
                        $resultado = $numero1 / $numero2;
                    } else {
                        $resultado = "No se puede dividir por cero";
                    }
                    break;
                default:
                    $resultado = "Operación no válida";
                    break;
            }

            echo "El resultado es: " . $resultado;
        } 
        else {
            echo "Por favor, ingrese números válidos.";
        }
    }
    ?>
</body>
</html>
