<?php
session_start();
$email = $_SESSION["Email"];
if (!isset($_SESSION["Email"])) {
    echo '<script>window.location.href="../view/login.php";</script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WePlot</title>
    <link rel="stylesheet" href="styles/welcome.css" />
</head>

<body>
    <?php require_once('header.php') ?>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Pregunta 1</th>
                <th>Pregunta 2</th>
                <th>Pregunta 3</th>
                <th>Pregunta 4</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td><?php echo $email ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>

</html>