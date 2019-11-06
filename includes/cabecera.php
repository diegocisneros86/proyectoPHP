<?php require_once 'conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="assets/styles/style.css">
    <title>Blog de Videojuegos</title>
</head>
<body>
    <!-- Cabecera -->
    <header id="cabecera">
    <!-- Logo -->
        <div id="logo">
            <a href="index.php">
                Blog de Videojuegos
            </a>
        </div>

        <!-- Menú -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <!-- Bucle para recorrer las categorías llamando a la función getCategories -->
                <?php 
                    $categories = getCategories($db);
                    if (!empty($categories)):
                        while ($category = mysqli_fetch_assoc($categories)): 
                ?>
                            <li>
                                <!-- impromir el nombre la consulta y en el href impprimir el id de la misma -->
                                <a href="category.php?id=<?=$category['id']?>"><?=$category['nombre']?></a>
                            </li>
                <?php 
                        endwhile;
                    endif;
                ?>
                <li>
                    <a href="index.php">Sobre mí</a>
                </li>
                <li>
                    <a href="index.php">Contacto</a>
                </li>
            </ul>
        </nav>

        <div class="clearfix"></div>
    </header>

    <div id="contenedor">
    <!-- Barra Lateral -->