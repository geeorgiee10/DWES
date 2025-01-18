<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
?>

<div class="guardarCategoria">
<?php 
    if(isset($_SESSION['actualizado'])): 
?>
<h2>Categoria actualizada con exito</h2>
<p><a href="<?= BASE_URL ?>Category/categorias">Volver</a></p>
<?php elseif(isset($_SESSION['falloDatos'])): ?>

<h2>Los datos no se han enviado correctamente</h2>
<p><a href="<?= BASE_URL ?>Category/categorias">Volver</a></p>

<?php else: ?>

<!-- Formulario para registrarse -->
<h2>Actualizar Categoria</h2>
<form action="<?= BASE_URL ?>Category/ActualizarCategoria" method="POST">

    <label for="nombre">Categoria :</label>
    <!-- Si el campo es correcto guarda el valor sino lo es muestra debajo un error  -->
    <select name="categoriaSelect" id="categoriaSelect">
        <?php foreach($categorias as $categoria): ?>
            <option value="<?= htmlspecialchars($categoria["id"]) ?>"><?= htmlspecialchars($categoria["nombre"]) ?></option>
        <?php endforeach;?>
    </select><br><br>


    <label for="nombre">Nombre :</label>
    <!-- Si el campo es correcto guarda el valor sino lo es muestra debajo un error  -->
    <input type="text" name="category[nombre]" id="nombre" value="<?=(isset($category))?$category->getNombre():""?>"><br><br>
    <?php if (isset($errores['nombre'])): ?>
        <p style="color:red;"><?php echo $errores['nombre']; ?></p>
    <?php endif; ?>

    <?php if (isset($errores['db'])): ?>
        <p style="color:red;"><?php echo $errores['db']; ?></p>
    <?php endif; ?>

    <input type="submit" value="Actualizar">

    <p><a href="<?= BASE_URL ?>Category/categorias">Volver atras</a></p>
</form>

<?php 
    endif;
?>

</div>