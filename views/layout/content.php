<h1>Algunos de nuestros articulos</h1>
<?php
while ($p = $productos->fetch_object()) : ?>
    <div class="product">
        <a href="<?=base_url?>producto/detailProduct&id=<?=$p->id?>">
            <img src="<?=base_url?>uploads/images/<?=$p->imagen?>">
            <h2><?= $p->nombre ?></h2>
    </a>
        <p><?= $p->precio ?><strong> ARS </strong></p>
        <a href="<?=base_url?>carrito/index&id=<?=$p->id?>" class="button">Comprar</a>
    </div>
<?php endwhile; ?>
</div>