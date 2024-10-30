<?php
// Mostrar la foto en esta página redireccionada desde la pagina de mostrar resultados
$nombreFoto = isset($_GET['foto']) ? $_GET['foto'] : '';

if ($nombreFoto) {
    //Obtener la ruta con el nombre de la foto
    $rutaFoto = "../fotos/" . htmlspecialchars($nombreFoto);
    //Si esta ruta existe mostrar la foto y el enlace para volver al formulario
    if (file_exists($rutaFoto)) {
        ?>
        <img src="<?php echo "$rutaFoto"; ?>" alt='Foto de la vivienda'>
        <p>
            <a href="formulario.php">Volver al formulario</a>
        </p>
        <?php
    } 
} 
?>



       