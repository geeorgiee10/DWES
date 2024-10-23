<?php

/*Arrays multidimensionales: Varios arrays dentro de ese array
 */

$contactos = array(
    array(  // aqui tengo todos los indices asociativos de mis contactos
        'nombre' =>'Ana',
        'apellidos' => 'García',
        'telefono' => '677564732'
    ),
    array(
        'nombre' =>'Andres',
        'apellidos' => 'González',
        'telefono' => '677564442'
    ),
    array(
        'nombre' =>'Marta',
        'apellidos' => 'Pérez',
        'telefono' => '777564731'
    )
    
);
echo "Mis contactos: <br>";
echo "<pre>";
var_dump($contactos);

// para acceder a los elementos del array
// por ejemplo en el indice 1 del indice nombre del segundo array
echo "el nombre de mi primer contacto es:<br>";
echo $contactos[0]['nombre']."<br>";
echo "el teléfono del segundo contacto es:<br>";
echo $contactos[1]['telefono']."<hr/>";

// recorremos el array y mostramos los nombres de los contactos
echo "Esta es la lista de nombres de mis contactos <br>";
foreach ($contactos as $key => $contacto) {//recorro el array
    echo "$key : ";
    echo $contacto['nombre']."<br>";
}

