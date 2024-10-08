<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css" />
    <title>WePlot</title>
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img class="img" src="images/login.png" alt="Imagen de registro" />
        </div>
        <div class="login-info-container">
            <h1 class="title">Inicia sesión en <span class="title-1">WePlot</span></h1>
            <form class="input-container" action="../controller/controller_login.php" method="POST">

                <div class="input-group full-width">
                    <label for="email">Email*</label>
                    <input class="input" type="email" id="email" name="email" required />
                </div>
                <div class="input-group full-width">
                    <label for="password">Contraseña*</label>
                    <input class="input" type="password" id="password" name="password" required />
                </div>
                <div class="input-group full-width">
                    <button class="btn full-width" type="submit" id="send">Iniciar sesión</button>
                </div>
                <div class="input-group full-width">
                    <p>¿No tienes cuenta? <a href="register.php" class="span">Regístrate aquí</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>