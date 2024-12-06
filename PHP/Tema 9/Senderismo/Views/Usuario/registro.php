<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
?>

<!-- Formulario para registrarse -->
<h2>Formulario de Registro</h2>
<form action="<?php echo BASE_URL; ?>Usuario/registrar" method="POST">
    <label for="nombre">Nombre :</label>
    <!-- Si el campo es correcto guarda el valor sino lo es muestra debajo un error  -->
    <input type="text" name="nombre" id="nombre" value="<?php echo $_POST['nombre'] ?? ''; ?>"><br><br>
    <?php if (isset($errores['nombre'])): ?>
        <p style="color:red;"><?php echo $errores['nombre']; ?></p>
    <?php endif; ?>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" id="apellidos" value="<?php echo $_POST['apellidos'] ?? ''; ?>"><br><br>
    <?php if (isset($errores['apellidos'])): ?>
        <p style="color:red;"><?php echo $errores['apellidos']; ?></p>
    <?php endif; ?>

    <label for="email">Correo Electrónico:</label>
    <input type="text" name="email" id="email" value="<?php echo $_POST['email'] ?? ''; ?>"><br><br>
    <?php if (isset($errores['email'])): ?>
        <p style="color:red;"><?php echo $errores['email']; ?></p>
    <?php endif; ?>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" value="<?php echo $_POST['direccion'] ?? ''; ?>"><br><br>
    <?php if (isset($errores['direccion'])): ?>
        <p style="color:red;"><?php echo $errores['direccion']; ?></p>
    <?php endif; ?>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" value="<?php echo $_POST['telefono'] ?? ''; ?>"><br><br>
    <?php if (isset($errores['telefono'])): ?>
        <p style="color:red;"><?php echo $errores['telefono']; ?></p>
    <?php endif; ?>

    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $_POST['fecha_nacimiento'] ?? ''; ?>"><br><br>
    <?php if (isset($errores['fecha_nacimiento'])): ?>
        <p style="color:red;"><?php echo $errores['fecha_nacimiento']; ?></p>
    <?php endif; ?>

    <label for="nombre_usuario">Nombre de Usuario:</label>
    <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo $_POST['nombre_usuario'] ?? ''; ?>"><br><br>
    <?php if (isset($errores['nombre_usuario'])): ?>
        <p style="color:red;"><?php echo $errores['nombre_usuario']; ?></p>
    <?php endif; ?>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" id="contrasena"><br><br>
    <?php if (isset($errores['contrasena'])): ?>
        <p style="color:red;"><?php echo $errores['contrasena']; ?></p>
    <?php endif; ?>

    <label for="confirmar_contrasena">Confirmar Contraseña:</label>
    <input type="password" name="confirmar_contrasena" id="confirmar_contrasena"><br><br>
    <?php if (isset($errores['confirmar_contrasena'])): ?>
        <p style="color:red;"><?php echo $errores['confirmar_contrasena']; ?></p>
    <?php endif; ?>

    <?php if(isset($_SESSION['usuario'])): ?>
    <label for="rol">Rol:</label>
    <input type="text" name="rol" id="rol" value="<?php echo $_POST['rol'] ?? ''; ?>"><br><br>
    <?php if (isset($errores['rol'])): ?>
        <p style="color:red;"><?php echo $errores['rol']; ?></p>
    <?php endif; ?>
    <?php endif; ?>

    <input type="submit" value="Registrar">

    <?php if(!isset($_SESSION['usuario'])): ?>
        <p>Si ya tienes una cuenta creada <a href="<?php echo BASE_URL; ?>Usuario/formularioInicioSesion">Inicia Sesión</a></p>
    <?php endif; ?>

    <p><a href="<?php echo BASE_URL; ?>">Volver a inicio</a></p>
</form>
