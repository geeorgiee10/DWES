<?php

/* el operador + utilizado con dos arrays devuelve su unión
 * el array resultante contendrá primero los elementos del primer array
 * y a continuación los del segundo, pero sin repetir las claves.
 * Si hay elementos con la misma clave en los dos arrays,
 * el del segundo no se añade al resultado
 */

$arr1 = array(
    10 => "3000",
    20 => "4000",
    30 => "6000",
);
print_r($arr1);
echo "<br>";
$arr2 = array(
    10 => "8000",
    15 => "6000",
    20 => "4000",
); 
print_r($arr2);
echo "<br>";
$arr3 = $arr1 + $arr2;
print_r($arr3);

    
    
                