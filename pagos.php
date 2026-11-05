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
<title>Pagos CMDB</title>

<link rel="stylesheet" href="styles.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<div class="module-wrapper">

<!-- HEADER -->
<div class="module-header">
<a href="menu.php" class="back-btn">⬅</a>
<h2>💰 Gestión de Pagos</h2>
</div>

<!-- FORM -->
<div class="card-form">

<form action="guardar_pago.php" method="POST">

<!-- CLIENTE -->
<div class="input-group">
<label>Cliente</label>
<select name="cliente_id" required class="input">
<option value="">Seleccionar cliente</option>

<?php
$clientes = $conexion->query("SELECT * FROM clientes");
while($c = $clientes->fetch_assoc()){
echo "<option value='".$c['id']."'>".$c['nombre']."</option>";
}
?>
</select>
</div>

<!-- VALOR -->
<div class="input-group">
<label>Valor</label>
<input type="text" id="valorInput" class="input" placeholder="Ej: 500000" required>
<input type="hidden" name="valor" id="valorReal">
</div>

<!-- FECHA -->
<div class="input-group">
<label>Fecha</label>
<input type="date" name="fecha" class="input" required>
</div>

<button type="submit" class="btn-primary">Guardar Pago</button>

</form>

<!-- 🔥 BOTÓN PDF SEPARADO PERO SIN ROMPER ESTILO -->
<div style="margin-top:15px; text-align:right;">
<a href="reporte_pagos.php" target="_blank" class="btn-primary">
📄 Exportar PDF
</a>
</div>

</div>

<!-- TABLA (SE MANTIENE TU ESTILO ORIGINAL AZULITO) -->
<div class="table-container">

<h3>📋 Lista de Pagos</h3>

<table>
<tr>
<th>Cliente</th>
<th>Monto</th>
<th>Fecha</th>
</tr>

<?php
$sql = "SELECT pagos.*, clientes.nombre 
FROM pagos 
JOIN clientes ON pagos.cliente_id = clientes.id";

$res = $conexion->query($sql);

while($row = $res->fetch_assoc()){
echo "<tr>
<td>".$row['nombre']."</td>
<td>$ ".number_format($row['valor'], 0, ',', '.')."</td>
<td>".$row['fecha']."</td>
</tr>";
}
?>

</table>

</div>

</div>

<script>

// 💰 FORMATO COP
const input = document.getElementById("valorInput");
const real = document.getElementById("valorReal");

input.addEventListener("input", function () {
let numero = this.value.replace(/\D/g, "");
real.value = numero;
this.value = new Intl.NumberFormat("es-CO").format(numero);
});

// 🔥 ALERTA
const params = new URLSearchParams(window.location.search);
const msg = params.get("msg");

if(msg){
Swal.fire({
icon: "success",
title: msg,
timer: 2000,
showConfirmButton: false
});
}

</script>

</body>
</html>