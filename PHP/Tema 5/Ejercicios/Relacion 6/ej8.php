<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        Selecciona imagen para subir:
        <input type="file" name="imageToUpload" accept="image/*" required>
        <input type="submit" value="Subir Imagen">
    </form>
</body>
</html>


<?php
$dir = 'images';

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imageToUpload'])) {
    $targetFile = $dir . '/' . $_FILES['imageToUpload']['name'];
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    $check = getimagesize($_FILES['imageToUpload']['tmp_name']);
    if($check !== false) {
        if (!file_exists($targetFile)) {
            if (move_uploaded_file($_FILES['imageToUpload']['tmp_name'], $targetFile)) {
                echo "La imagen ". htmlspecialchars(basename($_FILES['imageToUpload']['name'])). " ha sido subida.<br>";
            } 
            else {
                echo "Lo siento, hubo un error al subir la imagen.<br>";
            }
            
        } else {
            echo "La imagen ya existe.<br>";
        }
    } else {
        echo "El archivo no es una imagen.<br>";
    }
}

echo "<h2>Imágenes en el directorio '$dir':</h2>";
if ($handle = opendir($dir)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo "<img src='$dir/$entry' style='width: 150px; margin: 5px;' alt='$entry'><br>";
        }
    }
    closedir($handle);
}
?>


