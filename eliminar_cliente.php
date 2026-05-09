<?php
include("conexion.php");
include("historial_helper.php");

$id = $_GET['id'];

$conexion->query("DELETE FROM clientes WHERE id=$id");

registrarHistorial($conexion, "Se eliminó cliente ID: $id");

header("Location: clientes.php?msg=Cliente eliminado correctamente");
?>