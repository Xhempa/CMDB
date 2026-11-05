<?php
include("conexion.php");

$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = "INSERT INTO usuarios(nombre, usuario, password)
VALUES('$nombre','$usuario','$password')";

if($conexion->query($sql)){
    header("Location: index.php");
}else{
    echo "Error";
}
?>