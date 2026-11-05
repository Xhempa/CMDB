<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}

$id = $_GET['id'];
$sql = "SELECT * FROM citas WHERE id=$id";
$res = $conexion->query($sql);
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Cita</title>
<link rel="stylesheet" href="styles.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="module-wrapper">

    <!-- HEADER -->
    <div class="module-header">
        <a href="citas.php" class="back-btn">⬅</a>
        <h2>📅 Editar Cita</h2>
    </div>

    <!-- FORM -->
    <div class="card-form">

        <form action="update_cita.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div class="input-group">
                <input type="datetime-local" name="fecha" 
                value="<?php echo date('Y-m-d\TH:i', strtotime($row['fecha'])); ?>" required>
                <label>Fecha y Hora</label>
            </div>

            <div class="input-group">
                <textarea name="descripcion" required><?php echo $row['descripcion']; ?></textarea>
                <label>Descripción</label>
            </div>

            <button type="submit" class="btn-primary">Actualizar Cita</button>

        </form>

    </div>

</div>

<script>
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

</body>
</html>