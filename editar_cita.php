<?php
include("conexion.php");

$id = $_GET['id'];
$sql = "SELECT * FROM citas WHERE id=$id";
$res = $conexion->query($sql);
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="module-wrapper">

<h2>Editar Cita</h2>

<form action="update_cita.php" method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<input type="date" name="fecha" value="<?php echo $row['fecha']; ?>">
<input type="text" name="descripcion" value="<?php echo $row['descripcion']; ?>">

<button class="btn-primary">Actualizar</button>

</form>

</div>

</body>
</html>