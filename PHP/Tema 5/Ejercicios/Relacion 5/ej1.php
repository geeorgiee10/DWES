<?php 
    echo "El nombre es: " . $_REQUEST['nombre'];
    echo "<br>";
    echo "Los apellidos es: " . $_REQUEST['apellidos'];
    echo "<br>";
    echo "La fecha es: " . $_REQUEST['fecha'];
    echo "<br>";
    echo "El correo es: " . $_REQUEST['correo'];
    echo "<br>";
    echo "Los lenguajes que conoce son: ";
    $lenguajes = $_REQUEST['lenguajes'];
    foreach ($lenguajes as $lenguaje)
    print ("·$lenguaje ");
    echo "<br>";
    echo "¿Sabes crear paginas web estaticas?: " . $_REQUEST["pagWeb"];
    echo "<br>";
    echo "Los comentarios son: " . $_REQUEST['dudas'];
    echo "<br>";
    echo "La contraseña es: " . $_REQUEST['contraseña'];
?>