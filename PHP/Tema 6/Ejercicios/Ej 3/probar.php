<?php

require_once 'animal.php';
require_once 'gato.php';

$miGato = new Gato(3, true, "negro");

echo "Datos del gato:\n";
echo "Especie: " . $miGato->especie . "\n";
echo "Edad: " . $miGato->edad . " años\n";
echo "Es doméstico: " . ($miGato->esDomestico ? "Sí" : "No") . "\n";
echo "Color del pelaje: " . $miGato->colorPelaje . "\n";
echo "Energía: " . $miGato->energia . "%\n";

echo "\nEl gato hace un sonido:\n";
$miGato->hacerSonido();

echo "\nEl gato ronronea:\n";
$miGato->ronronear();

echo "\nEl gato empieza a jugar:\n";
$miGato->jugar();
$miGato->jugar();
$miGato->jugar();
$miGato->jugar();

?>
