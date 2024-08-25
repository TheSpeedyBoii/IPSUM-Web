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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Plot Admin</title>
    <link rel="stylesheet" href="styles/admin_panel.css">
</head>
<body>
<?php require_once('header.php') ?>
    <div class="container">
        <div class="form-container">
        <form action="" method="POST">
            <label for="question_1">Pregunta 1</label>
            <input type="text" name="question-1" id="question_1" placeholder="">
            <label for="question_2">Pregunta 2</label>
            <input type="text" name="question-2" id="question_2" placeholder="">
            <label for="question_3">Pregunta 3</label>
            <input type="text" name="question-3" id="question_3" placeholder="">
            <label for="question_4">Pregunta 4</label>
            <input type="text" name="question-4" id="question_4" placeholder="">
            <button type="submit">Actualizar Preguntas</button>
        </form>
    </div>
    <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>País</th>
                <th>Teléfono</th>
                <th>Pregunta 1</th>
                <th>Pregunta 2</th>
                <th>Pregunta 3</th>
                <th>Pregunta 4</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($allUsers)) : ?>
                <?php foreach ($allUsers as $user) : ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Foto de <?php echo htmlspecialchars($user['first_name']); ?>" width="50" height="50"></td>
                        <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td><?php echo htmlspecialchars($user['country']); ?></td>
                        <td><?php echo htmlspecialchars($user['phone']); ?></td>
                        <td><?php echo htmlspecialchars($user['question_1']); ?></td>
                        <td><?php echo htmlspecialchars($user['question_2']); ?></td>
                        <td><?php echo htmlspecialchars($user['question_3']); ?></td>
                        <td><?php echo htmlspecialchars($user['question_4']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="10">No hay usuarios registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
    </div>
</body>
</html>
