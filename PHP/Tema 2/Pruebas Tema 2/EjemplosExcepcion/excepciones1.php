<?php
// como capturar una excepción
try{  // sirve para capturar excepciones en código susceptible de errores
    if(isset($_GET['id'])){
        echo "<h1> El parámetro es: {$_GET['id']} </h1>";
    }else{
        throw new Exception('Faltan parámetros por la URL'); //lanza la excepción
    }   
} catch (Exception $e) { //captura el error y devuelve algo
    echo "Ha habido un error ".$e->getMessage()."<br>";
} finally { //lo que hacemos haya habido o no excepción. No se suele usar mucho
    echo 'Todo correcto';
}

