<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");
include("historial_helper.php");

// VALIDAR
if(!isset($_POST['cliente_id'], $_POST['nombre'])){
    die("Datos incompletos");
}

$cliente_id = intval($_POST['cliente_id']);
$nombre = trim($_POST['nombre']);

// VALIDAR ARCHIVO
if(!isset($_FILES['archivo']) || $_FILES['archivo']['error'] != 0){
    die("Error al subir archivo");
}

// PROCESAR ARCHIVO
$archivo = $_FILES['archivo']['name'];
$tmp = $_FILES['archivo']['tmp_name'];

// evitar nombres duplicados
$archivo = time() . "_" . $archivo;

$ruta = "uploads/" . $archivo;

// crear carpeta si no existe
if(!is_dir("uploads")){
    mkdir("uploads", 0777, true);
}

// mover archivo
if(!move_uploaded_file($tmp, $ruta)){
    die("Error al guardar archivo");
}

// INSERT (IMPORTANTE: descripcion)
$sql = "
INSERT INTO planos(nombre, descripcion, cliente_id)
VALUES('$nombre','$archivo','$cliente_id')
";

if(!$conexion->query($sql)){
    die("Error SQL: " . $conexion->error);
}

// historial
registrarHistorial($conexion, "Se subió plano: $nombre");

header("Location: planos.php?msg=Plano subido");
exit();
?>