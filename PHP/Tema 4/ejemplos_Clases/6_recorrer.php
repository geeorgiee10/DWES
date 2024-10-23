<?php

// Recorrer arrays

$peliculas = array('Tiburón','King Kong','Los pájaros');
$flores = ['margarita','rosa','clavel','tulipán'];

/* Mostrar un listado de todos los elementos 
  del array con FOR clásico */
echo "Listados de películas:<br>";
echo "<ul>";
for ($i = 0; $i < count($peliculas); $i++){ //count permite saber el número de elementos del array
    echo "<li>".$peliculas[$i]."</li>";
}
echo "</ul>";
echo "<hr/>";

// recorrer un array usando FOREACH
echo 'Listado de flores:';
echo "<ul>";
foreach ($flores as $flor) { 
 /* Recorre el array flores y por cada iteración se crea la variable flor.
  * La variable flor va tomando valor en cada iteración con el contenido del array en ese índice
 */
    echo "<li>$flor</li>";
}
echo "</ul>";
echo "<hr/>";

