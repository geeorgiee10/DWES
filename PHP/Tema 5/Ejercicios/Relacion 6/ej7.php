<?php
$dir = 'uploads';

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
    echo "Directorio creado: $dir<br>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $targetFile = $dir . '/' . basename($_FILES['fileToUpload']['name']);
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
        echo "El archivo ". htmlspecialchars(basename($_FILES['fileToUpload']['name'])). " ha sido subido.<br>";
    } else {
        echo "Lo siento, hubo un error subiendo el archivo.<br>";
    }
}

if ($handle = opendir($dir)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo "$entry<br>";
        }
    }
    closedir($handle);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        Selecciona archivo para subir:
        <input type="file" name="fileToUpload" required>
        <input type="submit" value="Subir Archivo">
    </form>
</body>
</html>
