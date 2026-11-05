<?php
session_start();

if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != "admin"){
    header("Location: menu.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Usuario - CMDB</title>
<link rel="stylesheet" href="styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="module-wrapper">

    <div class="module-header">
        <a href="menu.php" class="back-btn">⬅</a>
        <h2>👑 Crear Usuario</h2>
    </div>

    <div class="form-modern">

        <h3>Nuevo Usuario</h3>

        <form action="guardar_usuario.php" method="POST">

            <div class="input-group">
                <label>Nombre completo</label>
                <input type="text" name="nombre" required>
            </div>

            <div class="input-group">
                <label>Usuario</label>
                <input type="text" name="usuario" required>
            </div>

            <div class="input-group">
                <label>Contraseña</label>
                <input type="password" name="password" required>
            </div>

            <div class="input-group">
                <label>Rol</label>
                <select name="rol" required>
                    <option value="user">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>

            <button class="btn-primary">Crear Usuario</button>

        </form>

    </div>

</div>

</body>
</html>