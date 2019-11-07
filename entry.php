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
    <h1><?=$actual_entry['titulo']?></h1>

    <a href="category.php?id=<?=$actual_entry['categoria_id']?>">
        <h2><?=$actual_entry['categoria']?></h2>
    </a>

    <h4><?=$actual_entry['fecha']?> | <?=$actual_entry['usuario']?></h4>

    <p>
        <?=$actual_entry['descripcion']?>
    </p>
    <br>
    <?php if(isset($_SESSION["user"]) && $_SESSION['user']['id'] == $actual_entry['usuario_id']) : ?>
        <a href="editEntry.php?id=<?=$actual_entry['id']?>" class="boton ">Editar entrada</a>
        <a href="deleteEntry.php?id=<?=$actual_entry['id']?>" class="boton boton-rojo">Borrar entrada</a>
    <?php endif; ?>
</div>
<!-- Caja Principal Ends -->
    
    
<?php require_once 'includes/pie.php'; ?>