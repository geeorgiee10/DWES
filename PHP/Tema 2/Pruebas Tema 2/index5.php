<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $a = "hola";
        $$a = "mundo";
        echo "$a ",$$a, "<br>";
        echo "$a $hola <br>";
        echo $$a;
    ?>
</body>
</html>