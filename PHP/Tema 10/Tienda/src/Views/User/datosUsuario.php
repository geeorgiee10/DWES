<!-- Lista con los datos del usuario logueado -->
<div class="datosPropios">
<h2>Datos de <?= $_SESSION['usuario']["nombre"] ?></h2>
<ul>
    <!-- Tomar datos de la variable de sesión -->
    <li><b>ID:</b> <?php echo $_SESSION['usuario']["id"]; ?></li>
    <li><b>Nombre:</b> <?php echo $_SESSION['usuario']["nombre"]; ?></li>
    <li><b>Apellidos:</b> <?php echo $_SESSION['usuario']["apellidos"]; ?></li>
    <li><b>Correo:</b> <?php echo $_SESSION['usuario']["email"]; ?></li>
    <li><b>Rol:</b> <?php echo $_SESSION['usuario']["rol"]; ?></li>
    
</ul>
<a href="<?=  BASE_URL?>">Ir al inicio</a>

</div>