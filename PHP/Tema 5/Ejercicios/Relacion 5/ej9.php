<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ej9Validacion1</title>
</head>
<body>
<?php
    function escribeError($error){
        echo "<span style='color: red'>".$error."</span>";

    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        function filtrado($datos){
            $datos = trim($datos); // Elimina espacios antes y después de los datos
            $datos = stripslashes($datos); // Elimina backslashes \
            $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
            return $datos;
        }
        //verificamos los datos
        // nombre ==========================================
        if(empty($_POST["nombre"])){
            $errores["nombre"] = "El nombre es requerido";
        }
        else {
            $nombre_usuario = filtrado($_POST["nombre"]);
            if (!preg_match("/^[a-zA-Z]+$/", $nombre_usuario)){
                $errores["nombre"] = "El nombre solo ha de estar compuesto por letras.";
            }
        }
        // telefono ===================================
        $telefono_usuario =$_POST["telefono"];
        $telefono_usuario = filter_var($telefono_usuario, FILTER_SANITIZE_NUMBER_INT);
        if(strlen($_POST["telefono"]) != 9 || !preg_match("/^[0-9]+$/", $telefono_usuario)){
            $errores["telefono"] = "El telefono han de ser 9 numeros";
        }
        // El email es obligatorio y ha de tener formato adecuado
        $email_usuario =$_POST["email"];
        $email_usuario = filter_var($email_usuario, FILTER_SANITIZE_EMAIL);
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || empty($_POST["email"])){
            $errores["email"] = "No se ha indicado email o el formato no es correcto";
        }
        if (!isset($errores) )//no hay errores, procesamos datos formulario y continuamos, lo simularmos con un exit
            header("Location: Ej9_validacion1_todo_ok.html");
        else//tebenemos errores que corregir
            echo "<h2>FORMULARIO CON ERRORES:</h2>";
    }
    else{
        echo "<h2>FORMULARIO Y RESULTADO EN UN ÚNICO ARCHIVO</h2>";
    }
 ?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <p>Escriba los datos siguientes:</p>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php (isset($nombre_usuario)?print($nombre_usuario):"");?>"/> <?php (isset($errores) && isset($errores["nombre"]))? escribeError($errores["nombre"]):"";?> <br/>
    <br>
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" value="<?php (isset($telefono_usuario)?print($telefono_usuario):"");?>"/> <?php (isset($errores) && isset($errores["telefono"]))? escribeError($errores["telefono"]):"";?><br/>
    <br>
    <label for="email">Correo:</label>
    <input type="text" id="email" name="email" value="<?php (isset($email_usuario)?print($email_usuario):"");?>"/> <?php (isset($errores) && isset($errores["email"]))? escribeError($errores["email"]):"";?> <br/>
    <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                echo "<p><a href='ej9.php'>Volver al principio</a></p>";
            }
        ?>
    <br>
    <input type="submit" value="Enviar">
</form>

</body>
</html>