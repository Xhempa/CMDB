<?php
include("conexion.php");

$cliente_id = $_POST['cliente_id'];
$fecha = $_POST['fecha'];
$descripcion = $_POST['descripcion'];

$sql = "INSERT INTO citas(cliente_id, fecha, descripcion)
VALUES('$cliente_id','$fecha','$descripcion')";

$conexion->query($sql);

header("Location: citas.php?msg=Cita guardada");
?>