<?php
session_start();
$email = $_SESSION["Email"];
if (!isset($_SESSION["Email"])) {
    echo '<script>window.location.href="../view/login.php";</script>';
    exit();
}
require_once("../controller/controller_users.php");
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
        <img src="<?php echo htmlspecialchars($userData['photo'] ?? ''); ?>" alt="Profile Image">
        </div>

        <div class="profile-info">
            <div class="left-column">
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($userData['first_name'] ?? ''); ?></p>
                <p><strong>Apellido:</strong> <?php echo htmlspecialchars($userData['last_name'] ?? ''); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email'] ?? ''); ?></p>
                <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($userData['phone'] ?? ''); ?></p>
                <p><strong>Pais:</strong> <?php echo htmlspecialchars($userData['country'] ?? ''); ?></p>

            </div>

            <div class="right-column">
                <p><strong>Pregunta 1:</strong> <?php echo htmlspecialchars($userData['question_1'] ?? ''); ?></p>
                <p><strong>Pregunta 2:</strong> <?php echo htmlspecialchars($userData['question_2'] ?? ''); ?></p>
                <p><strong>Pregunta 3:</strong> <?php echo htmlspecialchars($userData['question_3'] ?? ''); ?></p>
                <p><strong>Pregunta 4:</strong> <?php echo htmlspecialchars($userData['question_4'] ?? ''); ?></p>
            </div>
        </div>
    </div>
</body>


</html>