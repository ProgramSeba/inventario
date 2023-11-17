<?php
session_start();

include("online.php");

// Verificar la sesión del usuario
if (!isset($_SESSION['nombre_us'])) {
    // El usuario no ha iniciado sesión, redirige a la página de login
    header('Location: ../index.html');
    exit();
}

// Obtener el ID del usuario
$username = $_SESSION['nombre_us'];
$sql_user = "SELECT id_us FROM usuario WHERE nombre_us = '$username'";
$query_user = mysqli_query($online, $sql_user);

if ($query_user) {
    if (mysqli_num_rows($query_user) == 1) {
        $user_data = mysqli_fetch_assoc($query_user);
        $id_usuario = $user_data['id_us'];
    } else {
        // Maneja el caso en el que el usuario no existe
        echo "Usuario no encontrado.";
        exit();
    }
} else {
    // Maneja el caso de error en la consulta SQL
    echo "Error en la consulta SQL.";
    exit();
}

// Obtener los datos del formulario
$nombre_item = $_POST['nombre_item'];
$desc_item = $_POST['desc_item'];

// Manejo de la imagen
$foto_item = '../img/espada.png'; // Imagen por defecto en caso de que no se envíe una nueva

if ($_FILES['foto_item']['error'] == 0) {
    // Verificar si se subió una imagen
    $foto_temp = $_FILES['foto_item']['tmp_name'];
    $foto_name = $_FILES['foto_item']['name'];
    $foto_extension = pathinfo($foto_name, PATHINFO_EXTENSION);
    
    // Generar un nombre único para la imagen
    $foto_item = uniqid('img_') . '.' . $foto_extension;

    // Mover la imagen a la carpeta de destino
    move_uploaded_file($foto_temp, '../img/imagen_item/' . $foto_item);
}

// Insertar los datos en la base de datos
$sql_item = "INSERT INTO item (nombre_item, desc_item, foto_item) VALUES ('$nombre_item', '$desc_item', '$foto_item')";
$query_item = mysqli_query($online, $sql_item);

if ($query_item) {
    // Obtén el ID del último elemento insertado
    $id_item_insertado = mysqli_insert_id($online);

    // Insertar en la tabla de relación
    $sql_relacion = "INSERT INTO usuario_item_relacion (id_usuarios, id_items) VALUES ('$id_usuario', '$id_item_insertado')";
    $query_relacion = mysqli_query($online, $sql_relacion);

    if (!$query_relacion) {
        echo "Error al crear la relación usuario-item: " . mysqli_error($online);
    } else {
        echo "Item agregado correctamente.";
    }
} else {
    echo "Error al agregar el item.";
}

?>
