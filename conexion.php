<?php

$host = "sql100.infinityfree.com";
$user = "if0_41730162";
$pass = "Unr5GwMSgJ";
$db   = "if0_41730162_cmdb"; // ⚠️ reemplaza XXX por el nombre REAL

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Opcional (recomendado para tildes y ñ)
$conexion->set_charset("utf8");

?>