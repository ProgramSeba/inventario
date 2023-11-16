<?php
include("online.php");

session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar las credenciales en la base de datos
    $sql = "SELECT nombre_us, contrasenia_us FROM usuario WHERE nombre_us = '$username'";
    $query = mysqli_query($online, $sql);

    if ($query) {
        if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_assoc($query);
            $stored_password = $row['contrasenia_us'];

            // Compara la contraseña ingresada con la almacenada en la base de datos
            if ($password === $stored_password) {
                // Las credenciales son correctas, inicia la sesión y redirige al usuario
                $_SESSION['nombre_us'] = $username;
                echo "Redirigiendo a index.php";  // Agrega esta línea para verificar si se alcanza esta parte
                header('Location: index.php');
                exit();
            } else {
                // Las credenciales son incorrectas, muestra un mensaje de error
                echo "Credenciales incorrectas. Intenta de nuevo.";
            }
        } else {
            // El usuario no existe, muestra un mensaje de error
            echo "Usuario no encontrado. Intenta de nuevo.";
        }
    } else {
        // Maneja el caso de error en la consulta SQL
        echo "Error en la consulta SQL.";
    }
}


?>