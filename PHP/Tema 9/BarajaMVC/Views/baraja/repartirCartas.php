<form action="" method="POST">
    <label for="numero">Número de Jugadores:</label>
    <input type="number" name="numero" id="numero">

    <button type="submit">Repartir Cartas</button>
</form>

<?php if (isset($error) && $error): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php elseif (isset($cartasRepartidas)): ?>
    <h2>Cartas repartidas a <?= htmlspecialchars($numeroDeJugadores) ?> jugadores:</h2>

    <?php foreach ($cartasRepartidas as $index => $jugador): ?>
        <h3>Jugador <?= $index + 1 ?>:</h3>
            <?php foreach ($jugador as $carta): ?>
                <?php 
                    $image = "./assets/img/" . $carta->getPalo() . "_" . $carta->getNumero() . ".jpg";
                ?>
                <?php if (file_exists($image)): ?>
                        <img src="<?= $image ?>" alt="Carta de jugador <?= $index + 1 ?>">
                <?php else: ?>
                    <p>No tenemos la imagen de esta carta.</p>
                <?php endif; ?>
                
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
<?php endif; ?>
