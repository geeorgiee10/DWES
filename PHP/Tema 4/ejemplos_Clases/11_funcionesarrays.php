<?php
// ejemplos de funciones con arrays
$peliculas = array('Batman','Spiderman','El señor de los anillos');
$numeros = array (1,23,12,4,7,44,2);
if(is_array($numeros)){ // saber si la variable es un array 
    echo "Esta variable es un array <br>";
}
echo "<hr/>";
echo "Películas en orden alfabético: <br>";
echo "<pre>";
asort($peliculas); // ordena alfabéticamente
var_dump($peliculas);
echo "<hr/> Películas en orden alfabético inverso: <br>";
arsort($peliculas); // ordena alfabéticamente en orden inverso
var_dump($peliculas);
echo "<hr/> Números ordenados: <br>";
sort($numeros); // ordena también si son númericos los valores
var_dump($numeros);
echo "<hr/> Añado películas nuevas: <br>";
// añadir elementos a un array se puede hacer de varias formas
$peliculas[] = 'La guerra de las galaxias';
var_dump($peliculas);
array_push($peliculas, "Mujercitas");//también puedo añadirlo con la función
var_dump($peliculas);
echo "<hr/> Quito la última película: <br>";
// eliminar el último elemento del array
array_pop($peliculas);//uso una función para eliminar
var_dump($peliculas);
echo "Elimino la que tiene índice 2: <br>";
// eliminar un indice concreto
unset($peliculas[2]);
var_dump($peliculas);

// sacar un elemento aleatorio de un array
$indice = array_rand($peliculas);
echo "<hr/>pelicula aleatoria: <br>";
echo $peliculas[$indice];

// invertir los valores de un array
echo "<hr/> Muestro los valores del array numeros con orden inverso: <br>";
var_dump(array_reverse($numeros));

// buscar un elemento en un array
echo "<hr/> Buscamos una película: <br>";
$resultado = array_search('Spiderman',$peliculas);
echo "la pelicula Spiderman está en el indice: ". $resultado."<br>";

// contar el número de elementos
echo "<hr/>Tenemos ".count($peliculas)." películas <br>";
echo sizeof($peliculas); // hace lo mismo que count










        

