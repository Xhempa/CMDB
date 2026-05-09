<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['usuario'])){
header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<meta charset="UTF-8">
<title>Citas CMDB</title>
<link rel="stylesheet" href="styles.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="module-wrapper">

<div class="module-header">
<a href="menu.php" class="back-btn">⬅</a>
<h2>📅 Gestión de Citas</h2>
</div>

<!-- 🔥 FORM CORREGIDO -->
<form action="guardar_cita.php" method="POST" class="form-modern">

<h3>Registrar Cita</h3>

<div class="input-group">
<label>Cliente</label>
<select name="cliente_id" required>
<option value="">Seleccionar cliente</option>

<?php
$clientes = $conexion->query("SELECT * FROM clientes");
while($c = $clientes->fetch_assoc()){
echo "<option value='".$c['id']."'>".$c['nombre']."</option>";
}
?>
</select>
</div>

<div class="input-group">
<label>Fecha</label>
<input type="datetime-local" name="fecha" required>
</div>

<div class="input-group">
<label>Descripción</label>
<textarea name="descripcion" required></textarea>
</div>

<button type="submit" class="btn-primary">Guardar Cita</button>

</form>

<div class="table-container">

<table>
<tr>
<th>Cliente</th>
<th>Fecha</th>
<th>Descripción</th>
<th>Acciones</th>
</tr>

<?php
$sql = "SELECT citas.*, clientes.nombre 
FROM citas 
JOIN clientes ON citas.cliente_id = clientes.id";

$res = $conexion->query($sql);

while($row = $res->fetch_assoc()){
echo "<tr>
<td>".$row['nombre']."</td>
<td>".$row['fecha']."</td>
<td>".$row['descripcion']."</td>
<td>
<a href='editar_cita.php?id=".$row['id']."' class='btn-edit'>✏</a>
<button onclick='confirmarEliminarCita(".$row['id'].")' class='btn-delete'>🗑</button>
</td>
</tr>";
}
?>
</table>

</div>

</div>

<script>
function confirmarEliminarCita(id){
Swal.fire({
title: "¿Eliminar cita?",
text: "Esta acción no se puede deshacer",
icon: "warning",
showCancelButton: true,
confirmButtonColor: "#ff4d4d",
cancelButtonColor: "#aaa",
confirmButtonText: "Sí, eliminar"
}).then((result) => {
if (result.isConfirmed) {
window.location = "eliminar_cita.php?id=" + id;
}
});
}

// mensaje
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