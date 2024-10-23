<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brisca</title>
    <link rel="stylesheet" href="index.css"> <!-- Enlace al archivo CSS -->
</head>
<body>
    <div class="contenedor">
        <h1>Brisca</h1>

        <?php
        //Llamar al archivo funcionalidad.php para poder ejecutar las funciones y que el codigo este mas limpio
        include 'funcionalidad.php';

        //Crear una baraja de cartas usando la funcion crearBarajadeCartas()
        $barajadeCartas = crearBarajadeCartas();

        // Parte a:
        //Repartir al jugador tres cartas de la baraja creada antes usando la funcion repartirCartasAlJugador
        $cartasdelJugador = repartirCartasAlJugador($barajadeCartas, 3);
        echo "<h2>Cartas que se le han repartido al jugador desde la baraja:</h2>";
        echo '<div class="cartas">';
            //Recorrer un bucle en el que cada posicion del array $cartasdelJugador se asigna a la variable $carta
            foreach ($cartasdelJugador as $carta) {
                echo '<div class="carta">';
                    // Mostrar la imagen de la carta pasando el nombre de la carta en la ruta
                    echo '<img src="./imagenes/' . $carta . '.jpg" alt="' . $carta . '">';
                echo '</div>';
            }
        echo '</div>';

        // Parte b:
        //Crear una baza para el jugador usando la funcion repartirCartasAlJugador sobre la baraja creada antesd
        $barajadelJugador = repartirCartasAlJugador($barajadeCartas, 10);
        echo "<h2>Cartas que el jugador tiene en su baraja:</h2>";
        echo '<div class="cartas">';
            //Recorrer un bucle en el que cada posicion del array $bazadelJugador se asigna a la variable $carta
            foreach ($barajadelJugador as $carta) {
                echo '<div class="carta">';
                    // Mostrar la imagen de la carta pasando el nombre de la carta en la ruta
                    echo '<img src="./imagenes/' . $carta . '.jpg" alt="' . $carta . '">';
                echo '</div>';
            }
        echo '</div>';
        //Calcular los puntos que tiene la baza que se le ha creado al jugador usando la funcion calcularPuntos sobre la baza del jugador
        $puntosBaza = calcularPuntos($barajadelJugador);
        echo "<h2>Puntos de las cartas del jugador: " . $puntosBaza . "</h2>";
        ?>
    </div>
</body>
</html>

