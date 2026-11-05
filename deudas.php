<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Deudas CMDB</title>

<link rel="stylesheet" href="styles.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

/* COLORES ESTADO */
.estado-ok{
color:#00ff88;
font-weight:bold;
}

.estado-deuda{
color:#ff4d4d;
font-weight:bold;
}

.estado-parcial{
color:#ffc107;
font-weight:bold;
}

</style>

</head>
<body>

<div class="module-wrapper">

<div class="module-header">
<a href="menu.php" class="back-btn">⬅</a>
<h2>💰 Control de Deudas</h2>
</div>

<div class="table-container">

<h3>📊 Estado de Cuenta de Clientes</h3>

<table>
<tr>
<th>Cliente</th>
<th>Deuda Total</th>
<th>Pagado</th>
<th>Pendiente</th>
<th>Estado</th>
</tr>

<?php

$sql = "
SELECT 
c.id,
c.nombre,
c.deuda_total,
IFNULL(SUM(p.valor),0) AS pagado,
(c.deuda_total - IFNULL(SUM(p.valor),0)) AS pendiente
FROM clientes c
LEFT JOIN pagos p ON c.id = p.cliente_id
GROUP BY c.id
";

$res = $conexion->query($sql);

while($row = $res->fetch_assoc()){

$deuda = $row['deuda_total'];
$pagado = $row['pagado'];
$pendiente = $row['pendiente'];

// ESTADO
if($pendiente <= 0){
    $estado = "<span class='estado-ok'>Pagado</span>";
}elseif($pagado > 0){
    $estado = "<span class='estado-parcial'>Parcial</span>";
}else{
    $estado = "<span class='estado-deuda'>Debe</span>";
}

echo "<tr>
<td>".$row['nombre']."</td>
<td>$ ".number_format($deuda,0,',','.')."</td>
<td>$ ".number_format($pagado,0,',','.')."</td>
<td>$ ".number_format($pendiente,0,',','.')."</td>
<td>".$estado."</td>
</tr>";

}
?>

</table>

</div>

</div>

</body>
</html>