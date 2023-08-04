<h1>Administrar productos</h1>
<ul>
    <li><a href="<?= base_url?>producto/createProduct" class="button button-gestion">Nuevo Producto</a></li>
</ul><br>

<table border="1">
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>DECRIPCION</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCION</th>
    </tr>

    <?php while ($p = $product->fetch_assoc()) : ?>
        <tr>
            <td>
                <?= $p['id']; ?>

            </td>
            <td>
                <?= $p['nombre']?>
            </td>
            <td>
                <?= $p['descripcion']?>
            </td>
            <td>
                <?= $p['precio']?> <strong>ARS</strong>
            </td>
            <td>
                <?= $p['stock']?>
            </td>
            <td>
                <a href="<?=base_url?>producto/remove&id=<?=$p['id']?>" class="button button-small">Eliminar</a>
                <a href="<?= base_url?>producto/update&id=<?=$p['id']?>" class="button button-small">Editar</a>
            </td>
        <?php endwhile; ?>
        </tr>
</table>
<?php
    util::destroy_session(isset($_SESSION['product']) ? $_SESSION['product'] : '');
?>