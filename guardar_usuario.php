<?php
session_start();
include("conexion.php");

if($_SESSION['rol'] != "admin"){
    header("Location: menu.php");
    exit();
}

$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$rol = $_POST['rol'];

$sql = "INSERT INTO usuarios(nombre, usuario, password, rol) 
VALUES('$nombre','$usuario','$password','$rol')";

if($conexion->query($sql)){
    header("Location: menu.php?msg=Usuario creado");
}else{
    echo "Error: " . $conexion->error;
}
?>