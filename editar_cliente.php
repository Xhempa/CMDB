<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}

$id = $_GET['id'];
$res = $conexion->query("SELECT * FROM clientes WHERE id=$id");
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Cliente</title>
<link rel="stylesheet" href="styles.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="module-wrapper">

    <!-- HEADER -->
    <div class="module-header">
        <a href="clientes.php" class="back-btn">⬅</a>
        <h2>✏ Editar Cliente</h2>
    </div>

    <!-- FORM -->
    <div class="card-form">

        <form action="update_cliente.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div class="input-group">
                <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required>
                <label>Nombre</label>
            </div>

            <div class="input-group">
                <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>" required>
                <label>Teléfono</label>
            </div>

            <div class="input-group">
                <input type="email" name="correo" value="<?php echo $row['correo']; ?>" required>
                <label>Correo</label>
            </div>

            <div class="input-group">
                <input type="number" name="deuda_total" value="<?php echo $row['deuda_total']; ?>" required>
                <label>Deuda Total</label>
            </div>

            <button type="submit" class="btn-primary">Actualizar Cliente</button>

        </form>

    </div>

</div>

<script>
// MENSAJE BONITO SI VIENE DESDE URL
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