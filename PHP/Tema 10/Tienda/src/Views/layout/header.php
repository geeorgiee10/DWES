<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <title>Tienda</title>
</head>
<body>
    
      
        <header>
        <h1 id="logo"><a href="<?=  BASE_URL?>">Fake Web Storage</a></h1>
        <nav class="menu">
            <ul>
                <?php if(isset($_SESSION['usuario'])):  ?>
                    <li id="nombreUsuario"><?= $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellidos'] ?></li>
                <?php endif;?>
                <li><a href="<?= BASE_URL?>">Inicio</a></li>

                <li><a href="<?= BASE_URL?>Product/gestion">Productos</a></li>

                <li><a href="<?= BASE_URL?>Cart/loadCart">Carrito</a></li>

                <?php if(!isset($_SESSION['usuario'])):  ?>
                    <li><a href="<?= BASE_URL?>User/registrar">Registrarse</a></li>
                    <li><a href="<?= BASE_URL?>User/iniciarSesion">Iniciar Sesión</a></li>
                <?php else: ?>
                    

                    <?php if(isset($_SESSION['usuario']) && $_SESSION["usuario"]["rol"] === "admin"):?>
                        <li><a href="<?= BASE_URL?>User/registrar">Registrar Usuarios</a></li>
                    <?php endif;?>

                    <li><a href="<?= BASE_URL?>User/verTusDatos">Ver tus datos</a></li>

                    


                    <li><a href="<?= BASE_URL?>User/logout">Cerrar Sesión</a></li>
                <?php endif;?>
            </ul>
        </nav>
        </header>
        <div id="tienda"> 
        
   
