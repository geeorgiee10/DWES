<?php 


include_once 'coche1.php';

echo "<h1>Datos del coche</h1>";

$coche = new Coche1();
echo "<ul>";
echo "<li>Marca: " . $coche->marca . "</li>";
echo "<li>Modelo: " . $coche->modelo . "</li>";
echo "<li>Color: " . $coche->color . "</li>";
echo "<li>Caballos: " . $coche->caballos . "</li>";
echo "<li>Velocidad: " . $coche->velocidad . "</li>";
echo "<li>Plazas: " . $coche->plazas . "</li>";
echo "</ul>";

$coche->color = "Amarillo";
echo "<h2>Cambiamos el color del coche y lo ponemos amarillo</h2>";
echo "<p>El nuevo color de mi coche es: " . $coche->color . "</p>";

for ($i = 0; $i < 4; $i++) {
    $coche->acelerar();
}
$coche->frenar();

echo "<h2>Mi coche va a acelerar 4 veces y a frenar una vez.</h2>";
echo "<p>Ésta es ahora la velocidad del coche: " . $coche->velocidad . "</p>";

$nuevoCoche = new Coche1();
$nuevoCoche->color = "Verde";
$nuevoCoche->modelo = "Gallardo";

echo "<h2>Creemos un nuevo coche su color será VERDE y el modelo GALLARDO</h2>";
echo "<h3>Datos del NUEVO coche</h3>";
echo "<ul>";
echo "<li>Marca: " . $nuevoCoche->marca . "</li>";
echo "<li>Modelo: " . $nuevoCoche->modelo . "</li>";
echo "<li>Color: " . $nuevoCoche->color . "</li>";
echo "<li>Caballos: " . $nuevoCoche->caballos . "</li>";
echo "<li>Velocidad: " . $nuevoCoche->velocidad . "</li>";
echo "<li>Plazas: " . $nuevoCoche->plazas . "</li>";
echo "</ul>";

?>
