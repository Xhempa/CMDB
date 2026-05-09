<?php
session_start();
include("conexion.php");

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios 
WHERE usuario='$usuario' AND password='$password'";

$resultado = $conexion->query($sql);

if($resultado->num_rows > 0){
    $_SESSION['usuario'] = $usuario;
    header("Location: menu.php");
}else{
    echo "<script>alert('Datos incorrectos'); window.location='index.php';</script>";
}
?>