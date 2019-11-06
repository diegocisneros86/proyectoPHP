<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<?php
    $actual_category = getCategory($db, $_GET['id']);

    if (!isset($actual_category['id'])) {
        header("Location: index.php");
    }
?>


<!-- Caja Principal -->
<div id="principal">
    <h1>Entradas de <?=$actual_category['nombre']?></h1>

    <?php
        $entradas = getEntries($db, null, $_GET['id']);
        if (!empty($entradas) && mysqli_num_rows($entradas) >= 1):
            while($entrada = mysqli_fetch_assoc($entradas)):
    ?>
            <article class="entrada">
            <a href="entry.php?id=<?=$entrada['id']?>">
                <h2><?=$entrada['titulo']?></h2>
                <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                <p>
                    <?=substr($entrada['descripcion'], 0, 200)."..."?>
                </p>
            </a>

    <?php
            endwhile;
        else:
    ?>
    <div class="alerta">No hay entradas en esta categoría.</div>
    <?php
        endif;
    ?>

</div>
<!-- Caja Principal Ends -->
    
    
<?php require_once 'includes/pie.php'; ?>