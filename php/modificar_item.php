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

// Verifica si se ha enviado un formulario para modificar un ítem
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modificar_item"])) {
    // Obtén el ID y el nuevo nombre del ítem desde el formulario
    $id_item_modificar = $_POST["id_item"];
    $nuevo_nombre = $_POST["nuevo_nombre"];

    // Actualiza el nombre del ítem del usuario
    $sql_modificar_item = "UPDATE item
                           SET nombre_item = '$nuevo_nombre'
                           WHERE id_item = $id_item_modificar";

    $query_modificar_item = mysqli_query($online, $sql_modificar_item);

    if ($query_modificar_item) {
        echo "¡Item modificado exitosamente!";
    } else {
        echo "Error al modificar el item.";
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
   
    <title>Modificar Item</title>
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
                <h1 class="titulo-dentro">Modificar Item</h1>
            </div>

            <div class="inventario">
                <div class="cajitas">
                    <?php
                        echo '<div class="cuadrados-container">';
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '<div class="cuadrado" data-id="' . $row['id_item'] . '">';
                            echo '<img src="../img/imagen_item/' . $row['foto_item'] . '" alt="' . $row['nombre_item'] . '">';
                            echo '<div class="nombre-overlay">' . $row['nombre_item'] . '</div>';
                            echo '<button class="modificar-btn">Modificar</button>';
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

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Modificar Item</h2>
            <form id="modificarForm" method="post">
                <input type="hidden" id="idItemModificar" name="id_item">
                <label for="nuevoNombre">Nuevo Nombre:</label>
                <input type="text" id="nuevoNombre" name="nuevo_nombre" required>
                <button type="submit" name="modificar_item">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.cuadrado').click(function() {
                var id_item = $(this).data('id');
                mostrarModal(id_item);
            });

            $('.modificar-btn').click(function(event) {
                event.stopPropagation();
                var id_item = $(this).parent().data('id');
                mostrarModal(id_item);
            });

            function mostrarModal(id_item) {
                $('#idItemModificar').val(id_item);
                $('#modal').css('display', 'block');
            }

            $('.close').click(function() {
                $('#modal').css('display', 'none');
            });

            window.onclick = function(event) {
                if (event.target == $('#modal')[0]) {
                    $('#modal').css('display', 'none');
                }
            };

            $('#modificarForm').submit(function(event) {
                event.preventDefault();
                var id_item = $('#idItemModificar').val();
                var nuevo_nombre = $('#nuevoNombre').val();
                $.ajax({
                    type: "POST",
                    url: "modificar_item.php",
                    data: { modificar_item: true, id_item: id_item, nuevo_nombre: nuevo_nombre },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function() {
                        alert("Error al modificar el item.");
                    }
                });
            });
        });
    </script>
</body>
</html>
