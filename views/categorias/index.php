<!--Vista de creacion de categorias!-->
<?php if(isset($_SESSION['error-nombre'])):
    echo '<h4>';
    echo $_SESSION['error-nombre'] . '</h4>'; ?>
    
    <?php endif;?>
<form action="<?= base_url ?>categoria/createCategoria" method="POST">
    <label for="name">Nombre</label>
    <input type="text" name="name" required />
    <input type="submit" value="Agregar categoria" />
</form>
<?php if(isset($_SESSION['error-nombre'])):
    require_once 'helpers/util.php';
    util::destroy_session('error-nombre');
endif;
?>