<!-- Formulario para editar los datos del usuario logueado -->
<h2>Editar Datos</h2>
<form action="<?php echo BASE_URL; ?>Usuario/actualizarDatos" method="post">
    <!-- Campo oculto para tener el id de cada usuario -->
    <input type="hidden" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : $_SESSION['usuario']["id"]; ?>">
    <?php if (isset($errores['id'])): ?>
        <p style="color:red;"><?php echo $errores['id']; ?></p>
    <?php endif; ?>

    <input type="hidden" name="origen" value="formEditDatos">
    <?php if (isset($errores['origen'])): ?>
        <p style="color:red;"><?php echo $errores['origen']; ?></p>
    <?php endif; ?>

    <label for="nombre">Nombre :</label>
    <!-- Al entrar al formulario vienen puestos los datos del usuario logueado -->
    <!-- Se guarda el valor del campo si es correcto y si no lo es se muestra error debajo del campo -->
    <input type="text" name="nombre" id="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : $_SESSION['usuario']["nombre"]; ?>"><br><br>
    <?php if (isset($errores['nombre'])): ?>
        <p style="color:red;"><?php echo $errores['nombre']; ?></p>
    <?php endif; ?>
    
    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" id="apellidos" value="<?php echo isset($_POST['apellidos']) ? $_POST['apellidos'] : $_SESSION['usuario']["apellidos"]; ?>"><br><br>
    <?php if (isset($errores['apellidos'])): ?>
        <p style="color:red;"><?php echo $errores['apellidos']; ?></p>
    <?php endif; ?>
    
    <label for="email">Correo Electrónico:</label>
    <input type="text" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $_SESSION['usuario']["correo"]; ?>"><br><br>
    <?php if (isset($errores['email'])): ?>
        <p style="color:red;"><?php echo $errores['email']; ?></p>
    <?php endif; ?>
    
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" value="<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : $_SESSION['usuario']["direccion"]; ?>"><br><br>
    <?php if (isset($errores['direccion'])): ?>
        <p style="color:red;"><?php echo $errores['direccion']; ?></p>
    <?php endif; ?>
    
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : $_SESSION['usuario']["telefono"]; ?>"><br><br>
    <?php if (isset($errores['telefono'])): ?>
        <p style="color:red;"><?php echo $errores['telefono']; ?></p>
    <?php endif; ?>
    
    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : $_SESSION['usuario']["fecha_nacimiento"]; ?>"><br><br>
    
    <label for="nombre_usuario">Nombre de Usuario:</label>
    <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : $_SESSION['usuario']["usuario"]; ?>"><br><br>
    <?php if (isset($errores['nombre_usuario'])): ?>
        <p style="color:red;"><?php echo $errores['nombre_usuario']; ?></p>
    <?php endif; ?>
    
    <button type="submit">Guardar cambios</button>
</form>

<form action="<?php echo BASE_URL; ?>Usuario/verTusDatos">
    <button>Cancelar</button>
</form>

