<?php
if (isset($p)) : ?>
    <div id="detail-product">
        <h1><?= $p['nombre'] ?></h1>
        <div class="image">
            <?php if ($p['imagen'] == NULL) : ?>
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta por defecto">
            <?php else : ?>
                <img src="<?= base_url ?>uploads/images/<?= $p['imagen'] ?>" alt="<?= $p['descripcion'] ?>">
            <?php endif; ?>
        </div>
        <div class="data">
            <p><?= $p['descripcion'] ?></p>
            <p><?= $p['precio'] ?><strong> ARS</strong></p><br>
            <a href="<?=base_url?>carrito/index&id=<?=$p['id']?>" class="button">Comprar</a>
        </div>

    </div>
<?php else : ?>
    <h1>No existe ningun producto</h1>
<?php endif; ?>