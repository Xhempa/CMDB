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
<title>Clientes CMDB</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="module-wrapper">

    <div class="module-header">
        <a href="menu.php" class="back-btn">⬅</a>
        <h2>👥 Gestión de Clientes</h2>
    </div>

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

            <button class="btn-primary">Guardar Cliente</button>

        </form>

    </div>

    <div class="table-container">

        <h3>📋 Lista de Clientes</h3>

<table>
<tr>
<th>Nombre</th>
<th>Teléfono</th>
<th>Acciones</th>
</tr>

<?php
$res = $conexion->query("SELECT * FROM clientes");

while($row = $res->fetch_assoc()){
echo "<tr>
<td>".$row['nombre']."</td>
<td>".$row['telefono']."</td>
<td>
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