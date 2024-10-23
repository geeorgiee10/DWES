<?php
    $radio = 20;
    $longitud = 2 * pi() * $radio;
    printf(round($longitud,2). "<br>");
    $superficie = pi() * pow($radio,2);
    printf(round($superficie,2) . "<br>");
    $volumen = (4/3) * pi() * pow($radio,3);
    printf(round($volumen,2) . "<br>");
?>
