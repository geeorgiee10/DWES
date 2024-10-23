<?php
// Arrays asociativos :arrays con índices que son alfanuméricos
$personas = array(
    'nombre' => 'Belén',
    'apellidos' => 'Callejón Prieto',
    'web' => 'belen.es'
);
var_dump($personas);
echo "Esta persona se llama:  ".$personas['nombre']."<hr/>";

// otro ejemplo de array asociativo
$arr2 = array (
		"1111A" => "Juan Vera Ochoa",
		"1112A" => "Maria Mesa Cabeza",
		"1113A" => "Ana Puertas Peral"
	);	
// modificamos un elemento del array
	$arr2["1113A"] = "Ana Puertas Segundo";
// Mostramos todos los elementos de este array
        echo "Lista de personas: <br>";
        foreach ($arr2 as $nombre){
            echo "$nombre <br>";
        }
        echo "<hr/> Lista de personas con su código: <br>";
        foreach ($arr2 as $codigo => $nombre){
            echo "Código:  $codigo -  Nombre:  $nombre <br>";
        }
/* OJO: los parámetros que van por GET y por POST
 *  son también arrays asociativos
 */




