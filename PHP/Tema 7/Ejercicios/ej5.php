<?php
$cookie_aceptada = isset($_COOKIE['cookies_aceptadas']) ? true : false;

if (isset($_POST['aceptar'])) {
    setcookie('cookies_aceptadas', 'true', time() + 365*24*60*60, '/');
    $cookie_aceptada = true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Política de Cookies</title>
</head>
<body>

  <?php if (!$cookie_aceptada): ?>
    <div id="cookie-banner">
      Este sitio utiliza cookies para mejorar la experiencia. <a href="#">Más información</a>.
      <form method="post">
        <button type="submit" name="aceptar">Aceptar</button>
      </form>
    </div>
  <?php endif; ?>

</body>
</html>
