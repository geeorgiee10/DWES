<?php	
/* ejemplo de cómo utilizar set_error_handler() para manejar los 
 * errores con una función propia
 */

	function manejadorErrores($errno, $str, $file, $line){
		echo "Ocurrió el error: $errno";
	}
	set_error_handler("manejadorErrores");
	$a = $b; // causa error, $b no está inicializada