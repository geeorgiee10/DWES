<?php
    function matricula ($cadena){
        if(strlen($cadena) == 7){
            
            $numeros = substr($cadena, 0, 4);
            $letras = substr($cadena, 4, 3);
            
                if (ctype_digit($numeros) && preg_match('/^[BCDFGHJKLMNPRSTVWXYZ]{3}$/', $letras)) {
                    return "La cadena " . $cadena . " es una matricula valida";
                }
                else{
                    return "La cadena " . $cadena . " NO es una matricula valida"; 
                }
        }
        else{
            return "La cadena " . $cadena . " NO es una matricula valida";
        }
    }

    echo matricula('5678XYZ');
?>