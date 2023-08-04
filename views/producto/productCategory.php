<?php if (isset($title) && $title) : ?>
    <h1>Algunos de nuestros articulos de <strong><?= $title ?></strong></h1>
    <?php else: ?>
        <div class="alert">
            <h2>No hay productos para mostrar</h2>
        </div>
<?php endif; ?>
<?php
while ($p = $productos->fetch_object()) : ?>
    <div class="product">
        <a href="<?= base_url ?>producto/detailProduct&id=<?= $p->id ?>">
            <img src="<?= base_url ?>uploads/images/<?= $p->imagen ?>">
            <h2><?= $p->nombre ?></h2>
        </a>
        <p><?= $p->precio ?><strong> ARS </strong></p>
        <a href="<?= base_url ?>carrito/index&id=<?= $p->id ?>" class="button">Comprar</a>
    </div>
<?php endwhile; ?>
</div>