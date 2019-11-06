<?php

function mostrarError($errores, $campo){
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
    }

    return $alerta;
}

function borrarErrores(){
    $clear_error = false;

    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        $clear_error = true;
    }

    if (isset($_SESSION['errores_entrada'])) {
        $_SESSION['errores_entrada'] = null;
    }
    
    if (isset($_SESSION['complete'])) {
        $_SESSION['complete'] = null;
        $clear_error = true;
    }

    return $clear_error;
};

function getCategories($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categories = mysqli_query($conexion, $sql);
    $result = array();

    if ($categories && mysqli_num_rows($categories) >= 1) {
        $result = $categories;
    }

    return $result;
}

function getCategory($conexion, $id){
    $sql = "SELECT * FROM categorias WHERE id = $id;";
    $category = mysqli_query($conexion, $sql);
    $result = array();

    if ($category && mysqli_num_rows($category) >= 1) {
        $result = mysqli_fetch_assoc($category);
    }

    return $result;
}

function getEntries($conexion, $limit = null, $category = null){
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
            "INNER JOIN categorias c ON e.categoria_id = c.id ";
            

    if (!empty($category)) {
        $sql .= "WHERE e.categoria_id = $category ";
    }
            
    $sql .= "ORDER BY e.id DESC ";
    
    if ($limit) {
        // $sql = $sql." LIMIT 4";
        $sql .= "LIMIT 4";
    }
    $entradas = mysqli_query($conexion, $sql);

    $result = array();
    if($entradas && mysqli_num_rows($entradas) >= 1){
        $result = $entradas;
    }

    return $entradas;
}

function getEntry($conexion, $id){
    $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario FROM entradas e ".
            "INNER JOIN categorias c ON e.categoria_id = c.id ".
            "INNER JOIN usuarios u ON e.usuario_id = u.id ".
            "WHERE e.id = $id;";
    $entry = mysqli_query($conexion, $sql);
    $result = array();

    if ($entry && mysqli_num_rows($entry) >= 1) {
        $result = mysqli_fetch_assoc($entry);
    }

    return $result;
}