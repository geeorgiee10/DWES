<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de la Foto</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <h1>Inserción de vivienda</h1>
    <p>No se ha podido realizar la inserción debido a los siguientes errores</p>
    <ul>
        <li>
        <?php
        // Mostrar el mensaje de error pasado como parámetro en la URL
        if (isset($_GET['error'])) {
            echo htmlspecialchars($_GET['error']);
        } 
        else {
            echo "Ocurrió un error desconocido.";
        }
        ?>
        </li>
    </ul>
    <a href="formulario.php">Volver al formulario</a>
</body>
</html>
