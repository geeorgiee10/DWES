<div id="botones">

    <a href="<?= BASE_URL?>Category/categorias" class="botonesProductos">Ver las categorias</a></li>

    <?php if($admin): ?>
        <a href="<?= BASE_URL?>Product/guardarProductos" class="botonesProductos">Añadir producto</a>
    <?php endif;?>

    <?php if(isset($_SESSION['usuario'])): ?>
        <a href="<?= BASE_URL?>Order/seeOrders" class="botonesProductos">Ver mis pedidos</a>
    <?php endif;?>

</div>

<div id="producto">



    <h2>Listado de Productos</h2>


    <ul id="listaProductos">
        <?php foreach($productos as $producto): ?>

        <?php 
            $descatalogados = ($producto["categoria_id"] == 14);
        ?>

        <?php if(!$descatalogados || $admin): ?>
        <a href="<?= BASE_URL?>Product/detailProduct/<?= htmlspecialchars($producto["id"]) ?>" class="itemProducto">
        <li class="<?= $producto["stock"] == 0 ? 'agotado' : '' ?>">
            <div class="card">
                <div class="image">
                    <img src="<?=BASE_URL?>public/img/<?= htmlspecialchars($producto["imagen"]) ?>" alt="producto">
                </div>
                <div class="cuerpo">
                    <div class="titulo"><?php echo htmlspecialchars($producto["nombre"]) ?></div>
                    <div class="descripcion"><?php echo htmlspecialchars($producto["descripcion"]) ?></div>
                    <div class="precio">Precio: <?php echo htmlspecialchars($producto["precio"]) ?>€</div>
                    <div class="stock">Número de Unidades: 
                        <?php 
                            if($producto["stock"] != 0){
                                echo htmlspecialchars($producto["stock"]);
                            }
                            else{
                                echo "Agotado";
                            }
                        ?></div>
                    <div class="oferta">Oferta de <?php echo htmlspecialchars($producto["oferta"]) ?>%</div>
                </div>
            </div>
        </li>
        </a>
        <?php endif; ?>

        <?php endforeach;?>
    </ul>


</div>