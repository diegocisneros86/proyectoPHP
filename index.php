<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>

<!-- Caja Principal -->
<div id="principal">
    <h1>Últimas entradas</h1>

    <?php
        $entradas = getEntries($db, true);
        if (!empty($entradas)):
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
        endif;
    ?>

    <div id="ver-todas">
        <a href="entries.php">Ver todas las entradas</a>
    </div>
</div>
<!-- Caja Principal Ends -->
    
    
<?php require_once 'includes/pie.php'; ?>

