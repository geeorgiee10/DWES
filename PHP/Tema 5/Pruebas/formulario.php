<?php 
    echo "La edad es: " . $_REQUEST['edad'];
    echo "<br>";
    echo "Tus dudas son: " . $_REQUEST['dudas'];
    echo "<br>";
    echo "Estudios realizados: ";
    $extras = $_REQUEST['extras'];
    foreach ($extras as $extra)
    print ("·$extra ");
    echo "<br>";
    echo "Colores: " . $_REQUEST["color"];
?>