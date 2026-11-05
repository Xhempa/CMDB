<?php
include("conexion.php");

$cliente = $_POST['cliente_id'] ?? '';
$valor = $_POST['valor'] ?? '';
$fecha = $_POST['fecha'] ?? '';

if($cliente == '' || $valor == '' || $fecha == ''){
    header("Location: pagos.php?msg=Error en datos");
    exit();
}

$query = "INSERT INTO pagos(cliente_id, valor, fecha) 
VALUES('$cliente','$valor','$fecha')";

if($conexion->query($query)){
    header("Location: pagos.php?msg=Pago registrado");
}else{
    echo "Error: " . $conexion->error;
}
?>