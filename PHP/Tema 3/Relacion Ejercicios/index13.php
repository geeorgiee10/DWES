<?php
$cadena = "Hola, mundo. ¿Qué tal estás hoy?";

echo "Cadena original: $cadena<br>";

$primeros12 = substr($cadena, 0, 12);
echo "Los 12 primeros caracteres: $primeros12<br>";

$longitud = strlen($cadena);
echo "La longitud de la cadena es $longitud<br>";

$posM = strpos($cadena, "Mundo");
echo "Buscamos la posición en la que empieza la palabra Mundo con la M mayúscula: $posM<br>";

$posm = strpos($cadena, "mundo");
echo "Buscamos la posición en la que empieza la palabra mundo con la m minúscula: $posm<br>";

$mayusculas = strtoupper($cadena);
echo "Convertimos a mayúsculas: $mayusculas<br>";

$mayusculasUTF8 = mb_strtoupper($cadena, 'UTF-8');
echo "Convertimos a mayúsculas con UTF-8: $mayusculasUTF8<br>";

$minusculas = strtolower($cadena);
echo "Todo en minúsculas: $minusculas<br>";

$posPunto = strpos($cadena, '.');
$desdePunto = substr($cadena, $posPunto);
echo "Devuelve a partir del punto (incluido): $desdePunto<br>";

$cadenaReversa = strrev($cadena);
echo "La cadena al revés: $cadenaReversa<br>";
echo "La función mb_strlen no tiene alternativas para soportar Unicode.<br>";
?>
