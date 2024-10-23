<?php

	function mostrarArray($array){
		foreach($array as $arr) {
			echo $arr . " ";
		}
		echo "<br>";
	}

$arrayNumeros = array(12, 2, 64, 8, 11, 3, 6, 5);

//1.a
echo "Array original: <br>";
mostrarArray($arrayNumeros);

//1.b
sort($arrayNumeros);
echo "Array ordenado: <br>";
mostrarArray($arrayNumeros);

//1.c
echo "Longitud del array: " . count($arrayNumeros) . "<br>";

//1.d
$elementoABuscar = 5;
$indice = array_search($elementoABuscar, $arrayNumeros);
echo "El elemento $elementoABuscar se encuentra en el índice $indice";

//1.e
if (isset($_GET['numero'])) {
    $elementoABuscar = $_GET['numero'];
    $indice = array_search($elementoABuscar, $arrayNumeros);
    echo "<br>El elemento $elementoABuscar se encuentra en el índice $indice";
}
?>