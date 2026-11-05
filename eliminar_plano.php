<?php
include("conexion.php");
include("historial_helper.php");

$id = $_GET['id'];

// Obtener archivo
$res = $conexion->query("SELECT * FROM planos WHERE id=$id");
$row = $res->fetch_assoc();

$ruta = "uploads/".$row['descripcion'];

if(file_exists($ruta)){
unlink($ruta);
}

$conexion->query("DELETE FROM planos WHERE id=$id");

registrarHistorial($conexion, "Se eliminó plano: ".$row['nombre']);

header("Location: planos.php?msg=Plano eliminado correctamente");
?>