
    <form action="" method="POST">
        <label for="numero">Número de carta (1-12):</label>
        <input type="number" name="numero" id="numero">

        <label for="palo">Palo:</label>
        <select name="palo" id="palo">
            <option value="ESPADAS">Espadas</option>
            <option value="OROS">Oros</option>
            <option value="COPAS">Copas</option>
            <option value="BASTOS">Bastos</option>
        </select>

        <button type="submit">Seleccionar Carta</button>
    </form>
    <?php if (isset($error) && $error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php elseif (isset($carta)): ?>
        <h2>Carta Seleccionada:</h2>
        <p><?= htmlspecialchars($carta->getNombre()) ?></p>
        <?php 
            $image = "./assets/img/" . $carta->getPalo() . "_" . $carta->getNumero() . ".jpg";
        ?>
        <?php if (file_exists($image)): ?>
            <img src="<?= $image ?>" alt="Carta seleccionada">
        <?php else: ?>
            <p>No tenemos la imagen de esta carta.</p>
        <?php endif; ?>
    <?php endif; ?>


