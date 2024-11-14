<!DOCTYPE html>
<html>
<head>
    <title>Creación de Cookie</title>
    <style>



    </style>
</head>
<body>
    <h1>Creación y Destrucción de Cookie</h1>

    

    <form method="post">
        <label for="nombre_usuario">Nombre de usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario">
        <br><br>
        <label for="duracion_cookie">Duración cookie (entre 1 y 60 segundos):</label>
        <input type="text" id="duracion_cookie" name="duracion_cookie">
        <br><br>
        <input type="submit" value="Crear cookie">
    </form>


    <?php
    // Comprobamos si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtenemos los datos del formulario
        $nombreUsuario = $_POST['nombre_usuario'];
        $duracionCookie = intval($_POST['duracion_cookie']);

        // Validamos la duración de la cookie
        if ($duracionCookie < 1 || $duracionCookie > 60) {
            echo "<p>La duración de la cookie debe estar entre 1 y 60 segundos.</p>";
        } else {
            // Creamos la cookie
            setcookie("nombre_usuario", $nombreUsuario, time() + $duracionCookie);
            echo "<p>Hola, ". $nombreUsuario .". Bienvenido a nuestra página web</p>";
        }
    }
    ?>
</body>
</html>