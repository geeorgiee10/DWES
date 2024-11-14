<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: -1");
header("Pragma: no-cache");

date_default_timezone_set('Europe/Madrid');

$formatter = new IntlDateFormatter(
    'es_ES', 
    IntlDateFormatter::FULL, 
    IntlDateFormatter::FULL 
);

$formatter->setPattern("EEEE, d 'de' MMMM 'de' y, 'a las' H:mm:ss");

$fechaEnEspanol = $formatter->format(new DateTime());

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="10">
    <title>Cabeceras</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        h1 { color: red; font-size: 2em; }
        p { font-size: 1.2em; }
        a { font-size: 1.2em; color: blue; text-decoration: underline; }
    </style>
</head>
<body>
    <h1><?php echo ucfirst($fechaEnEspanol); ?></h1>
    <p>Con la función header() hemos especificado que esta página no se guarde en la memoria caché, sino que se llame a sí misma desde la página original cada 10 segundos. Puede comprobarse dejando la página sin actualizar durante 10 segundos o pulsando sobre <a href="">Actualizar</a>.</p>
</body>
</html>
