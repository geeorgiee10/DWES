<!-- Lista con los datos del usuario logueado -->
<h2>Datos de <?php echo $_SESSION['usuario']["usuario"]; ?></h2>
<ul>
    <!-- Tomar datos de la variable de sesión -->
    <li><b>Nombre:</b> <?php echo $_SESSION['usuario']["nombre"]; ?></li>
    <li><b>Apellidos:</b> <?php echo $_SESSION['usuario']["apellidos"]; ?></li>
    <li><b>Correo:</b> <?php echo $_SESSION['usuario']["correo"]; ?></li>
    <li><b>Dirección:</b> <?php echo $_SESSION['usuario']["direccion"]; ?></li>
    <li><b>Teléfono:</b> <?php echo $_SESSION['usuario']["telefono"]; ?></li>
    <li><b>Fecha de Nacimiento:</b> <?php echo $_SESSION['usuario']['fecha_nacimiento']; ?></li>
    <li><b>Nombre de Usuario:</b> <?php echo $_SESSION['usuario']["usuario"]; ?></li>
</ul>
<form action="<?php echo BASE_URL; ?>Usuario/formularioMisDatos">
    <button>Editar</button>
</form>

<form action="<?php echo BASE_URL; ?>">
    <button>Volver</button>
</form>

