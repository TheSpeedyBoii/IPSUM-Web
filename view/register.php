<?php
    include_once('../model/connect.php');
    include_once('../controller/controller_register.php');

    $register = new controller_register();
    $register->returnManejos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/register.css" />
    <title>WePlot</title>
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img class="img" src="images/register.png" alt="Imagen de registro" />
        </div>
        <div class="login-info-container">
            <h1 class="title">Regístrate a <span class="title-1">WePlot</span></h1>
            <form class="input-container" action="register.php?action=register" method="post">
                <div class="input-group">
                    <label for="name">Nombre*</label>
                    <input class="input" type="text" id="name" name="name" />
                </div>
                <div class="input-group">
                    <label for="email">Email*</label>
                    <input class="input" type="email" id="email" name="email" />
                </div>
                <div class="input-group">
                    <label for="last_name">Apellido</label>
                    <input class="input" type="text" id="last_name" name="last_name" />
                </div>
                <div class="input-group">
                    <label for="phone">Teléfono*</label>
                    <input class="input" type="text" id="phone" name="phone" />
                </div>
                <div class="input-group">
                    <label for="country">País</label>
                    <input class="input" type="text" id="country" name="country" />
                </div>
                <div class="input-group">
                    <label for="food">Comida favorita</label>
                    <input class="input" type="text" id="food" name="food" />
                </div>
                <div class="input-group">
                    <label for="artist">Artista favorito</label>
                    <input class="input" type="text" id="artist" name="artist" />
                </div>
                <div class="input-group">
                    <label for="place">Lugar favorito</label>
                    <input class="input" type="text" id="place" name="place" />
                </div>
                <div class="input-group">
                    <label for="password">Contraseña*</label>
                    <input class="input" type="password" id="password" name="password" />
                </div>
                <div class="input-group">
                    <label for="confirm-password">Confirmar Contraseña*</label>
                    <input class="input" type="password" id="confirm-password" name="confirm-password" />
                </div>
                <div class="input-group full-width">
                    <input class="photo full-width" type="file" id="photo" name="photo" />
                </div>
                <div class="input-group full-width">
                    <button class="btn full-width" type="submit" id="send">Unirme a WePlot</button>
                </div>
                <div class="input-group full-width">
                    <p>¿Ya tienes cuenta? <a href="login.php"class="span">Inicia sesión aquí</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

