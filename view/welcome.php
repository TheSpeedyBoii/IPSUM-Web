<?php
session_start();
$email = $_SESSION["Email"];
if (!isset($_SESSION["Email"])) {
    echo '<script>window.location.href="../view/login.php";</script>';
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>WePlot</title>
    <link rel="stylesheet" href="styles/welcome.css" />
</head>

<body>
    <?php require_once('header.php') ?>
    <div class="profile-card">
        <div class="profile-image">
            <img src="../profile_photos/imagen.jpg" alt="Profile Image">
        </div>

        <div class="profile-info">
            <div class="left-column">
                <p><strong>Nombre:</strong> Jose</p>
                <p><strong>Apellido:</strong> Agudelo</p>
                <p><strong>Email:</strong> <?php echo $email ?></p> 
                <p><strong>Teléfono:</strong> Agudelo</p>
            </div>

            <div class="right-column">
                <p><strong>Pregunta 1:</strong> Mondongo</p>
                <p><strong>Pregunta 2:</strong> Mondongo</p>
                <p><strong>Pregunta 3:</strong> Mondongo</p>
                <p><strong>Pregunta 4:</strong> Mondongo</p>
            </div>
        </div>
    </div>
</body>


</html>