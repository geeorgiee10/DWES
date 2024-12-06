<!-- Formulario para crear una nueva ruta -->
<h2>Añadir Nueva Ruta</h2>
<form action="<?php echo BASE_URL; ?>Ruta/añadirRuta" method="post">

    <label for="titulo">Título :</label>
    <!-- Si el campo es correcto guarda el valor sino lo es muestra debajo un error  -->
    <input type="text" name="titulo" id="titulo" value="<?php echo $_POST['titulo'] ?? ''; ?>"><br><br>
    <?php if (isset($errores['titulo'])): ?>
        <p style="color:red;"><?php echo $errores['titulo']; ?></p>
    <?php endif; ?>
    
    <label for="descripcion">Descripción :</label>
    <!-- Si el campo es correcto guarda el valor sino lo es muestra debajo un error  -->
    <textarea name="descripcion" id="descripcion"><?php echo isset($_POST['descripcion']) ? $_POST['descripcion'] : ''; ?></textarea><br><br>
    <?php if (isset($errores['descripcion'])): ?>
        <p style="color:red;"><?php echo $errores['descripcion']; ?></p>
    <?php endif; ?>
    
    <label for="desnivel">Desnivel :</label>
    <!-- Si el campo es correcto guarda el valor sino lo es muestra debajo un error  -->
    <input type="number" name="desnivel" id="desnivel" value="<?php echo isset($_POST['desnivel']) ? $_POST['desnivel'] : ''; ?>"><br><br>
    <?php if (isset($errores['desnivel'])): ?>
        <p style="color:red;"><?php echo $errores['desnivel']; ?></p>
    <?php endif; ?>
    
    <label for="distancia">Distancia :</label>
    <!-- Si el campo es correcto guarda el valor sino lo es muestra debajo un error  -->
    <input type="number" step="0.01" min="0" name="distancia" id="distancia" value="<?php echo isset($_POST['distancia']) ? $_POST['distancia'] : ''; ?>"><br><br>
    <?php if (isset($errores['distancia'])): ?>
        <p style="color:red;"><?php echo $errores['distancia']; ?></p>
    <?php endif; ?>
    
    <label for="notas">Notas :</label>
    <!-- Si el campo es correcto guarda el valor sino lo es muestra debajo un error  -->
    <textarea name="notas" id="notas"><?php echo isset($_POST['notas']) ? $_POST['notas'] : ''; ?></textarea><br><br>
    <?php if (isset($errores['notas'])): ?>
        <p style="color:red;"><?php echo $errores['notas']; ?></p>
    <?php endif; ?>
    
    <label for="dificultad">Dificultad :</label>
    <!-- Si el campo es correcto guarda el valor sino lo es muestra debajo un error  -->
    <input type="text" name="dificultad" id="dificultad" value="<?php echo $_POST['dificultad'] ?? ''; ?>"><br><br>
    <?php if (isset($errores['dificultad'])): ?>
        <p style="color:red;"><?php echo $errores['dificultad']; ?></p>
    <?php endif; ?>
    
    <input type="submit" value="Crear Nueva Ruta">
    
    <p><a href="<?php echo BASE_URL; ?>">Volver a inicio</a></p>