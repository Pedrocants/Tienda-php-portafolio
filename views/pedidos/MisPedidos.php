<?php if(isset($pedidos) && !empty($pedidos)) : ?>
    <?php if (isset($gestion) && $gestion) : ?>
        <h1>Gestion de pedidos</h1>
        <?php else: ?>
    <h1>Mis pedidos</h1> <br>
    <?php endif; ?>
    <table>
        <th>N° Pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Detalles</th>
        <?php while($p = $pedidos->fetch_object()): ?>
            <tr>
                <td><?=$p->id?></td>
                <td>$<?=number_format($p->coste)?></td>
                <td><strong><?=$p->fecha?></strong></td>
                <td><a href="<?=base_url?>pedido/detailsPedidos&id=<?=$p->id?>">...</a></td>
            </tr>
            <?php endwhile; ?>
    </table>
<?php endif; ?>