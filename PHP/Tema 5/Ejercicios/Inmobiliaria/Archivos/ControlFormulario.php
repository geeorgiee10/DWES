<?php 
//Incluir archivo para mostrar resultados
include "resultado.php";

function escribeError($error){
    echo "<span style='color: red'>".$error."</span>";

}


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    function filtrado($datos){
        $datos = trim($datos);
        $datos = stripslashes($datos); 
        $datos = htmlspecialchars($datos); 
        return $datos;
    }
    //Verificar los datos de la etiqueta input type text
    //Verificar direccion
    if(empty($_POST["direccion"])){
        $errores["direccion"] = "¡Se requiere la dirección de la vivienda!";
    }
    else {
        $direccion = filtrado($_POST["direccion"]);
    }
    //Verificar Precio
    $precio_vivienda =$_POST["precio"];
    $precio_vivienda = filter_var($precio_vivienda, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if(!filter_var ($precio_vivienda, FILTER_VALIDATE_FLOAT)){
        $errores["precio"] = "¡El precio debe ser un valor numerico!";
    }
    if($precio_vivienda < 0){
        $errores["precio"] = "¡El precio no puede ser negativo!";
    }
    //Validar Tamaño
    $tamaño_vivienda =$_POST["tamano"];
    $tamaño_vivienda = filter_var($tamaño_vivienda, FILTER_SANITIZE_NUMBER_INT);
    if(!filter_var ($tamaño_vivienda, FILTER_VALIDATE_INT)){
        $errores["tamano"] = "¡El tamaño debe ser un valor numerico!";
    }
    if($tamaño_vivienda < 0){
        $errores["precio"] = "¡El tamaño no puede ser negativo!";
    }

    //Validar la imagen comprobando si no existe la carpeta crearla y si existe guardar la foto
    if (isset($_FILES["foto"])) {
        $directorioSubida = "../fotos/";
        $tama = $_FILES["foto"]["size"];
    
        if ($tama > 100 * 1024) { 
            header("Location: errorFoto.php?error=El tamaño del archivo supera los 100KB");
            exit();
        }
    
    
        if (!is_dir($directorioSubida)) {
            mkdir($directorioSubida, 0777, true);
        }

        $nombreFoto = basename($_FILES["foto"]["name"]); 
        move_uploaded_file($_FILES["foto"]["tmp_name"], $directorioSubida . basename($_FILES["foto"]["name"]));
    
    }
    
    // Si no hay errores, se llama a la funcion para mostrar los resultados que esta guardada en resultados.php
    if (empty($errores)) {
        mostrarResultados();
    }
}

?>