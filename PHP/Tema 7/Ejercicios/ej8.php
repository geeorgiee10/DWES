<?php
$fecha_acceso = date('Y-m-d H:i:s');

setcookie('fecha_acceso', $fecha_acceso, time() + 3600, '/');

if (isset($_COOKIE['fecha_acceso'])) {
    echo "La cookie 'fecha_acceso' tiene el valor: " . $_COOKIE['fecha_acceso'];
} else {
    echo "La cookie 'fecha_acceso' ha sido establecida.";
}
?>
