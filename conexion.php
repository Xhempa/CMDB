<?php
$conexion = new mysqli("localhost","root","","cmdb");

if($conexion->connect_error){
    die("Error de conexión");
}
?>