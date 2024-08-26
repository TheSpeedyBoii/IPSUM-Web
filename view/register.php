<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/register.css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>WePlot</title>
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img class="img" src="images/register.png" alt="Imagen de registro" />
        </div>
        <div class="login-info-container">
        <img class="title-image" src="images/weplot.jpeg" alt="Regístrate a WePlot" />
            <form class="input-container" action="../controller/controller_register.php" enctype="multipart/form-data"
                method="post">
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
                    <select class="input" id="country" name="country">
                        <option value="Argentina">Argentina</option>
                        <option value="Colombia">Colombia</option>
                        <option value="México">México</option>
                        <option value="Japón">Japón</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="food">Comida favorita</label>
                    <input class="input" type="text" id="question-1" name="question-1" />
                </div>
                <div class="input-group">
                    <label for="artist">Artista favorito</label>
                    <input class="input" type="text" id="question-2" name="question-2" />
                </div>
                <div class="input-group">
                    <label for="place">Lugar favorito</label>
                    <input class="input" type="text" id="question-3" name="question-3" />
                </div>
                <div class="input-group">
                    <label for="place">Color favorito</label>
                    <input class="input" type="text" id="question-4" name="question-4" />
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
                    <input class="photo full-width" type="file" id="photo" name="photo" required />
                </div>
                <div class="g-recaptcha" data-sitekey="6Le9Iy8qAAAAANMj284IeJEhcTObT4WNwhTTa1h2"></div>
                <div class="input-group full-width">
                    <button class="btn full-width" type="submit" id="send">Unirme a WePlot</button>
                </div>
                <div class="input-group full-width">
                    <p>¿Ya tienes cuenta? <a href="login.php" class="span">Inicia sesión aquí</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>