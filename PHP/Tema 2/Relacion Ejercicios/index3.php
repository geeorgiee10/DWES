<?php
    $a = 1;
    $b = 2;
    $c = -15;
    
    $raiz = $b*$b - 4*$a*$c;
    $solucion1 = (-$b+sqrt($raiz))/(2*$a);
    $solucion2 = (-$b-sqrt($raiz))/(2*$a);

    if($solucion1 < 0){
        printf("No tiene solucion");
    }
    else{
        echo $solucion1 . "<br>";
    }
    if($solucion2 < 0){
        printf("No tiene solucion");
    }
    else{
        print $solucion2;
    }
?>