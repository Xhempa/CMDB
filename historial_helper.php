<?php
function registrarHistorial($conexion, $accion){
    $sql = "INSERT INTO historial(accion) VALUES('$accion')";
    $conexion->query($sql);
}
?>