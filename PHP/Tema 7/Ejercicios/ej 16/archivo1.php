<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: archivo3.php");
    exit;
}

$isRemembered = isset($_COOKIE['username']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Formulario de inicio de sesión</h2>
    <form action="archivo2.php" method="POST">
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>" required><br><br>
        
        <?php if (!$isRemembered): ?>
            <label for="remember">Recordarme</label>
            <input type="checkbox" name="remember" id="remember"><br><br>
        <?php else: ?>
            <label for="noRemember">Dejar de recordar</label>
            <input type="checkbox" name="noRemember" id="noRemember" value="Dejar de recordar" checked><br><br>
            <label for="remember"><a href="">Cambiar de usuario</a></label><br><br>
        <?php endif; ?>
        
        

        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>
