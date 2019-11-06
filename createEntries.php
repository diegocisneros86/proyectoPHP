<?php require_once 'includes/redirect.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- Caja Principal -->
<div id="principal">
    <h1>Crear entradas</h1>
    <p>
        Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.
    </p>
    <br>
    <form action="saveEntry.php" method="POST">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo">
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>


    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion"></textarea>
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>


    <label for="categoria">Categoría:</label>
    <select name="categoria">
        <?php 
            $categories = getCategories($db);
            if (!empty($categories)):
                while ($category = mysqli_fetch_assoc($categories)) :
        ?>
                <option value="<?=$category['id']?>">
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