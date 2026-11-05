<?php
include("conexion.php");

$id = $_GET['id'];
$cliente = $conexion->query("SELECT * FROM clientes WHERE id=$id")->fetch_assoc();
?>

<form action="update_deuda.php" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>">

<label>Nueva deuda</label>
<input type="number" name="deuda" value="<?php echo $cliente['deuda_total']; ?>">

<button>Guardar</button>
</form>