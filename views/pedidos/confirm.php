<?php if (isset($_SESSION['confirm']) && $_SESSION['confirm'] == "confirmado") : ?>
    <h1>Tu pedido ha sido confirmado</h1>
    <p>Tu pedido ya esta confirmado,
        recorda que para que podamos enviarlo a tu direccion,
        tenes que realizar el pago a la cuenta con CBU: <strong>1515533000000742</strong>. Pasadas las 24 horas, te avisaremos en cuanto este en camino.
    </p>
    <br>
    <h3>Datos del pedido</h3><br>
    <h3>Coste total: $<strong><?= number_format($_SESSION['coste']) ?></strong></h3>
    <br>
    <h4>A nombre de: <strong><?= $_SESSION['name'] ?></strong></h4>
    <br>
    <h4>Direccion: <p><?= $pedido->direccion ?></p>
    </h4>
    <br>
    <h4>Nro. de pedido: <strong><?= $pedido->id ?></strong></h4>
    <?php require_once 'helpers/util.php';
    util::destroy_session("cart");
    util::destroy_session("coste"); ?> <br>
    <h1>Resumen del pedido</h1>
    <table>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <?php while ($p = $productosPedido->fetch_assoc()) : ?>
            <tr>
                <td><img src="<?= base_url ?>uploads/images/<?=isset($p['imagen']) ? $p['imagen'] : 'camiseta.png'?>" class="img_carrito" alt="foto de vestimenta"/></td>
                <td> <a href="<?= base_url?>producto/detailProduct&id=<?=$p['id']?>"><?= $p['nombre']?></a></td>
                <td><h2> $<strong><?= $p['precio'] ?></strong></h2></td>
                <td><h2> <?= $p['unidades'] ?></h2></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="<?=base_url?>pedido/misPedidos" class="button button-green">Ver mis pedidos</a>
<?php else : ?>
    <h1>Tu pedido ha sido rechazado, por favor intente mas tarde.</h1>
<?php endif; ?>