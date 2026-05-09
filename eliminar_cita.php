<?php
include("conexion.php");
include("historial_helper.php");

$id = $_GET['id'];

$conexion->query("DELETE FROM citas WHERE id=$id");

registrarHistorial($conexion, "Se eliminó cita ID: $id");

header("Location: citas.php?msg=Cita eliminada correctamente");
?>