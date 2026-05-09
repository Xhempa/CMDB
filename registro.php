<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro CMDB</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="theme-toggle" onclick="toggleTheme()">🌙</div>

<div class="login-container">

    <div class="login-card">

        <img src="logo.png" class="login-logo">

        <h2>Registro</h2>
        <p>Crea tu cuenta en CMDB</p>

        <form action="guardar.php" method="POST">

            <div class="input-group">
                <input type="text" name="nombre" required>
                <label>Nombre completo</label>
            </div>

            <div class="input-group">
                <input type="text" name="usuario" required>
                <label>Usuario</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" required>
                <label>Contraseña</label>
            </div>

            <button class="btn-login">Registrarse</button>

        </form>

        <a href="index.php" class="link">Ya tengo cuenta</a>

    </div>

</div>

<script src="script.js"></script>
</body>
</html>