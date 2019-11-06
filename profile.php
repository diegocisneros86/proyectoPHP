<?php require_once 'includes/redirect.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>


<!-- Caja Principal -->
<div id="principal">
    <h1>Perfil</h1>

     <!-- Mostrar errores -->
     <?php if (isset($_SESSION['complete'])): ?>
        <div class="alerta alerta-exito">
            <?=$_SESSION['complete']?>
        </div>        
    <?php elseif(isset($_SESSION['errores']['general'])): ?>
        <div class="alerta alerta-error">
            <?=$_SESSION['errores']['general']?>
        </div>  
    <?php endif; ?>

    <form action="updateUser.php" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=$_SESSION['user']['nombre']; ?>">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" value="<?=$_SESSION['user']['apellidos']; ?>">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?=$_SESSION['user']['email']; ?>">
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

        <input type="submit" name="submit" value="Actualizar">
    </form>
    <?php borrarErrores(); ?>



    </div>
<!-- Caja Principal Ends -->
    
    
<?php require_once 'includes/pie.php'; ?>