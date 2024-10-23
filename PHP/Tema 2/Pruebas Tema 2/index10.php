<?php
$listado_archivos = `dir`; // Listado de todos los archivos del directorio actual
echo "<pre>$listado_archivos<pre>"; // Se muestra en pantalla
echo PHP_OS;
?>