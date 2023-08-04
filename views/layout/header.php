<!DOCTYPE html>
<html lang="es">
<!--Creacion de vista y recorrido por las distintas categorias en su menu!-->

<head>
    <meta charset="UTF-8">
    <title>Tienda</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/styles.css" />
</head>

<body>

    <div id="container">

        <header id="header">
            <div id="logo">
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="camiseta" />
                <a href="<?= base_url ?>">tienda de camisetas</a>
            </div>

        </header>
        <!--Menu-->
        <nav id="menu">
            <ul>
                <li>
                    <a href="<?= base_url ?>">
                        Inicio
                    </a>
                </li>
                <li>
                    <?php require_once 'helpers/util.php';
                    $categories = util::getCategory();
                    while ($cat = $categories->fetch_assoc()) :
                    ?>
                <li><a href="<?=base_url?>producto/getProductsCategory&id=<?=$cat['id']?>"> <?= $cat['nombre'] ?></a></li>
            <?php endwhile;
            ?>
            </ul>
        </nav>

        <!--Lateral-->
        <div id="content">