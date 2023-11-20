<?php

session_start();

if (!isset($_SESSION['nombre_us'])) {
    // El usuario no ha iniciado sesión, redirige a la página de login
    header('Location: ../index.html');
    exit();
}

include("../php/online.php");

$username = $_SESSION['nombre_us'];


// Consulta SQL para obtener la información del usuario
$sql = "SELECT usuario.nombre_us 
FROM usuario 
WHERE nombre_us = '$username'";
$query = mysqli_query($online, $sql);

if ($query) {
    if (mysqli_num_rows($query) == 1) {
        $user_data = mysqli_fetch_assoc($query);
        // Muestra la información del usuario en la página de perfil
        // Muestra otros campos aquí
    } else {
        // Maneja el caso en el que el usuario no existe
        echo "Usuario no encontrado.";
    }
} else {
    // Maneja el caso de error en la consulta SQL
    echo "Error en la consulta SQL.";
}


  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css"> <!-- Asegúrate de enlazar correctamente tu archivo CSS -->
    <link rel="stylesheet" href="../css/agregar_item.css">
    <title>Agregar Item</title>
</head>
<body>
    <section class="barra">
        <div class="usuario">
            <!-- Puedes incluir un mensaje de bienvenida o el nombre del usuario aquí -->
        </div>
    </section>

    <section class="intefaz">
        <div class="dentro">
            <div class="titulo">
                <h1 class="titulo-dentro">Agregar Nuevo Item</h1>
            </div>

            <div class="formulario-agregar">
                <form action="../php/procesar_agregar_item.php" method="post" enctype="multipart/form-data">
                    <label for="nombre_item">Nombre del Item:</label>
                    <input type="text" name="nombre_item" required>

                    <label for="desc_item">Descripción del Item:</label>
                    <textarea name="desc_item" required></textarea>

                    <label for="foto_item">URL de la Foto del Item:</label>
                    <input type="file" name="foto_item" accept="image/*" required>

                    <button type="submit">Agregar Item</button>
                </form>
            </div>
        </div>
    </section>

    <div class="enlace">

        <a href="index.php">Volver</a>


    </div>

    <section class="barra">
        
    </section>
</body>
</html>
