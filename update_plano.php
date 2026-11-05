<?php
include("conexion.php");
include("historial_helper.php");

$id = $_POST['id'];
$cliente_id = $_POST['cliente_id'];
$nombre = $_POST['nombre'];
$archivo_actual = $_POST['archivo_actual'];

$archivo = $archivo_actual;

// SI SUBE NUEVO ARCHIVO
if(isset($_FILES['archivo']) && $_FILES['archivo']['name'] != ""){

    $nuevo = time() . "_" . $_FILES['archivo']['name'];
    $ruta = "uploads/" . $nuevo;

    move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

    // eliminar anterior
    if(file_exists("uploads/".$archivo_actual)){
        unlink("uploads/".$archivo_actual);
    }

    $archivo = $nuevo;
}

// UPDATE (IMPORTANTE: descripcion)
$sql = "
UPDATE planos 
SET nombre='$nombre', descripcion='$archivo', cliente_id='$cliente_id'
WHERE id=$id
";

if(!$conexion->query($sql)){
    die("Error SQL: " . $conexion->error);
}

// historial
registrarHistorial($conexion, "Se editó plano: $nombre");

header("Location: planos.php?msg=Plano actualizado");
exit();
?>