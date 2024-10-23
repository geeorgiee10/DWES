<?php

/* Algunos operadores están disponibles para los arrays,
 * pero su significado no es exactamente el mismo. Por ejemplo,
 * el operador identico solo sera verdadero si los dos tienen todos los 
 * elementos iguales tanto en clave como en valor y además están en el mismo 
 * orden. 
 * Para el operador "igual", el orden de las claves no importa
 */
$arra1 = array(
    1 => "3000",
    2 => "4000",
);
$arra2 = array(
    1 => 3000,
    2 => 4000,
);
$arra3 = array(
    1 => "4000",
    2 => "3000",
);
if($arra1 == $arra2){
    echo "arr1 y arr2 son iguales <br>";
}  else {
     echo "arr1 y arr2 no son iguales <br>";
}
if($arra1 == $arra3){
    echo "arr1 y arr3 son iguales <br>";
}  else {
     echo "arr1 y arr3 no son iguales <br>";
}
if($arra1 === $arra2){
    echo "arr1 y arr2 son idéntico <br>";
}  else {
     echo "arr1 y arr2 no son idénticos <br>";
}
if($arra1 === $arra3){
    echo "arr1 y arr3 son idéntico <br>";
}  else {
     echo "arr1 y arr3 no son idénticos <br>";
}

