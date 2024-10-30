<?php

$directorioSubida = "subidos/";

if (isset($_FILES["fichero"])) {

    $tam = $_FILES["fichero"]["size"];

    if ($tam > 256 * 1024) { 
        echo "<br>Demasiado grande";
        return;
    }

    echo "Nombre del fichero: " . $_FILES["fichero"]["name"];
    echo "<br>Nombre temporal del fichero en el servidor: " . $_FILES["fichero"]["tmp_name"];

    if (!is_dir($directorioSubida)) {
        mkdir($directorioSubida, 0777, true);
    }

    $res = move_uploaded_file($_FILES["fichero"]["tmp_name"], $directorioSubida . $_FILES["fichero"]["name"]);

    if ($res) {
        echo "<br>Fichero guardado correctamente.";
    } else {
        echo "<br>Error al guardar el fichero.";
    }

} else {
    echo "<br>No se ha seleccionado ningún archivo.";
}
?>
