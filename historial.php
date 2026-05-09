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
<title>Historial CMDB</title>
<link rel="stylesheet" href="styles.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<div class="module-wrapper">

    <!-- HEADER -->
    <div class="module-header">
        <a href="menu.php" class="back-btn">⬅</a>
        <h2>📊 Historial del Sistema</h2>
    </div>

    <!-- TABLA -->
    <div class="table-container">

        <table>
            <tr>
                <th>Acción</th>
                <th>Fecha</th>
            </tr>

            <?php
            $res = $conexion->query("SELECT * FROM historial ORDER BY fecha DESC");

            while($row = $res->fetch_assoc()){
                echo "<tr>
                <td>".$row['accion']."</td>
                <td>".$row['fecha']."</td>
                </tr>";
            }
            ?>

        </table>

    </div>

</div>

<script>
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