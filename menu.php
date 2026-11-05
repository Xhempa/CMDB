<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}

$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol']; // 🔥 IMPORTANTE
$inicial = strtoupper($usuario[0]);
?>

<!DOCTYPE html>
<html lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<meta charset="UTF-8">
<title>CMDB Dashboard</title>
<link rel="stylesheet" href="styles.css">

<style>

/* HEADER RIGHT */
.right{
display:flex;
align-items:center;
gap:10px;
}

/* 🔥 BOTÓN ADMIN */
.admin-btn{
padding:10px 15px;
background:linear-gradient(135deg,#00c6ff,#0072ff);
color:white;
border-radius:10px;
text-decoration:none;
font-size:14px;
transition:0.3s;
}

.admin-btn:hover{
transform:scale(1.05);
}

/* 🔥 DROPDOWN */
.dropdown{
position:absolute;
top:70px;
right:20px;
width:220px;
background:rgba(20,20,20,0.95);
border-radius:15px;
padding:15px;
display:none;
flex-direction:column;
z-index:999;
box-shadow:0 10px 25px rgba(0,0,0,0.5);
}

.dropdown.active{
display:flex;
}

.profile{
width:40px;
height:40px;
background:linear-gradient(135deg,#00c6ff,#0072ff);
color:white;
display:flex;
align-items:center;
justify-content:center;
border-radius:50%;
cursor:pointer;
font-weight:bold;
transition:0.3s;
}

.profile:hover{
transform:scale(1.1);
}

.logout-btn{
margin-top:10px;
padding:10px;
background:#ff4d4d;
color:white;
text-align:center;
border-radius:10px;
text-decoration:none;
}

</style>

</head>
<body>

<header class="header">

    <div class="left">
        <img src="logo.png" class="logo-big">
        <h2>CMDB</h2>
    </div>

    <div class="right">

        <!-- 👑 BOTÓN SOLO ADMIN -->
        <?php if($rol == "admin"){ ?>
            <a href="crear_usuario.php" class="admin-btn">➕ Crear Usuario</a>
        <?php } ?>

        <!-- 🌙 TEMA -->
        <div class="theme-toggle" onclick="toggleTheme()">🌙</div>

        <!-- 👤 PERFIL -->
        <div class="profile" id="profileBtn">
            <?php echo $inicial; ?>
        </div>

        <!-- 🔽 DROPDOWN -->
        <div class="dropdown" id="dropdown">
            <h4><?php echo $usuario; ?></h4>
            <p><?php echo ucfirst($rol); ?></p>
            <hr>
            <a href="logout.php" class="logout-btn">Cerrar sesión</a>
            <a href="cambiar_password.php" class="logout-btn">Cambiar contraseña</a>
        </div>

    </div>

</header>

<!-- DASHBOARD -->
<div class="dashboard">

    <div class="card" onclick="location.href='citas.php'"> Citas</div>
    <div class="card" onclick="location.href='planos.php'"> Planos</div>
    <div class="card" onclick="location.href='pagos.php'"> Pagos</div>
    <div class="card" onclick="location.href='deudas.php'"> Deudas</div>
    <div class="card" onclick="location.href='historial.php'"> Historial</div>
    <div class="card" onclick="location.href='clientes.php'"> Clientes</div>

</div>

<script>

// ELEMENTOS
const profileBtn = document.getElementById("profileBtn");
const dropdown = document.getElementById("dropdown");

// TOGGLE
profileBtn.addEventListener("click", function(e){
    e.stopPropagation();
    dropdown.classList.toggle("active");
});

// CLICK FUERA
document.addEventListener("click", function(){
    dropdown.classList.remove("active");
});

// EVITAR CIERRE
dropdown.addEventListener("click", function(e){
    e.stopPropagation();
});

// TEMA
function toggleTheme(){
    document.body.classList.toggle("light-mode");
}

</script>

</body>
</html>