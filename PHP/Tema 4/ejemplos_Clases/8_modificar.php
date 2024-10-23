<?php
/* Si se quiere modificar el contenido del array al recorrerlo 
 * con foreach hay que utilizar una referencia 
 * al declarar las variables del bucle.
 */

	$arr1 = array(
		"Viernes" => 22,
		"Sábado" => 34
	);
	/* no modifica el array */
        echo "En este ejemplo no modificamos el contenido del array <br>";
	foreach ($arr1 as $cantidad) {
		$cantidad = $cantidad * 2;		
	}
	print_r($arr1);
	echo "<br>";
	/* modifica el array */
        echo " si se hace por referencia si se modifica el valor:<br>";
	foreach ($arr1 as &$cantidad) {
		$cantidad = $cantidad * 2;			
	}	
	print_r($arr1);

