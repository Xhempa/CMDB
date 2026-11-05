<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}

if(!isset($_GET['id'])){
    header("Location: clientes.php");
}

$id = $_GET['id'];

// 🔥 CLIENTE
$cliente = $conexion->query("SELECT * FROM clientes WHERE id=$id")->fetch_assoc();

// 🔥 PAGOS
$pagos = $conexion->query("SELECT * FROM pagos WHERE cliente_id=$id");

// 🔥 CITAS
$citas = $conexion->query("SELECT * FROM citas WHERE cliente_id=$id");

// 🔥 PLANOS
$planos = $conexion->query("SELECT * FROM planos WHERE cliente_id=$id");

// 🔥 CALCULO
$totalPagado = 0;
$resPagos = $conexion->query("SELECT SUM(valor) as total FROM pagos WHERE cliente_id=$id");
if($row = $resPagos->fetch_assoc()){
    $totalPagado = $row['total'] ?? 0;
}

$pendiente = $cliente['deuda_total'] - $totalPagado;
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Perfil Cliente</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="module-wrapper">

<!-- HEADER -->
<div class="module-header">
<a href="clientes.php" class="back-btn">⬅</a>
<h2>👤 Perfil del Cliente</h2>
</div>

<!-- INFO CLIENTE -->
<div class="card-form">

<h3><?php echo $cliente['nombre']; ?></h3>

<p>📞 <?php echo $cliente['telefono']; ?></p>
<p>📧 <?php echo $cliente['correo']; ?></p>

<hr>

<p>💰 Deuda Total: $<?php echo number_format($cliente['deuda_total'],0,',','.'); ?></p>
<p>💳 Pagado: $<?php echo number_format($totalPagado,0,',','.'); ?></p>
<p>📉 Pendiente: $<?php echo number_format($pendiente,0,',','.'); ?></p>

<br>

<a href="editar_deuda.php?id=<?php echo $id; ?>" class="btn-primary">
✏ Editar Deuda
</a>

</div>

<!-- PAGOS -->
<div class="table-container">
<h3>💳 Pagos</h3>

<table>
<tr>
<th>Monto</th>
<th>Fecha</th>
</tr>

<?php while($p = $pagos->fetch_assoc()){ ?>
<tr>
<td>$<?php echo number_format($p['valor'],0,',','.'); ?></td>
<td><?php echo $p['fecha']; ?></td>
</tr>
<?php } ?>

</table>
</div>

<!-- CITAS -->
<div class="table-container">
<h3>📅 Citas</h3>

<table>
<tr>
<th>Fecha</th>
<th>Descripción</th>
</tr>

<?php while($c = $citas->fetch_assoc()){ ?>
<tr>
<td><?php echo $c['fecha']; ?></td>
<td><?php echo $c['descripcion']; ?></td>
</tr>
<?php } ?>

</table>
</div>

<!-- PLANOS -->
<div class="table-container">
<h3>📐 Planos</h3>

<table>
<tr>
<th>Nombre</th>
<th>Archivo</th>
</tr>

<?php while($pl = $planos->fetch_assoc()){ ?>
<tr>
<td><?php echo $pl['nombre']; ?></td>
<td>
<a href="uploads/<?php echo $pl['descripcion']; ?>" target="_blank">
Ver
</a>
</td>
</tr>
<?php } ?>

</table>
</div>

</div>

</body>
</html>