

<!-- Barra Lateral -->
<aside id="sidebar">

    <?php if (isset($_SESSION['user'])) : ?>
    <div id="logged_user" class="bloque">
        <h3>Bienvenido, <?=$_SESSION['user']['nombre'].' '.$_SESSION['user']['apellidos']; ?></h3>
        <!-- Botones -->
        <a href="createEntries.php" class="boton boton-verde">Crear entrada</a>
        <a href="createCategory.php" class="boton ">Crear categoría</a>
        <a href="profile.php" class="boton boton-naranja">Perfil</a>
        <a href="logout.php" class="boton boton-rojo">Cerrar Sesión</a>
    </div>
    <?php endif; ?>

    <?php if (!isset($_SESSION['user'])) : ?>
    <div id="login" class="bloque">
        <h3>Indentifícate</h3>

        <?php if (isset($_SESSION['error_login'])) : ?>
        <div class="alerta alerta-error">
            <?=($_SESSION['error_login']); ?>
        </div>
        <?php endif; ?>
        
        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email">

            <label for="password">Contraseña</label>
            <input type="password" name="password">

            <input type="submit" value="Entrar">
        </form>
    </div>

    <div id="register" class="bloque">
        <h3>Regístrate</h3>

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

        <form action="register.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

            <label for="email">Email</label>
            <input type="email" name="email">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

            <input type="submit" name="submit" value="Registrar">
        </form>
        <?php borrarErrores(); ?>
    </div>
    <?php endif; ?>
</aside>