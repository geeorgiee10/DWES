<?php

/* Ejemplos de arrays:
 * Usando índices numéricos o alfanuméricos accedemos a los valores
 * Si declaramos el array sin usar claves se asignan como claves por defecto
 * enteros consecutivos empezando por 0
 */

$peliculas = array('Tiburón','King Kong','Los pájaros');
echo " Este es el contenido del array películas,"
          ." tres valores ordenados con un índice numérico";
echo "<pre>";
var_dump($peliculas); 
echo "<hr/>";

echo "Muestro la película que deseo en concreto, indicando el índice (0,1,2...): <br>";
var_dump($peliculas[2]);
echo "<hr/>";

// también puedo definirlo usando corchetes en lugar de paréntesis
echo "Puedo definir mis arrays usando corchetes, el resultado es el mismo <br>";
$flores = ['margarita','rosa','clavel','tulipán'];
var_dump($flores);
echo "<hr/>";

echo "Para imprimir un valor concreto lo hago poniendo el índice entre paréntesis: <br>";

echo $flores[0]."<br>";
echo $peliculas[1]."<hr/>";

// otro ejemplo 
$arr1 = array (10,20,30,40);
echo "En este ejemplo mostramos los valores con print_r <br>";
echo "print_r muestra las claves y valores de todos los elementos<br>";
print_r($arr1);
echo "<hr/>";

/* si añadimos un nuevo elemento sin especificar clave,
 * la clave será el número siguiente a la mayor clave entera
 *  presente en el array 
 */

$arr1[] = 5; //añadimos un elemento sin especificar clave
echo"Acabamos de añadir un elemento sin especificar clave: <br>";
print_r($arr1);
echo "<hr/>";

$arr1[10] = 6; //añadimos otro especificando clave
echo "Hemos añadido otro elemento con la clave 10 <br>";
print_r($arr1);
echo "<hr/>";

$arr1[] = 5; // añadimos el último sin clave, se pone detrás
echo " Volvemos a añadir otro sin clave y vemos que se pone al final: <br>";
print_r($arr1);
echo "<hr/>";

// ejemplo usando claves para declarar el array
$arr1 = [
		0 => 444,
		1 => 222,
		2 => 333,
	];
print_r($arr1);
echo "<br>" . " en la posición 0 tenemos: " . $arr1[0] . "<br>";
$arr1[0] = 555; // cambiamos el valor
echo "Cambiamos el valor de la posición 0 <br>";
print_r($arr1);
echo "<br>";
