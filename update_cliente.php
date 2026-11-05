<?php
include("conexion.php");
include("historial_helper.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];

$conexion->query("UPDATE clientes SET nombre='$nombre', telefono='$telefono' WHERE id=$id");

registrarHistorial($conexion, "Se actualizó cliente: $nombre");

header("Location: clientes.php?msg=Cliente actualizado");
?>