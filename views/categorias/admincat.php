<ul>
    <li><a href="<?= base_url ?>categoria/index">Agregar categoria </a>
</ul>

<table border="1">
    <tr>
        <td><h4>ID</h4></td>
        <td><h4>Nombre</h4></td>
    </tr>

    <?php while ($cat = $categories->fetch_assoc()) : ?>
        <tr>
            <td>
                <?= $cat['id']; ?>

            </td>
            <td>

                <?= $cat['nombre'] ?>
            </td>
        <?php endwhile; ?>
        </tr>
</table>