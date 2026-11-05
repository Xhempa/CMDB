<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['usuario'])){
header("Location: index.php");
}

// 🔥 FILTRO
$filtro = $_GET['filtro'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<meta charset="UTF-8">
<title>Clientes CMDB</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="module-wrapper">

    <div class="module-header">
        <a href="menu.php" class="back-btn">⬅</a>
        <h2>👥 Gestión de Clientes</h2>
    </div>

    <!-- FORM -->
    <div class="card-form">

        <form action="guardar_cliente.php" method="POST">

            <div class="input-group">
                <input type="text" name="nombre" required>
                <label>Nombre</label>
            </div>

            <div class="input-group">
                <input type="text" name="telefono" required>
                <label>Teléfono</label>
            </div>

            <div class="input-group">
                <input type="email" name="correo" required>
                <label>Correo</label>
            </div>

            <div class="input-group">
                <input type="number" name="deuda_total" required>
                <label>Deuda Total</label>
            </div>

            <button class="btn-primary">Guardar Cliente</button>

        </form>

    </div>

    <!-- 🔥 FILTRO -->
    <form method="GET" style="margin-bottom:15px;">
        <select name="filtro" onchange="this.form.submit()" class="input">
            <option value="">Todos</option>
            <option value="deben" <?php if($filtro=="deben") echo "selected"; ?>>Con deuda</option>
            <option value="pagados" <?php if($filtro=="pagados") echo "selected"; ?>>Pagados</option>
        </select>
    </form>

    <!-- TABLA -->
    <div class="table-container">

        <h3>📋 Lista de Clientes</h3>

<table>
<tr>
<th>Nombre</th>
<th>Teléfono</th>
<th>Deuda</th>
<th>Pagado</th>
<th>Pendiente</th>
<th>Estado</th>
<th>Acciones</th>
</tr>

<?php

$sql = "
SELECT 
c.*,
IFNULL(SUM(p.valor),0) AS pagado,
(c.deuda_total - IFNULL(SUM(p.valor),0)) AS pendiente
FROM clientes c
LEFT JOIN pagos p ON c.id = p.cliente_id
GROUP BY c.id
";

// 🔥 APLICAR FILTRO
if($filtro == "deben"){
    $sql .= " HAVING pendiente > 0";
}
if($filtro == "pagados"){
    $sql .= " HAVING pendiente <= 0";
}

$res = $conexion->query($sql);

while($row = $res->fetch_assoc()){

$deuda = $row['deuda_total'];
$pagado = $row['pagado'];
$pendiente = $row['pendiente'];

// ESTADO
if($pendiente <= 0){
    $estado = "<span style='color:#00ff88;font-weight:bold;'>Pagado</span>";
}elseif($pagado > 0){
    $estado = "<span style='color:#ffc107;font-weight:bold;'>Parcial</span>";
}else{
    $estado = "<span style='color:#ff4d4d;font-weight:bold;'>Debe</span>";
}

echo "<tr>
<td>".$row['nombre']."</td>
<td>".$row['telefono']."</td>
<td>$ ".number_format($deuda,0,',','.')."</td>
<td>$ ".number_format($pagado,0,',','.')."</td>
<td>$ ".number_format($pendiente,0,',','.')."</td>
<td>".$estado."</td>
<td>
<a href='cliente_detalle.php?id=".$row['id']."' class='btn-view'>👁</a>
<a href='editar_cliente.php?id=".$row['id']."' class='btn-edit'>✏</a>
<button onclick='confirmarEliminar(".$row['id'].")' class='btn-delete'>🗑</button>
</td>
</tr>";
}
?>
</table>

    </div>

</div>

</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmarEliminar(id){
Swal.fire({
title: "¿Eliminar cliente?",
text: "Esta acción no se puede deshacer",
icon: "warning",
showCancelButton: true,
confirmButtonColor: "#ff4d4d",
cancelButtonColor: "#aaa",
confirmButtonText: "Sí, eliminar"
}).then((result) => {
if (result.isConfirmed) {
window.location = "eliminar_cliente.php?id=" + id;
}
});
}

// MENSAJE
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