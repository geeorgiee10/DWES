<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Fichero recibido:
    Nombre: <?= $_FILES[ "foto" ][ "name" ]."<br>"?>
    Tamaño: <?= $_FILES[ "foto" ][ "size" ]." bytes"."<br>"?>
    Temporal: <?= $_FILES[ "foto" ][ "tmp_name" ]."<br>"?>
    Tipo: <?= $_FILES[ "foto" ][ "type" ]."<br>"?>
    Error: <?= $_FILES[ "foto" ][ "error" ]."<br>"?>
</body>
</html>