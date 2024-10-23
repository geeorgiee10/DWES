<?php
function factorial($numero) {
    if ($numero == 0 || $numero == 1) {
        return 1;
    }
    return $numero * factorial($numero - 1);
}

$num = $_GET['num'];
echo "El factorial de $num es " . factorial($num);
?>