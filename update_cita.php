<?php
include("conexion.php");

$id = $_POST['id'];
$fecha = $_POST['fecha'];
$descripcion = $_POST['descripcion'];

$sql = "UPDATE citas SET 
fecha='$fecha',
descripcion='$descripcion'
WHERE id=$id";

$conexion->query($sql);

header("Location: citas.php?msg=Cita actualizada");
?>