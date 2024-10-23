<?php
function comprobacion($cadena) {
    if(is_string($cadena)){
        if(empty($cadena)){
            return "Este es el relleno porque estaba vacía";
        }
        else{
            return strtoupper($cadena);
        }
    }
    else{
        return $cadena . " no es una cadena de caracteres";
    }
}

echo comprobacion("");
echo "<br>";
echo comprobacion("hola como estas");
echo "<br>";
echo comprobacion(3);
?>