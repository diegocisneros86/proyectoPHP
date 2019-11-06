<?php

if (isset($_POST)) {
    
    // Conexión a la Base de Datos
    require_once 'includes/conexion.php';

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;

    // Array de errores
    $errores = array();
    
    // Validar los datos antes de guardarlos en la db
    // Validar nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $name_validate = true;
    }else{
        $name_validate = false;
        $errores['nombre'] = "El nombre no es válido";
    }
    
    if (count($errores == 0)) {
        $sql = "INSERT INTO categorias VALUES(null, '$nombre');";
        $save_category = mysqli_query($db, $sql); 
    }

}

header("Location: index.php");