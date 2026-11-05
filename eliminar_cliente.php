<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");
include("historial_helper.php");

// VALIDAR ID
if(!isset($_GET['id'])){
    die("ID no recibido");
}

$id = intval($_GET['id']);

// 🔥 OPCIONAL: VERIFICAR SI EXISTE
$res = $conexion->query("SELECT nombre FROM clientes WHERE id=$id");

if($res->num_rows == 0){
    die("Cliente no existe");
}

$row = $res->fetch_assoc();
$nombre = $row['nombre'];

// 🔥 ELIMINAR RELACIONES PRIMERO (IMPORTANTE)
$conexion->query("DELETE FROM pagos WHERE cliente_id=$id");
$conexion->query("DELETE FROM citas WHERE cliente_id=$id");
$conexion->query("DELETE FROM planos WHERE cliente_id=$id");

// 🔥 ELIMINAR CLIENTE
if(!$conexion->query("DELETE FROM clientes WHERE id=$id")){
    die("Error al eliminar: " . $conexion->error);
}

// 🔥 HISTORIAL
registrarHistorial($conexion, "Se eliminó cliente: $nombre");

// REDIRECCIÓN
header("Location: clientes.php?msg=Cliente eliminado correctamente");
exit();
?>