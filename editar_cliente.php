<?php
include("conexion.php");

$id = $_GET['id'];
$res = $conexion->query("SELECT * FROM clientes WHERE id=$id");
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Editar Cliente</h2>

<form action="update_cliente.php" method="POST">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required>
<input type="text" name="telefono" value="<?php echo $row['telefono']; ?>" required>

<button class="btn-primary">Actualizar</button>
</form>

</body>
</html>