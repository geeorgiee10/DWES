<?php


$n = 5;
for ($i=1; $i <=$n; $i++) { 
     for ($s = 1; $s <= $n- $i; $s++) {
        echo ' &nbsp;';
    }
     for ($j = 1; $j <= 2 * $i-1; $j++) {
        echo '*';
    }
    echo '<br>';
}

?>