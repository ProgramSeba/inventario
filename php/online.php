<?php 

$SV = "localhost";
$Us = "root";
$Clave = "";
$BDD = "inventario";

$online = new mysqli($SV, $Us, $Clave, $BDD);

// Verificar la conexión
if ($online->connect_error) {
    die("Conexión fallida: " . $online->connect_error);
}


?>