<h1><strong>Carrito de compras</strong></h1>
<table>
    <th>Imagen</th>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Unidades</th>
    <th>Accion</th>
    <?php if (!is_null($cartProd) && !empty($cartProd)) : ?>
        <?php foreach ($cartProd as $key => $producto) : ?>
            <?php $p = isset($producto['producto']) ? $producto['producto'] : '' ?>
            <?php if (is_null($p)) : ?>
                <?php break; ?>
            <?php endif; ?>
            <tr>
                <?php if ($p && $p['imagen'] == NULL) : ?>
                    <td> <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta por defecto" class="img_carrito"></td>
                <?php elseif ($p): ?>
                    <td> <img src="<?= base_url ?>uploads/images/<?= $p['imagen'] ?>" alt="<?= $p['descripcion'] ?>" class="img_carrito"></td>
                <?php endif; ?>
                <td><a href="<?= base_url ?>producto/detailProduct&id=<?= $p['id'] ?>"><?= $p['nombre'] ?></a></td>
                <td>$<?= $p['precio'] ?></td>
                <td><?= $cartProd[$key]['Unidades'] ?>
                <div class="updown-unidades">
                    <a href="<?= base_url ?>carrito/restar&id=<?= $p['id'] ?>" class="button button-down">-</a>
                    <a href="<?= base_url ?>carrito/index&id=<?= $p['id'] ?>" class="button button-down">+</a>
                </div>
            </td>
                <?php
                $c = 0;
                while ($c < $cartProd[$key]['Unidades']) : ?>
                    <?php $totalPago += $p['precio']; ?>
                    <?php $c++ ?>
                <?php endwhile; ?>
                <td><a href="<?= base_url ?>carrito/deleteP&id=<?= $p['id'] ?>" class="button button-red">x</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) >= 1) : ?>
        <td>
            <a href="<?= base_url ?>carrito/removeAll" class="button button-red">Vaciar carrito</a>
        </td>
        <?php endif; ?>
</table>

<?php if ($totalPago == 0) : ?>
    <h2>No hay productos seleccionados</h2>
<?php else : ?>
    <a href="<?= base_url ?>pedido/index" class="button button-pedido">Realizar pedido</a>
    <div class="total-carrito">
        <h1><strong>Total productos:</strong> <?= $counter ?></h1>
        <h3><strong>Total a pagar: $</strong><?= $totalPago ?></h3>
    </div>
    <?php $_SESSION['coste'] = $totalPago; ?>
<?php endif; ?>