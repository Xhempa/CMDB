<?php
include("conexion.php");

$nombre = $_POST['nombre'];

$archivo = $_FILES['archivo']['name'];
$ruta = "uploads/".$archivo;

move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

$sql = "INSERT INTO planos(nombre, tipo, descripcion)
VALUES('$nombre','archivo','$archivo')";

$conexion->query($sql);

header("Location: planos.php?msg=Plano subido");
?>