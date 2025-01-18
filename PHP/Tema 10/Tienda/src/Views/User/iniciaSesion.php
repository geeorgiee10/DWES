<!-- Formulario para iniciar sesión -->
<div id="inicioSesion">


<h2>Formulario de Inicio de Sesión</h2>
<form action="<?= BASE_URL ?>User/iniciarSesion" method="POST">
    <label for="correo">Correo Electrónico:</label>
    <!-- Si hay errores se muestran debajo y se guarda el valor si el campo es correcto -->
    <input type="email" name="correo" id="correo" value="<?php echo $_POST['correo'] ?? ''; ?>"><br><br>
    <?php if (isset($errores['correo'])): ?>
        <p style="color:red;"><?php echo $errores['correo']; ?></p>
    <?php endif; ?>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" id="contrasena"><br><br>
    <?php if (isset($errores['contrasena'])): ?>
        <p style="color:red;"><?php echo $errores['contrasena']; ?></p>
    <?php endif; ?>

    <?php if (isset($errores['login'])): ?>
        <p style="color:red;"><?php echo $errores['login']; ?></p>
    <?php endif; ?>

    <input type="submit" value="Iniciar Sesión">

    <p>Si no tienes una cuenta creada <a href="<?= BASE_URL ?>User/registrar">Registrate</a></p>

    <p><a href="<?php echo BASE_URL; ?>">Volver a inicio</a></p>
</form>

</div>
