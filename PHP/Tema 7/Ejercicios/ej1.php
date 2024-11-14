<?php 

if(isset($_COOKIE['contador'])){
    $variable = $_COOKIE['contador'];
    $variable += 1;

    setcookie('contador', $variable);

    echo 'Bienvenido por ' . $variable . ' vez'; 
}
else{
    setcookie('contador', 1);
    echo 'Bienvenido por primera vez';
}

?>