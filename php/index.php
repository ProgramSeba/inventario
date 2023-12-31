<?php

session_start();

if (!isset($_SESSION['nombre_us'])) {
    // El usuario no ha iniciado sesión, redirige a la página de login
    header('Location: ../index.html');
    exit();
}

include("online.php");
include("item_preestablecido.php");

$username = $_SESSION['nombre_us'];

// Consulta SQL para obtener la información del usuario y sus items
$sql = "SELECT usuario.id_us, usuario.nombre_us, item.nombre_item, item.foto_item
        FROM usuario_item_relacion 
        JOIN item ON usuario_item_relacion.id_items = item.id_item
        JOIN usuario ON usuario_item_relacion.id_usuarios = usuario.id_us
        WHERE usuario.nombre_us = '$username'";
$query = mysqli_query($online, $sql);

// Consulta SQL para obtener la información del usuario
$sql_usuario = "SELECT * FROM usuario WHERE nombre_us = '$username'";
$query_usuario = mysqli_query($online, $sql_usuario);

// Verificar si la consulta fue exitosa
if ($query_usuario) {
    // Obtener los datos del usuario
    $user_data = mysqli_fetch_assoc($query_usuario);
} else {
    // Manejar el caso de error en la consulta SQL del usuario
    echo "Error en la consulta SQL del usuario.";
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap">
    <link rel="stylesheet" href="../css/style.css">
   
    <title>Inventario</title>
</head>
<body>
    <section class="barra">

    </section>

    <div class="usuario">
        <?php
            // Muestra el nombre del usuario
            echo '<p>Bienvenido, ' . $user_data['nombre_us'] . '!</p>';
        ?>
    </div>

    <section class="intefaz">
        <div class="dentro">
            <div class="titulo">
                <h1 class="titulo-dentro">Inventario</h1>
            </div>

            <div class="inventario">
                <div class="cajitas">
                    <?php
                        echo '<div class="cuadrados-container">';
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '<div class="cuadrado">';
                            echo '<img src="../img/imagen_item/' . $row['foto_item'] . '" alt="' . $row['nombre_item'] . '">';
                            echo '<div class="nombre-overlay">' . $row['nombre_item'] . '</div>';
                            echo '</div>';
                        
                            // Agrega un salto de línea después de cada tercer cuadrado
                            $count++;
                            if ($count % 3 == 0) {
                                echo '</div><div class="cuadrados-container">';
                            }
                        }
                        echo '</div>';
                        

                    ?>
                </div>
            </div>
        </div>
    </section>




    <section class="controles">
    <div class="enlace">

        <a href="agregar_item.php">Agregar Item</a>

    </div>

    <div class="enlace" style=" background-color: red;">
    <a href="eliminar_item.php">Eliminar Item</a>
    </div>

    <div class="enlace">

        <a href="modificar_item.php">Modificar Item</a>

    </div>

    </section>

    

    <section class="barra">

    </section>
</body>
</html>
