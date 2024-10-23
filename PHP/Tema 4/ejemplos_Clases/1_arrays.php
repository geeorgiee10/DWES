<?php

$miArray[] = 45; // Empieza con índice 0
$miArray[] = 2; // Índice 1
$miArray[2] = 5; // Asignación directa a un índice en concreto
echo " Este es el primer array que hemos creado <br>";
print_r($miArray);
$otroArray = array ( 34,55,77); // usando la funcion array
echo "<br> <br>Este array se ha creado con la función array: <br>";
print_r($otroArray);
$miOtroArray = [33,44,55,66]; // usando corchetes es más limpio
echo "<br> <br>Este array se ha creado usando corchetes: <br>";
print_r($miOtroArray);
// se pueden añadir índices numéricos y alfanuméricos

$otroArray = array ( "nombre"=> "Maria", "edad"=>22, 3=>"soltera"); 
echo "<br> <br>Ejemplo con índices alfanuméricos: <br>";
print_r($otroArray);

$miOtroArray = ["nombre"=> "Maria", "edad"=>22, 3=>"soltera"];
echo "<br> <br>El resultado es el mismo con corchetes: <br>";
print_r($miOtroArray);
