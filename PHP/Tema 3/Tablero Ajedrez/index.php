<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero de ajedrez</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
    // Usar include para llamar al archivo funciones donde esta todo el codigo que genera el tablero
    include "funciones.php";

    // Llamar a la funcion que genera el tablon de ajedrez
    hacerTablero();
    ?>
</body>
</html>
