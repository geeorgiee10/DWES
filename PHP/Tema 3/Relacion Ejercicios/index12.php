<?php
function duplicarCaracteres($cadena) {
    $resultado = "";  // Inicializar la cadena resultante

    for ($i = 0; $i < strlen($cadena); $i++) {
        $resultado .= $cadena[$i] . $cadena[$i];
    }

    return $resultado; 
}

$cadenaOriginal = "Esto es un ejemplo";
$cadenaDuplicada = duplicarCaracteres($cadenaOriginal);

echo "$cadenaOriginal <br>";  // Salida: Cadena original: Hola
echo "$cadenaDuplicada<br>"; // Salida: Cadena duplicada: HHoollaa
?>
