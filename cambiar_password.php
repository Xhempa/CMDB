<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Cambiar Contraseña</title>
<link rel="stylesheet" href="styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="module-wrapper">

    <div class="module-header">
        <a href="menu.php" class="back-btn">⬅</a>
        <h2>🔐 Cambiar Contraseña</h2>
    </div>

    <div class="form-modern">

        <form action="update_password.php" method="POST">

            <div class="input-group">
                <label>Contraseña actual</label>
                <input type="password" name="actual" required>
            </div>

            <div class="input-group">
                <label>Nueva contraseña</label>
                <input type="password" name="nueva" required>
            </div>

            <button class="btn-primary">Actualizar</button>

        </form>

    </div>

</div>

</body>
</html>