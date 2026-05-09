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
<title>Planos CMDB</title>
<link rel="stylesheet" href="styles.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="module-wrapper">

<div class="module-header">
<a href="menu.php" class="back-btn">⬅</a>
<h2>📐 Gestión de Planos</h2>
</div>

<!-- 🔥 FORM CORREGIDO -->
<form action="guardar_plano.php" method="POST" enctype="multipart/form-data" class="form-modern">

<h3>Subir Plano</h3>

<div class="input-group">
<label>Nombre del plano</label>
<input type="text" name="nombre" required>
</div>

<div class="input-group">
<label>Archivo</label>

<input type="file" name="archivo" id="fileInput" required class="file-real">

<div class="file-box" onclick="document.getElementById('fileInput').click()">
    <span id="fileName">Seleccionar archivo</span>
</div>

</div>

<button type="submit" class="btn-primary">Subir Plano</button>

</form>

<div class="table-container">

<h3>📋 Lista de Planos</h3>

<table>
<tr>
<th>Nombre</th>
<th>Archivo</th>
<th>Acciones</th>
</tr>

<?php
$res = $conexion->query("SELECT * FROM planos");

while($row = $res->fetch_assoc()){
echo "<tr>
<td>".$row['nombre']."</td>
<td><a href='uploads/".$row['descripcion']."' target='_blank'>Ver</a></td>
<td>
<a href='editar_plano.php?id=".$row['id']."' class='btn-edit'>✏</a>
<button onclick='confirmarEliminarPlano(".$row['id'].")' class='btn-delete'>🗑</button>
</td>
</tr>";
}
?>
</table>

</div>

</div>

<script>
// mostrar nombre archivo
const fileInput = document.getElementById("fileInput");
const fileName = document.getElementById("fileName");

if(fileInput){
fileInput.addEventListener("change", function(){
fileName.textContent = this.files[0]?.name || "Seleccionar archivo";
});
}

// eliminar
function confirmarEliminarPlano(id){
Swal.fire({
title: "¿Eliminar plano?",
text: "También se eliminará el archivo",
icon: "warning",
showCancelButton: true,
confirmButtonColor: "#ff4d4d",
cancelButtonColor: "#aaa",
confirmButtonText: "Sí, eliminar"
}).then((result) => {
if (result.isConfirmed) {
window.location = "eliminar_plano.php?id=" + id;
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