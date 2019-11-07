<?php require_once 'includes/redirect.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<?php
    $actual_entry = getEntry($db, $_GET['id']);
    
    if (!isset($actual_entry['id'])) {
        header("Location: index.php");
    }
?>

<!-- Caja Principal -->
<div id="principal">
    <h1>Editar entrada</h1>
    <p>
        Edita tu entrada <strong><?=$actual_entry['titulo']?>.</strong>
    </p>
    <br>

    <form action="saveEntry.php?edit=<?=$actual_entry['id']?>" method="POST">
    
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" value="<?=$actual_entry['titulo']?>">
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>


    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion"><?=$actual_entry['descripcion']?></textarea>
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>


    <label for="categoria">Categoría:</label>
    <select name="categoria">
        <?php 
            $categories = getCategories($db);
            if (!empty($categories)):
                while ($category = mysqli_fetch_assoc($categories)) :
        ?>
                <option value="<?=$category['id']?>"
                <?=($category['id'] == $actual_entry['categoria_id']) ? 'selected="selected"' : '' ?>>
                    <?=$category['nombre']?>
                </option>
        <?php
                endwhile;
            endif;
        ?>
    </select>
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>
   
    <input type="submit" value="Guardar">
    </form>
    <?php borrarErrores(); ?>
    
</div>
<!-- Caja Principal Ends -->
    
    
<?php require_once 'includes/pie.php'; ?>