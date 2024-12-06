<!-- Formulario para comentar una ruta -->
<table border="1">
    <tr>
        <th>Titulo</th>
        <th>Descripción</th>
        <th>Desnivel (m)</th>
        <th>Distancia (Km)</th>
        <th>Dificultad</th>
        <th>Notas</th>
        <th>Comentarios</th>
    </tr>
    <tr>
        
        <td><?php echo $rutaActual["titulo"] ?></td>
        <td><?php echo $rutaActual["descripcion"] ?></td>
        <td><?php echo $rutaActual["desnivel"] ?></td>
        <td><?php echo $rutaActual["distancia"] ?></td>
        <td><?php echo $rutaActual["dificultad"] ?></td>
        <td><?php echo $rutaActual["notas"] ?></td>
        <td>
            <?php foreach($comentariosRutaActual as $comentarioRutaActual): ?>
                <ul>
                    <li><?php echo $comentarioRutaActual["nombre"]; ?>
                        <ul>
                            <li><?php echo $comentarioRutaActual["texto"]; ?></li>
                            <li><?php echo $comentarioRutaActual["fecha"]; ?></li>
                        </ul>
                    </li>
                    
                </ul>
            <?php endforeach; ?>
        </td>
        
    </tr>
</table>


<h2>Añadir Comentario</h2>
<form action="<?php echo BASE_URL; ?>RutaComentario/añadirComentarioARuta" method="post">

    <input type="hidden" name="id_ruta" value="<?php echo $idRuta; ?>">
    <?php if (isset($errores['id_ruta'])): ?>
        <p style="color:red;"><?php echo $errores['id_ruta']; ?></p>
    <?php endif; ?>

    <input type="hidden" name="nombre" value="<?php echo $usuarioActual; ?>">
    <?php if (isset($errores['nombre'])): ?>
        <p style="color:red;"><?php echo $errores['nombre']; ?></p>
    <?php endif; ?>

    <label for="texto">Comentario :</label>
    <!-- Si el campo es correcto guarda el valor sino lo es muestra debajo un error  -->
    <textarea name="texto" id="texto"><?php echo isset($_POST['texto']) ? $_POST['texto'] : ''; ?></textarea><br><br>
    <?php if (isset($errores['texto'])): ?>
        <p style="color:red;"><?php echo $errores['texto']; ?></p>
    <?php endif; ?>

    <input type="hidden" name="fecha" value="<?php echo date("Y-m-d"); ?>">
    <?php if (isset($errores['fecha'])): ?>
        <p style="color:red;"><?php echo $errores['fecha']; ?></p>
    <?php endif; ?>

    <input type="hidden" name="id_usuario" value="<?php echo $idActual; ?>">
    <?php if (isset($errores['id_usuario'])): ?>
        <p style="color:red;"><?php echo $errores['id_usuario']; ?></p>
    <?php endif; ?>
    
    
    <input type="submit" value="Comentar">
    
    <p><a href="<?php echo BASE_URL; ?>">Volver a inicio</a></p>