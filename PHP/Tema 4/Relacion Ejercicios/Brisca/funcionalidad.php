<?php
//Funcion para crear la baraja con todas las cartas
function crearBarajadeCartas() {
    //Crear un array con cada uno de los palos de la baraja
    $palos = ['oros', 'copas', 'espadas', 'bastos'];
    //Crear un array para guardar las cartas con el mismo nombre que las imagenes
    $cartas = [];
    //Crear un array con el nombre de las cartas
    $nombresdeLasCartas = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
    //Bucle que recorre el array de palos asignando cada posicion a la variable $palo
    foreach ($palos as $palo) {
        //Bucle que recorre el array de nombres de las cartas asignando cada posicion a la variable $nombre
        foreach ($nombresdeLasCartas as $nombre) {
            //Guardar en el array de $cartas las cartas con el mismo nombre de las imagenes, ej: oros_1
            $cartas[] = $palo . '_' . $nombre;
        }
    }
    //Devolver el array de $cartas con todas las cartas bien formateas en sus nombres
    return $cartas;
}

// Función para repartir cartas sin que se repita ninguna dandole la baraja sobre la cual sacar las cartas
//y la cantidad de cartas a sacar
function repartirCartasAlJugador($barajadeCartas, $cantidaddeCartas) {
    //Crear un array para guardar las cartas repartidas
    $cartasRepartidas = [];
    //Bucle que se ejecutara mientras que la longitud de $cartasRepartidas sea menor que la cantidad de cartas a repartir
    while (count($cartasRepartidas) < $cantidaddeCartas) {
        //Calcular en una variable el indice para sacar cartas aleatorias entre 0 y el indice de la ultima posicion del array de $barajadeCartas
        $indice = rand(0, count($barajadeCartas) - 1);
        //Condicional para comprobar si el valor que hay en la posicion indice del array $barajadeCartas esta en el array $cartasRepartidas
        if (!in_array($barajadeCartas[$indice], $cartasRepartidas)) {
            //Si no esta añadir al array $cartasRepartidas el valor de la posicion indice del array $barajadeCartas 
            $cartasRepartidas[] = $barajadeCartas[$indice];
        }
    }
    //Devolver el array con las cartas repartidas
    return $cartasRepartidas;
}

// Función para calcular los puntos de la baza que se le pasa
function calcularPuntos($barajadelJugador) {
    //Array asociativo para enlazar los puntos con cada una de las cartas de la baraja
    $puntos = [
        '1' => 11,
        '2' => 0,
        '3' => 10,
        '4' => 0,
        '5' => 0,
        '6' => 0,
        '7' => 0,
        '8' => 0,
        '9' => 0,
        '10' => 2,
        '11' => 3,
        '12' => 4
    ];
    
    $sumadeLosPuntos = 0;
    //Bucle para recorrer el array $bazadelJugador asignandole cada posicion del array a la variable $carta
    foreach ($barajadelJugador as $carta) {
        // Extraer el número del nombre de la carta usando explode y separando por el _ y tomando el valor que devuelve en la posicion 1.
        $nombreCarta = explode('_', $carta)[1];
        //Sumar los puntos que hay sumados a los puntos de cada una de las cartas que posee el jugador en su baraja
        $sumadeLosPuntos += $puntos[$nombreCarta]; // Sumar los puntos
    }
    //Devolver los puntos que tiene el jugador en su baraja
    return $sumadeLosPuntos;
}
?>
