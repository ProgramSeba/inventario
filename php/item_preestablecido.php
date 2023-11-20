<?php

include("online.php"); // Asegúrate de incluir el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se ha enviado un formulario

    if (isset($_POST["nuevo_item"])) {
        // Obtiene el valor seleccionado del formulario
        $nuevo_item = $_POST["nuevo_item"];

        // Array de items preestablecidos con nombres, descripciones y fotos
        $items_preestablecidos = array(
            "maincra" => array("Descripción del Item 1", "../img/espada.png"),
            "Hacha" => array("Descripción del Item 2", "../img/hacha.png"),
            "Pico" => array("Descripción del Item 3", "../img/pico.png")
        );

        // Verifica si el item seleccionado está en la lista de items preestablecidos
        if (array_key_exists($nuevo_item, $items_preestablecidos)) {
            // Obtiene la información del item
            $descripcion_item = $items_preestablecidos[$nuevo_item][0];
            $foto_item = $items_preestablecidos[$nuevo_item][1];

            // Inserta el item preestablecido en la base de datos
            $sql = "INSERT INTO item (nombre_item, desc_item, foto_item) VALUES ('$nuevo_item', '$descripcion_item', '$foto_item')";
            $query = mysqli_query($online, $sql);

            if ($query) {
                // Éxito al agregar el item
                echo "Item preestablecido agregado con éxito.";
            } else {
                // Error al agregar el item
                echo "Error al agregar el item preestablecido.";
            }
        } else {
            // El item seleccionado no está en la lista preestablecida
            echo "El item seleccionado no es válido.";
        }
    }
}

?>
