<?php
session_start();

include("online.php");

if (!isset($_SESSION['nombre_us'])) {
    // El usuario no ha iniciado sesión, redirige a la página de login
    header('Location: ../index.html');
    exit();
}

// Obtén el nombre de usuario de la sesión
$username = $_SESSION['nombre_us'];

// Verifica si se ha enviado un formulario para eliminar un ítem
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar_item"])) {
    // Obtén el ID del ítem a eliminar desde el formulario
    $id_item_eliminar = $_POST["id_item"];

    // Elimina el ítem del usuario
    $sql_eliminar_item = "DELETE FROM usuario_item_relacion
                          WHERE id_usuarios = (SELECT id_us FROM usuario WHERE nombre_us = '$username')
                          AND id_items = $id_item_eliminar";

    $query_eliminar_item = mysqli_query($online, $sql_eliminar_item);

    if ($query_eliminar_item) {
        echo "¡Item eliminado exitosamente!";
    } else {
        echo "Error al eliminar el item.";
    }
}

// Consulta SQL para obtener la información del usuario y sus items
$sql = "SELECT usuario.id_us, usuario.nombre_us, item.id_item, item.nombre_item, item.foto_item
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   
    <title>Eliminar Item</title>
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
                <h1 class="titulo-dentro">Eliminar Item</h1>
            </div>

            <div class="inventario">
                <div class="cajitas">
                    <?php
                        echo '<div class="cuadrados-container">';
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '<div class="cuadrado" data-id="' . $row['id_item'] . '">';
                            echo '<img src="../img/imagen_item/' . $row['foto_item'] . '" alt="' . $row['nombre_item'] . '">';
                            echo '<div class="nombre-overlay">' . $row['nombre_item'] . '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    ?>
                </div>
            </div>
        </div>
    </section>

    <div class="enlace">

        <a href="index.php">Volver</a>


    </div>

    <section class="barra">

    </section>

    <script>
        $(document).ready(function() {
            $('.cuadrado').click(function() {
                var id_item = $(this).data('id');
                eliminarItem(id_item);
            });

            function eliminarItem(id_item) {
                $.ajax({
                    type: "POST",
                    url: "eliminar_item.php",
                    data: { eliminar_item: true, id_item: id_item },
                    success: function(response) {
                        alert(response);
                        // Recargar la página o realizar alguna acción adicional si es necesario
                        location.reload();
                    },
                    error: function() {
                        alert("Error al eliminar el item.");
                    }
                });
            }
        });
    </script>
</body>
</html>
