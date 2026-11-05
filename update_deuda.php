<?php
include("conexion.php");

$id = $_POST['id'];
$deuda = $_POST['deuda'];

$conexion->query("UPDATE clientes SET deuda_total=$deuda WHERE id=$id");

header("Location: clientes.php?msg=Deuda actualizada");
?>