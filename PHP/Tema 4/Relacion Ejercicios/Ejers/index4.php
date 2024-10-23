<?php
    $array = [];
    for ($i = 0; $i < 20; $i++) {
        $array[$i] = rand(0, 100); 
    }
    $longitud = count($array);

    $cuadrado = [];
    for ($j = 0; $j < $longitud; $j++) {
        $cuadrado[$j] = $array[$j] * $array[$j];
    }

    $cubo = [];
    for ($k = 0; $k < $longitud; $k++) {
        $cubo[$k] = $array[$k] * $array[$k] * $array[$k];
    }

    echo "<table border = '1'>";
        echo "<tr>";
            echo "<td>Número</td>";
            echo "<td>Cuadrado</td>";
            echo "<td>Cubo</td>";   
        echo "</tr>";
    for($l = 0; $l < $longitud; $l++){
        echo "<tr>";
            echo "<td>" . $array[$l] . "</td>";
            echo "<td>" . $cuadrado[$l] . "</td>";
            echo "<td>" . $cubo[$l] . "</td>";
        echo "</tr>";
    }
    echo "</table>";


?>