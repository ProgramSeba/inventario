<?php

session_start();

if (!isset($_SESSION['nombre_us'])) {
    // El usuario no ha iniciado sesión, redirige a la página de login
    header('Location: ../index.html');
    exit();
}

include("online.php");

$username = $_SESSION['nombre_us'];

// Consulta SQL para obtener la información del usuario y sus items
$sql = "SELECT usuario.id_us, usuario.nombre_us, item.nombre_item FROM usuario_item_relacion 
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
                        // Muestra los items del usuario
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '<div class="cuadrado">
                                    <img src="../img/imagen_item/'.$row['nombre_item'].'.png" alt="'.$row['nombre_item'].'">
                                    <div class="nombre-overlay">'.$row['nombre_item'].'</div>
                                  </div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="elegir-items">
        <h2>Elegir Items</h2>
        <form action="agregar_item.php" method="POST">
            <select name="nuevo_item">
                <option value="Item 11">Item 11</option>
                <option value="Item 12">Item 12</option>
            </select>
            <button type="submit">Agregar al Inventario</button>
        </form>
    </section>

    <a href="../html/agregar_item.php">ja</a>

    <section class="barra">

    </section>
</body>
</html>
