<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}

$id = $_GET['id'];
$res = $conexion->query("SELECT * FROM planos WHERE id=$id");
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Plano</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="module-wrapper">

<div class="module-header">
<a href="planos.php" class="back-btn">⬅</a>
<h2>📐 Editar Plano</h2>
</div>

<div class="card-form">

<form action="update_plano.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<input type="hidden" name="archivo_actual" value="<?php echo $row['descripcion']; ?>">

<!-- CLIENTE -->
<div class="input-group">
<label>Cliente</label>
<select name="cliente_id" required>

<?php
$clientes = $conexion->query("SELECT * FROM clientes");
while($c = $clientes->fetch_assoc()){
$selected = ($c['id'] == $row['cliente_id']) ? "selected" : "";
echo "<option value='".$c['id']."' $selected>".$c['nombre']."</option>";
}
?>

</select>
</div>

<!-- NOMBRE -->
<div class="input-group">
<input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required>
<label>Nombre del plano</label>
</div>

<!-- ARCHIVO -->
<div class="input-group">
<label>Archivo actual:</label>
<p><?php echo $row['descripcion']; ?></p>

<input type="file" name="archivo" id="fileInput" class="file-real">

<div class="file-box" onclick="document.getElementById('fileInput').click()">
<span id="fileName">Seleccionar nuevo archivo (opcional)</span>
</div>

</div>

<button type="submit" class="btn-primary">Actualizar Plano</button>

</form>

</div>

</div>

<script>
const fileInput = document.getElementById("fileInput");
const fileName = document.getElementById("fileName");

if(fileInput){
fileInput.addEventListener("change", function(){
fileName.textContent = this.files[0]?.name || "Seleccionar archivo";
});
}
</script>

</body>
</html>