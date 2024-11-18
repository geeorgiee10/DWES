<?php
session_start();

session_destroy();

echo "Ha cerrado sesión correctamente. <a href='archivo1.php'>Volver a iniciar sesión</a>";
?>
