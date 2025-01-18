<div id="listadoCategorias">

 
    <?php if($admin): ?>
        <div class="btnCategorias">

            <a href="<?= BASE_URL?>Category/almacenarCategoria" class="botonesCategorias">Crear una categoria</a>

            <a href="<?= BASE_URL?>Category/ActualizarCategoria" class="botonesCategorias">Editar una categoria</a>

            <a href="<?= BASE_URL?>Category/BorrarCategoria" class="botonesCategorias">Borrar una categoria</a>

        </div>
    <?php endif;?>


    <h2>Categorias</h2>
        <ul id="lista">
        <?php foreach($categorias as $categoria): ?>
            <?php 
                $descatalogados = ($categoria["id"] == 14 || $categoria["nombre"] === "Descatalogados");
            ?>
            
            <?php if(!$descatalogados || $admin): ?>
            <a class="enlace" href="<?= BASE_URL?>Category/ProductXCategory/<?= htmlspecialchars($categoria["id"]) ?>">
                <li class="categoriaLista">
                    <?= htmlspecialchars($categoria["nombre"]) ?>
                </li>
            </a>
            <?php endif; ?>
        <?php endforeach;?>
        </ul>

</div>