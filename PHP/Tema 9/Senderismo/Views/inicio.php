<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
?>
<form action="<?php echo BASE_URL; ?>Ruta/buscarRuta" method="GET">
    <label for="campo">Buscar por el campo</label>
    <select name="campo" id="campo">
        <option value="titulo" <?php echo (isset($_GET['campo']) && $_GET['campo'] == 'titulo') ? 'selected' : ''; ?>>Título</option>
        <option value="descripcion" <?php echo (isset($_GET['campo']) && $_GET['campo'] == 'descripcion') ? 'selected' : ''; ?>>Descripción</option>
        <option value="desnivel" <?php echo (isset($_GET['campo']) && $_GET['campo'] == 'desnivel') ? 'selected' : ''; ?>>Desnivel</option>
        <option value="distancia" <?php echo (isset($_GET['campo']) && $_GET['campo'] == 'distancia') ? 'selected' : ''; ?>>Distancia</option>
        <option value="dificultad" <?php echo (isset($_GET['campo']) && $_GET['campo'] == 'dificultad') ? 'selected' : ''; ?>>Dificultad</option>
    </select>
    <?php if (isset($errores['campo'])): ?>
        <p style="color:red;"><?php echo $errores['campo']; ?></p>
    <?php endif; ?>
    <input type="text" name="buscador" id="buscador" placeholder="Introduce el campo a buscar" value="<?php echo isset($_GET['buscador']) ? htmlspecialchars($_GET['buscador']) : ''; ?>">
    <?php if (isset($errores['elementoABuscar'])): ?>
        <p style="color:red;"><?php echo $errores['elementoABuscar']; ?></p>
    <?php endif; ?>
    <button type="submit">Buscar</button>
</form>

<form action="<?php echo BASE_URL; ?>Ruta/listadoCompleto">
    <button type="submit">Listado Completo</button>
</form>
<!-- Estos botones solo los ven los usuarios admin -->
<?php if(isset($_SESSION['usuario']) && $_SESSION["usuario"]["rol"] === "admin"):?>
    <form action="<?php echo BASE_URL; ?>Ruta/formularioRuta">
        <button id="nuevaRuta" name="nuevaRuta">Nueva Ruta</button>
    </form>

    <form action="<?php echo BASE_URL; ?>Usuario/verUsuarios">
        <button id="verUsuarios" name="verUsuarios">Ver los Usuarios</button>
    </form>

    <form action="<?php echo BASE_URL; ?>Usuario/formularioRegistroAdmin">
        <button id="registrarUsuarios" name="registrarUsuarios">Registrar Usuarios</button>
    </form>

<?php endif; ?>
<!-- Este boton solo se ve si se esta logueado -->
<?php if(isset($_SESSION['usuario'])): ?>
    <form action="<?php echo BASE_URL; ?>Usuario/verTusDatos">
        <button id="verDatos" name="verDatos">Ver mis Datos</button>
    </form>
<?php endif; ?>
<table border="1">
    <tr>
        <th>Titulo</th>
        <th>Descripción</th>
        <th>Desnivel (m)</th>
        <th>Distancia (Km)</th>
        <th>Dificultad</th>
        <th>Notas</th>
        <th>Comentarios</th>
        <th>Operaciones</th>
    </tr>
    <?php foreach($rutas as $ruta): ?>
    <tr>
        
        <td><?php echo htmlspecialchars($ruta["titulo"]) ?></td>
        <td><?php echo htmlspecialchars($ruta["descripcion"]) ?></td>
        <td><?php echo htmlspecialchars($ruta["desnivel"]) ?></td>
        <td><?php echo htmlspecialchars($ruta["distancia"]) ?></td>
        <td><?php echo htmlspecialchars($ruta["dificultad"]) ?></td>
        <td><?php echo htmlspecialchars($ruta["notas"]) ?></td>
        <td>
            <?php foreach($comentarios as $comentario): ?>
                <?php if($comentario["id_ruta"] === $ruta["id"]):?>
                <ul>
                    <li><?php echo $comentario["nombre"]; ?>
                        <ul>
                            <li><?php echo $comentario["texto"]; ?></li>
                            <li><?php echo $comentario["fecha"]; ?></li>
                        </ul>
                    </li>
                    
                </ul>
                <?php endif; ?>
            <?php endforeach; ?>
        </td>
        <td>
            <!-- Si estas logueado puedes comentar sino no puedes -->
            <?php if(!isset($_SESSION['usuario'])): ?>
                Inicia Sesión para poder Comentar
            <?php else: ?>
                <form action="<?php echo BASE_URL; ?>RutaComentario/formularioComentario" method="post">
                    <input type="hidden" name="nombreUsuario" value="<?php echo $_SESSION["usuario"]["usuario"]; ?>">
                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["usuario"]["id"]; ?>">
                    <input type="hidden" name="idRuta" value="<?php echo htmlspecialchars($ruta["id"]); ?>">

                    <button id="comentar" name="comentar">Comentar</button>
                </form>
            <?php endif; ?> 
        </td>
        
    </tr>
    <?php endforeach;?>
</table>
<div class="datosListadoRutas">
    <?php 
        if (isset($numRutas) && isset($rutaMasLarga)) {
            echo "El número total de rutas es: " . $numRutas . "<br>";
            echo "La ruta más larga tiene: " . $rutaMasLarga . " KM <br>";
        }
    ?> 
</div>

<!-- Controlar la paginación(cambiar de pagina) -->
<div class="pagination">
    <?php 
        if (isset($paginacion)) {
            $paginacion->render();
        }
    ?>
</div>


<!-- Si no estas logueado puedes ver estos botones sino no puedes-->
<?php if(!isset($_SESSION['usuario'])): ?>
    <form action="<?php echo BASE_URL; ?>Usuario/formularioInicioSesion">
        <button id="iniciarSesion" name="iniciarSesion">Iniciar Sesión</button>
    </form>

    <form action="<?php echo BASE_URL; ?>Usuario/formularioRegistro">
        <button id="registrarse" name="iniciarSesion">Registrarse</button>
    </form>
<?php endif; ?>   

<!-- Si estas logueado puedes ver este boton sino no se puede-->
<?php if(isset($_SESSION['usuario'])): ?>
    <form action="<?php echo BASE_URL; ?>Usuario/logout">
        <button id="cerrarSesion" name="cerrarSesion">Cerrar Sesión</button>
    </form>
<?php endif; ?>
