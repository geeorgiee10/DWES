<?php
session_start();

$usuario_correcto = 'usuario';
$contraseña_correcta = 'contraseña123';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $usuario_correcto && $password === $contraseña_correcta) {
        $_SESSION['username'] = $username;
        header("Location: archivo3.php");
        exit;
    } else {
        echo "Usuario o contraseña incorrectos. <a href='archivo1.php'>Intenta de nuevo</a>";
    }
} else {
    echo "Por favor ingrese su usuario y contraseña. <a href='archivo1.php'>Volver</a>";
}
?>