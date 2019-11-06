<?php

if (isset($_POST)) {

    // Conexión a la Base de Datos
    require_once 'includes/conexion.php';
    // Iniciar sesión
    if (!isset($_SESSION)) {
        session_start();
    } 

    // Recoger los valores del formulario de registro
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']): false;

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

    // Validar password
    if (!empty($password)) {
        $pass_validate = true;
    }else{
        $pass_validate = false;
        $errores['password'] = "El password está vacío";
    }
    
    $save_user = false;

    if (count($errores) == 0) {
        $save_user = true;

        // Cifrar la contraseña con una funcion propia de php, se le pasan como parametros el password
        // el tipo de cifrado y cost -que es el número de veces que cifra la contraseña
        $password_safe = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        
        /* Para validar que la contraseña sea segura y que los cifrados son correctos:
        var_dump($password);
        var_dump($password_safe);
        var_dump(password_verify($password, $password_safe));
        die();
        */

        // Insertar el usuario en la tabla correspondiente de la DB
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_safe', CURDATE());";
        // ejecutar consulta
        $save_user = mysqli_query($db, $sql);

        // var_dump(mysqli_error($db));
        // die();
        
        if ($save_user) {
            $_SESSION['complete'] = "El registro se ha completado con éxtio";
        }else {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
        }

    }else {
        // pasar el array de errores a la sesión
        $_SESSION['errores'] = $errores;
    }
}

// redireccionar a index
header('Location: index.php');