<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: archivo1.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página protegida</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $username; ?>!</h2>
    <p>Ha iniciado sesión como <?php echo $username; ?>.</p>

    <a href="archivo4.php"><button>Cerrar sesión</button></a>
</body>
</html>
