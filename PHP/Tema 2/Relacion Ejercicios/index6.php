<?php

$cadena = "Hola Mundo";
$invertida = "";
for ($i = strlen($cadena) - 1; $i >= 0; $i--) {
    $invertida = $invertida . substr($cadena, $i, 1);
}
echo $invertida;

?>