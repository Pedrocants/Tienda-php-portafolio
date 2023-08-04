<?php
if (isset($pro) && is_object($pro) && $edit) :
?>
    <?php $url = base_url . "producto/edit&id=" . $id; ?>
    <h1>Editar producto</h1>
<?php else : ?>
    <?php $url = base_url . "producto/save"; ?>
    <h1>Crear producto</h1>

<?php endif; ?>
<div class="form_conteiner">
    <form action="<?=$url ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Nombre</label>
        <input type="text" name="name" value="<?= isset($pro) && !empty($pro->getName()) ? $pro->getName() : null?>" required />
        <label for="description">Descripcion</label>
        <textarea name="description" rows="10" resize="none" required><?=isset($pro) && !empty($pro->getDescription()) ? $pro->getDescription() : null ?></textarea>
        <label for="category">Categoria</label>
        <select name="category" required>
            <option selected>Seleccionar una...</option>
            <?php $category = util::getCategory();
            while ($c = $category->fetch_assoc()) : ?>
                <option value="<?= $c['id'] ?>" <?=isset($pro) && $c['id'] === $pro->getCategory_id() ? 'selected' : '' ?>>

                    <?= $c['nombre'] ?>

                </option>
            <?php endwhile; ?>
        </select>
        <label for="price">Precio</label>
        <input type="text" name="price" value="<?=isset($pro) && !empty($pro->getPrice()) ? $pro->getPrice() : null ?>" required />
        <label for="stock">Stock</label>
        <input type="numeric" name="stock" value="<?=isset($pro) && !empty($pro->getStock()) ? $pro->getStock() : "" ?>" required />
        <label for="image">Imagen</label>
        <input type="file" name="image" />
        <input type="submit" value="<?=!isset($edit) || !$edit ? "Guardar" :"Actualizar producto"?> " />
    </form>
</div>