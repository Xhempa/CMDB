<?php
include("conexion.php");
include("historial_helper.php");

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$deuda = $_POST['deuda_total'];

$conexion->query("INSERT INTO clientes(nombre, telefono, correo, deuda_total) 
VALUES('$nombre','$telefono','$correo','$deuda')");

registrarHistorial($conexion, "Se agregó cliente: $nombre con deuda $deuda");

header("Location: clientes.php?msg=Cliente guardado");
?>