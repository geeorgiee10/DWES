<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /*Declaracion de variables*/ 
    $entero = 4;
    $numero = 4.5;
    $cadena = "cadena";
    $bool = TRUE;
    /*Cambio de tipo de una variable*/
    $a = 5;
    echo gettype($a);
    echo ("<br>");
    $a = "Hola";
    echo gettype($a);
    ?>
</body>
</html>