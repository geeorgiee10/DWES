
<?php if(isset($_SESSION['falloDatos'])): ?>

<h2>Error al borrar el producto</h2>
<p><a href="<?= BASE_URL ?>">Volver</a></p>
<?php unset($_SESSION['falloDatos']) ?>
<?php else:?>

<div id="botones">

    <?php if($admin): ?>

        <a href="<?= BASE_URL?>Product/deleteProduct/<?= $details[0]['id']?>" class="botonesProductos">Borrar producto</a></li>

    
        <a href="<?= BASE_URL?>Product/updateProduct/<?= $details[0]['id']?>" class="botonesProductos">Editar producto</a>
    <?php endif;?>

</div>

<div id="productDetail">

        <?php foreach($details as $detail): ?>

            <div class="cardDetail">
                <div class="imageDetail">
                    <img src="<?=BASE_URL?>public/img/<?= htmlspecialchars($detail["imagen"]) ?>" alt="producto">
                </div>
                <div class="bodyDetail">
                    <div class="titleDetail"><?= htmlspecialchars($detail["nombre"]) ?></div>
                    <div class="descriptionDetail"><?= htmlspecialchars($detail["descripcion"]) ?></div>
                    <div class="priceDetail">Precio: <?= htmlspecialchars($detail["precio"]) ?>€</div>
                    <div class="stockDetail">Número de Unidades: 
                        <?php 
                            if($detail["stock"] != 0){
                                echo htmlspecialchars($detail["stock"]);
                            }
                            else{
                                echo "Agotado";
                            }
                        ?></div>
                    <div class="ofertDetail">Oferta de <?= htmlspecialchars($detail["oferta"]) ?>%</div>
                    <?php if($detail["stock"] != 0): ?>
                    <div class="buttonCart">
                        <a href="<?= BASE_URL?>Cart/addProduct/<?= htmlspecialchars($detail["id"]) ?>" class="botonesProductos">Añadir al carrito</a>
                    </div>
                    <?php endif;?>
                </div>

                
            </div>

        <?php endforeach;?>


</div>

<?php endif;?>