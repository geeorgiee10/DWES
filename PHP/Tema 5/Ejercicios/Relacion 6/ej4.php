<?php
	$contenido = file_get_contents("fichero_ejemplo.txt");
	echo "Contenido del fichero: $contenido<br>";
	$res = file_put_contents("fichero_salida.txt", "Fichero creado con file_put_contents");
	if($res){
		echo "Fichero creado con éxito";
	}else{
		echo "Error al crear el fichero";
	}
?>
<!--
Este programa lee el contenido de fichero_ejemplo.txt con file_get_contents,
luego escribe en fichero_salida.txt "Fichero creado con file_put_contents"
y dice si se ha creado este nuevo fichero o no
-->
