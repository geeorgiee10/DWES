<?php 

// Array para guardar los errores inicializandolo vacío
$errores = [];

// Si el formulario fue enviado por método POST se incluye el archivo ControlFormulario.php para validar errores
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "ControlFormulario.php";
} 

// Si no errores esta vacio, es decir hay errores, o no se ha enviado el formulario se carga el formulario
if (!empty($errores) || $_SERVER["REQUEST_METHOD"] != "POST") {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <h1>Inserción de vivienda</h1>
    <p>Introduzca los datos de la vivienda</p>
    <div id="container">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

            <div class="apartado">
                <label for="tipo">Tipo de Vivienda:</label>
                <select name="tipo" required>
                    <option value="piso">Piso</option>
                    <option value="adosado">Adosado</option>
                    <option value="chalet">Chalet</option>
                    <option value="casa">Casa</option>
                </select>
            </div>

            <div class="apartado">
                <label for="zona">Zona:</label>
                <select name="zona" required>
                    <option value="centro">Centro</option>
                    <option value="zaidin">Zaidín</option>
                    <option value="chana">Chana</option>
                    <option value="albaicin">Albaicín</option>
                    <option value="sacromonte">Sacromonte</option>
                    <option value="realejo">Realejo</option>
                </select>
            </div>

            <div class="apartado">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" value="<?php (isset($direccion)?print($direccion):"");?>">
            </div>
            <!--Si hay errores en la direccion salta este mensaje de error en rojo-->
            <?php (isset($errores) && isset($errores["direccion"]))? escribeError($errores["direccion"]):"";?>

            <div class="apartado">
                <label>Número de dormitorios:</label>
                <input type="radio" name="dormitorios" value="1"> 1
                <input type="radio" name="dormitorios" value="2"> 2
                <input type="radio" name="dormitorios" value="3"> 3
                <input type="radio" name="dormitorios" value="4"> 4
                <input type="radio" name="dormitorios" value="5"> 5
            </div>

            <div class="apartado">
                <label for="precio">Precio:</label>
                <input type="text" name="precio" required value="<?php (isset($precio_vivienda)?print($precio_vivienda):"");?>"> €
            </div>
            <!--Si hay errores en el precio salta este mensaje de error en rojo-->
            <?php (isset($errores) && isset($errores["precio"]))? escribeError($errores["precio"]):"";?>


            <div class="apartado">
                <label for="tamano">Tamaño:</label>
                <input type="text" name="tamano" required value="<?php (isset($tamaño_vivienda)?print($tamaño_vivienda):"");?>"> metros cuadrados
            </div>
            <!--Si hay errores en el tamaño salta este mensaje de error en rojo-->
            <?php (isset($errores) && isset($errores["tamano"]))? escribeError($errores["tamano"]):"";?>


            <div class="apartado">
                <label>Extras (marque los que procedan):</label>
                <input type="checkbox" name="extras[]" value="piscina">Piscina
                <input type="checkbox" name="extras[]" value="jardin">Jardín
                <input type="checkbox" name="extras[]" value="garaje">Garaje
            </div>

            <div class="apartado">
                <label for="foto">Foto:</label>
                <input type="file" name="foto" >
            </div>

            <div class="apartado">
                <label for="observaciones">Observaciones:</label>
                <textarea name="observaciones" rows="4" cols="50"></textarea>
            </div>

            <div class="apartado">
                <input type="submit" value="Insertar vivienda">
            </div>
        </form>
    </div>
</body>
</html>
<?php
}
?>