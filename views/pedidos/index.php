<h1>Crea tu pedido</h1>
<?php if (isset($_SESSION['exito'])) : ?>
    <a href="<?= base_url ?>carrito/index">Volver al carrito</a>
    <div class="form form-conteiner">
        <form action="<?= base_url ?>pedido/add" method="POST">
            <label for="provincia">Provincia</label>
            <input type="text" name="provincia" />
            <label for="localidad">Localidad</label>
            <input type="text" name="localidad" />
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" />
            <input type="submit" value="Realizar pedido"/>
        </form>
    </div>
<?php else : ?>
    <div class="alert alert-red">
        <h2>No podes acceder a ningun pedido si no estas registrado ¡Registrate!</h2>
    </div>
<?php endif; ?>