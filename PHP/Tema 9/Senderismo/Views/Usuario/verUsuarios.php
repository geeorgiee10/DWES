<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
?>
<ul>
    <!-- Listar el nombre de todos los usuarios y permitir editarlos -->
    <?php  foreach($usuarios as $usuario): ?>
    <li>Nombre de Usuario: <?php echo $usuario["usuario"]; ?></li>
    <form action="<?php echo BASE_URL; ?>Usuario/formularioDatos" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario["id"]; ?>">
        <?php if (isset($errores['id'])): ?>
            <p style="color:red;"><?php echo $errores['id']; ?></p>
        <?php endif; ?>
        <input type="hidden" name="origen" value="verUsuarios">
        <?php if (isset($errores['origen'])): ?>
            <p style="color:red;"><?php echo $errores['origen']; ?></p>
        <?php endif; ?>
        <button id="editar" name="editar">Editar</button>
    </form>
    
    <?php endforeach; ?>
</ul>
<form action="<?php echo BASE_URL; ?>">
    <button>Volver</button>
</form>

