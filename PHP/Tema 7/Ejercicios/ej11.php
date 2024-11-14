<?php
session_start();

if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 0;
}

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    if ($accion == '1') {
        $_SESSION['contador']++; 
    } elseif ($accion == '0') {
        $_SESSION['contador']--; 
    }
}

// Mostrar el valor actual del contador
echo "Valor del contador: " . $_SESSION['contador'];
?>