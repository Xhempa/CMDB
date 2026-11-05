<?php
session_start();
include("conexion.php");

$usuario = $_SESSION['usuario'];
$actual = $_POST['actual'];
$nueva = $_POST['nueva'];

// Buscar usuario
$stmt = $conexion->prepare("SELECT password FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$res = $stmt->get_result();

$row = $res->fetch_assoc();

// Verificar contraseña actual
if(password_verify($actual, $row['password'])){

    $nuevoHash = password_hash($nueva, PASSWORD_DEFAULT);

    $update = $conexion->prepare("UPDATE usuarios SET password=? WHERE usuario=?");
    $update->bind_param("ss", $nuevoHash, $usuario);
    $update->execute();

    header("Location: menu.php?msg=Contraseña actualizada");

}else{
    echo "<script>alert('Contraseña actual incorrecta'); window.history.back();</script>";
}
?>