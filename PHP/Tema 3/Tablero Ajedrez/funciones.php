<?php
//Generar array con los nombres de las imágenes de las piezas blancas y negras
$piezasBlancas = array("torreb", "caballob", "alfilb", "reinab", "reyb", "alfilb", "caballob", "torreb");
$piezasNegras = array("torren", "caballon", "alfiln", "reinan", "reyn", "alfiln", "caballon", "torren");

//Funcion que pinta las casillas con sus colores correspondientes y llama a la funcion colocarPiezas para que coloque los piezas
function pintarCasillas($columna,$fila){
    //Si el la suma de la fila mas la columna es par se pinta de blanco sino de gris 
    $colorFila = (($fila + $columna) % 2 == 0) ? "blanca" : "gris";
    //Pone el td para cada columna poniendole de nombre de clase el color que le corresponda, ya que asi se llama en el css y luego llama a la funcion
    //colocarPiezas dentro del td para que coloque las piezas
    echo "<td class= " . $colorFila .">".colocarPiezas($columna,$fila)."</td>";
}
//Funcion para pintar el tablero de ajedrez
function hacerTablero(){
    //Habre la tabla
    echo "<table>";
    //Hace un for para que pinte las 8 filas
    for($i = 0; $i < 8; $i++){
        //Escribe la fila
        echo "<tr>";
        //Hace otro for para que haga en cada fila sus 8 columnas
        for($j = 0; $j < 8;$j++){
            //LLama a la funcion pintarCasillas para que pinte la casilla de su color y ponga la pieza
            pintarCasillas($j,$i);
        }

        echo "</tr>";

    }

    echo "</table";
}

//Funcion para colocar las piezas en sus filas y columnas exactas
function colocarPiezas($columna,$fila){
    // Colocar peones negros en la fila 1
    if ($fila == 1) {
        return "<img src='./fichasAjedrez/peon-negro.png'>";
    }

    // Colocar peones blancos en la fila 6
    if ($fila == 6) {
        return "<img src='./fichasAjedrez/peon-blanco.png'>";
    }

    // Pilla las variables globales que eran los array definidos arriba
    global $piezasBlancas, $piezasNegras;
    
    //Imprime en la fila 0 las piezas negras en el orden del array
    if ($fila == 0) {
        return "<img src='./fichasAjedrez/" . $piezasNegras[$columna] . ".png''>";
    }
    //Imprime en la fila 7 las piezas blancas en el orden del array
    if ($fila == 7) {
        return "<img src='./fichasAjedrez/" . $piezasBlancas[$columna] . ".png'>";
    }

    // Si no hay piezas en esa casilla, retornar una cadena vacía
    return "";
    
}


?>
