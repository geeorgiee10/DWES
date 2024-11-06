<?php

try {
    if (!file_exists('perro.php')) {
        throw new Exception("Error: No se pudo cargar el archivo 'Perro.php'.");
    }
    require_once 'Perro.php';
} catch (Exception $e) {
    die($e->getMessage());
}

$labrador = new Perro("grande", "Labrador", "amarillo", "Max");
echo "\nPropiedades del primer perro (Labrador):\n";
$labrador->mostrar_propiedades();
$labrador->speak();

$caniche = new Perro("pequeño", "Caniche", "blanco", "Coco");
echo "\nPropiedades del segundo perro (Caniche):\n";
$caniche->mostrar_propiedades();
$caniche->speak();

echo "\nIntentando actualizar el nombre del labrador:\n";
$perro_error_message = $labrador->set_nombre("Luna");
echo $perro_error_message ? "Nombre actualizado correctamente\n" : "Nombre no modificado\n";

$perro_error_message = $labrador->set_nombre("NombreMuyLargoQueNoEsValido");
echo $perro_error_message ? "Nombre actualizado correctamente\n" : "Nombre no modificado\n";

$perro_error_message = $labrador->set_tamaño("gigante");
echo $perro_error_message ? "Tamaño actualizado correctamente\n" : "Tamaño no modificado\n";

?>
