<?php
function fecha() {
    $dias = ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"];
    $meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];

    $diaSemana = $dias[date("w")];
    $dia = date("d");
    $mes = $meses[date("n") - 1]; 
    $año = date("Y"); 

    return "$diaSemana, $dia de $mes de $año";
}


?>

