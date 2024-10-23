<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $a = 5;
    echo $a;
    echo ("<br>");
    $b = $a;
    echo "valor de a: ", $a,", valor de b: ",$b;
    echo ("<br>");
    $c=$a;
    echo "valor de c: ", $c;
    echo ("<br>");
    $a = 8;
    echo "valor de a: ", $a,", valor de b: ", $b," valor de c: ",$c;
    ?>
</body>
</html>