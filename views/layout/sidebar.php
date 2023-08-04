<aside id="lateral">
    <div id="login" class="block_aside">
        <h3>Tu carrito de compras.</h3>
        <a href="<?= base_url ?>carrito/index" class="button button-carrito">Carrito</a>
        <br>
        <?php if (!isset($_SESSION['exito'])) : ?>
            <h3>Entrar a la web</h3>
            <?php if (isset($_SESSION['error-pass'])) :
                echo '<h4>' . $_SESSION['error-pass'] . '</h4>';
            ?>

            <?php elseif (isset($_SESSION['error-email'])) :
                echo '<h4>' . $_SESSION['error-email'] . '</h4>';
            ?>
            <?php endif; ?>
            <form action="<?= base_url ?>usuario/login" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" />
                <label for="password">Password</label>
                <input type="password" name="password" />
                <input type="submit" value="Entrar" />

            </form>
            <ul>
                <li><a href="<?= base_url ?>usuario/register">Registrarse</a>
                </li>
            </ul>
        <?php else : ?>
            <?php
            echo "<h3>";
            echo isset($_SESSION['name']) ? $_SESSION['name'] : '';
            echo "</h3>";
            ?>
            <a href="<?= base_url ?>usuario/logout">Cerrar sesion</a><br>
            <a href="<?=base_url?>pedido/misPedidos">Mis pedidos</a>
        <?php
        endif;
        ?>

        <?php if (isset($_SESSION['error-pass']) || isset($_SESSION['error-email'])) :
            require_once 'helpers/util.php';
            if (isset($_SESSION['error-pass']) || isset($_SESSION['error-email'])) :
                $error = isset($_SESSION['error-pass']) ? 'error-pass' : 'error-email';
                util::destroy_session($error);
            endif;
        endif; ?>

    </div>
    <ul>
        <?php if (isset($_SESSION['admin'])) : ?>
            <?php if ($_SESSION['admin'] == 'admin') : ?>
                <li>

                    <a href="<?=base_url?>pedido/gestionPedidos" class="button button-green">Gestionar pedidos</a>
                </li>
                <li>
                    <a href="<?= base_url ?>categoria/admin" class="button button-green">Gestionar categorias</a>
                </li>
                <li>
                    <a href="<?= base_url ?>producto/adminProduct" class="button button-red">Gestionar productos</a>

                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</aside>

<!--Central-->
<div id="central">