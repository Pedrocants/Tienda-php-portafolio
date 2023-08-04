<h1>Resumen del pedido</h1>
<?php if (isset($productosPedido) && $productosPedido) : ?>
<table>
    <th>Imagen</th>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Unidades</th>
    <?php while ($p = $productosPedido->fetch_assoc()) : ?>
        <tr>
            <td><img src="<?= base_url ?>uploads/images/<?= isset($p['imagen']) ? $p['imagen'] : 'camiseta.png' ?>" class="img_carrito" alt="foto de vestimenta" /></td>
            <td> <a href="<?= base_url ?>producto/detailProduct&id=<?= $p['id'] ?>"><?= $p['nombre'] ?></a></td>
            <td>
                <h2> $<strong><?= $p['precio'] ?></strong></h2>
            </td>
            <td>
                <h2> <?= $p['unidades'] ?></h2>
            </td>
        </tr>
        <?php $status = $p['estado']; ?>
        <?php $id = $p['pedido_id']; ?>
        <?php endwhile; ?>
        <h1><strong>Estado del pedido: </strong><?= getStatusSp($status) ?></h1>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 'admin') : ?>
            <br>
            <form method="post" action="<?= base_url ?>pedido/update">
                <label for="status">Estado</label>
                <select name="status">
                    <option value="confirm">Confirmado</option>
                    <option value="error">Denegado</option>
                    <option value="prepare">En preparacion</option>
                    <option value="despached">En camino</option>
                </select>
                <input type="hidden" name="id" value="<?= $id ?>" />
                <input type="submit" value="Actualizar pedido" />
            </form>
        
        <?php endif; ?>
</table>
<?php else: ?>
    <h1>No hay pedidos con este numero</h1>
<?php endif; ?>
<?php 
//Devolver datos en español.
function getStatusSp($status){
        switch($status){
            case "confirm" : return 'Confirmado'; break;
            case "error" : return 'Denegado'; break;
            case "prepare" : return 'En preparacion'; break;
            case "despached" : return 'En camino'; break;
        }
    }
?>