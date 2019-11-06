<?php

if (isset($_POST)) {

    // Conexión a la Base de Datos
    require_once 'includes/conexion.php';

    // Recoger los valores del formulario de actualización
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

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

    //Validar apellidos
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $last_name_validate = true;
    }else{
        $last_name_validate = false;
        $errores['apellidos'] = "Los apellidos no son válidos";
    }

    // Validar email
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validate = true;
    }else{
        $email_validate = false;
        $errores['email'] = "El email no es válido";
    }
    
    $save_user = false;

    if (count($errores) == 0) {
        $usuario = $_SESSION['user'];
        $save_user = true;

        // Comprobar su el email ya existe
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);

        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
            // Actualizar el usuario en la tabla correspondiente de la DB
            $usuario = $_SESSION['user'];
            $sql = "UPDATE usuarios SET ".
                    "nombre = '$nombre', ".
                    "apellidos = '$apellidos', ".
                    "email = '$email' ".
                    "WHERE id = ".$usuario['id'];
            // ejecutar consulta
            $save_user = mysqli_query($db, $sql);


            if ($save_user) {
                $_SESSION['user']['nombre'] = $nombre;
                $_SESSION['user']['apellidos'] = $apellidos;
                $_SESSION['user']['email'] = $email;

                $_SESSION['complete'] = "Datos actualizados correctamente.";
            }else {
                $_SESSION['errores']['general'] = "Error al actualizar datos.";
            }
        }else {
            $_SESSION['errores']['general'] = "Ese correo ya está en uso.";
        }

    }else {
        // pasar el array de errores a la sesión
        $_SESSION['errores'] = $errores;
    }
}

// redireccionar a index
header('Location: profile.php');