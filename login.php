<?php
session_start();
include("conexion.php");

$usuario = $_POST['usuario'];
$password = $_POST['password'];

// 🔥 PREPARADO (ANTI SQL INJECTION)
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();

$resultado = $stmt->get_result();

if($resultado->num_rows > 0){

    $row = $resultado->fetch_assoc();

    // 🔐 VERIFICAR PASSWORD ENCRIPTADA
    if(password_verify($password, $row['password'])){

        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['rol'] = $row['rol']; // 🔥 GUARDAMOS EL ROL

        header("Location: menu.php");
        exit();

    }else{
        echo "<script>alert('Contraseña incorrecta'); window.location='index.php';</script>";
    }

}else{
    echo "<script>alert('Usuario no encontrado'); window.location='index.php';</script>";
}
?>