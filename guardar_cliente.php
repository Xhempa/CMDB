<?php
include("conexion.php");
include("historial_helper.php");

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];

$conexion->query("INSERT INTO clientes(nombre, telefono) VALUES('$nombre','$telefono')");

registrarHistorial($conexion, "Se agregó cliente: $nombre");

header("Location: clientes.php?msg=Cliente guardado");
?>