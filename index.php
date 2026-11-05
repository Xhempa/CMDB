<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CMDB Login</title>
<link rel="stylesheet" href="styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="theme-toggle" onclick="toggleTheme()">🌙</div>

<div class="login-container">

    <div class="login-card">

        <img src="logo.png" class="login-logo">

        <h2>CMDB</h2>
        <p>Clocimodel Data Basement</p>

        <form action="login.php" method="POST">

            <div class="input-group">
                <input type="text" name="usuario" required>
                <label>Usuario</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" required>
                <label>Contraseña</label>
            </div>

            <button class="btn-login">Ingresar</button>

        </form>


    </div>

</div>

<script src="script.js"></script>
</body>
</html>