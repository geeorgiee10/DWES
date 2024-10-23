<?php
    function contraseña($cadena){
        if(strlen($cadena) < 6 && strlen($cadena) > 15){
            return "La contraseña " . $cadena . " no es valida";
        }

         // Comprobar que tenga al menos un número
        if (!preg_match('/[0-9]/', $cadena)) {
            return "La contraseña " . $cadena . " no es valida";
        }

        if (!preg_match('/[A-Z]/', $cadena)) {
            return "La contraseña " . $cadena . " no es valida";
        }

    // Comprobar que tenga al menos una letra minúscula
        if (!preg_match('/[a-z]/', $cadena)) {
            return "La contraseña " . $cadena . " no es valida";
        }

    // Comprobar que tenga al menos un carácter no alfanumérico
        if (!preg_match('/[\W_]/', $cadena)) {
            return "La contraseña " . $cadena . " no es valida";
        }

        return "La contraseña " . $cadena . " es valida";
    }

    echo contraseña("Hola123");
?>