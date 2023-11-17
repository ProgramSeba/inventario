<?php

include("online.php");
session_start();

if (isset($_POST['nuevo_item'])) {
    $nuevo_item = $_POST['nuevo_item'];

    // Aquí puedes agregar lógica para validar y procesar la adición del nuevo item a la base de datos

    // Después de realizar la operación, redirige a la página principal o a donde desees
    header('Location: tu_pagina_principal.php');
    exit();
}
?>
