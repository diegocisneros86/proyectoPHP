<?php

if (isset($_POST)) {
    
    // Conexión a la Base de Datos
    require_once 'includes/conexion.php';

    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $usuario = $_SESSION['user']['id'];

    // Array de errores
    $errores = array();
    
    // Validar los datos antes de guardarlos en la db
    // Validar titulo
    if (empty($titulo)) {
        $errores['titulo'] = "El título no es válido.";
    }
    if (empty($descripcion)) {
        $errores['descripcion'] = "La descripción no es válida.";
    }
    if (empty($categoria) && !is_numeric($category)) {
        $errores['categoria'] = "La categoría no es válida.";
    }

    if (count($errores) == 0) {
        $sql = "INSERT INTO entradas VALUES(null, $usuario, $categoria, '$titulo', '$descripcion', CURDATE())";
        $save_entry = mysqli_query($db, $sql);

        header("Location: index.php");

    }else{
        $_SESSION["errores_entrada"] = $errores;
        
        header("Location: createEntries.php");
    }
}

