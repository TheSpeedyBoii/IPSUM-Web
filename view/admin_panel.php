<?php
session_start();
if (!isset($_SESSION["Role"])) {
    echo '<script>window.location.href="../view/login.php";</script>';
} else if ($_SESSION["Role"] == "1") {
    echo '<script>window.location.href="../view/welcome.php";</script>';
    exit();
} 
require_once("../controller/controller_questions.php");
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
        <div class="top-section">
            <!-- Contenedor de información del usuario -->
            <div class="user-info-container">
                <h2>Información del Usuario</h2>
                <p>Nombre: <?php echo htmlspecialchars($userData['first_name'] ?? ''); ?></p>
                <p>Apellido: <?php echo htmlspecialchars($userData['last_name'] ?? ''); ?></p>
                <p>Correo: <?php echo htmlspecialchars($userData['email'] ?? ''); ?></p>
                <p>País: <?php echo htmlspecialchars($userData['country'] ?? ''); ?></p>
                <p>Teléfono: <?php echo htmlspecialchars($userData['phone'] ?? ''); ?></p>
                <img src="<?php echo htmlspecialchars($userData['photo'] ?? ''); ?>" alt="Foto de <?php echo htmlspecialchars($userData['first_name'] ?? ''); ?>" width="150" height="150">
            </div>

            <!-- Contenedor de preguntas -->
            <div class="form-container">
            <h2>Cambiar preguntas</h2>
                <form action="../controller/controller_questions" method="POST">
                    <label for="question_1"><?php echo htmlspecialchars($questions[0]['question'] ?? ''); ?></label>
                    <input type="hidden" name="question-1-id" value="<?php echo htmlspecialchars($questions[0]['question_id'] ?? ''); ?>" />
                    <input type="text" name="question-1" id="question_1" placeholder="Ingrese la nueva pregunta">

                    <label for="question_2"><?php echo htmlspecialchars($questions[1]['question'] ?? ''); ?></label>
                    <input type="hidden" name="question-2-id" value="<?php echo htmlspecialchars($questions[1]['question_id'] ?? ''); ?>" />
                    <input type="text" name="question-2" id="question_2" placeholder="Ingrese la nueva pregunta">

                    <label for="question_3"><?php echo htmlspecialchars($questions[2]['question'] ?? ''); ?></label>
                    <input type="hidden" name="question-3-id" value="<?php echo htmlspecialchars($questions[2]['question_id'] ?? ''); ?>" />
                    <input type="text" name="question-3" id="question_3" placeholder="Ingrese la nueva pregunta">

                    <label for="question_4"><?php echo htmlspecialchars($questions[3]['question'] ?? ''); ?></label>
                    <input type="hidden" name="question-4-id" value="<?php echo htmlspecialchars($questions[3]['question_id'] ?? ''); ?>" />
                    <input type="text" name="question-4" id="question_4" placeholder="Ingrese la nueva pregunta">
                    <button type="submit">Actualizar Preguntas</button>
                </form>
            </div>
        </div>

        <!-- Contenedor de la tabla -->
        <div class="table-container">
        <h2>Usuarios</h2>
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
                        <th>Respuesta 1</th>
                        <th>Pregunta 2</th>
                        <th>Respuesta 2</th>
                        <th>Pregunta 3</th>
                        <th>Respuesta 3</th>
                        <th>Pregunta 4</th>
                        <th>Respuesta 4</th>
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
                                <td><?php echo htmlspecialchars($user['answer_1']); ?></td>
                                <td><?php echo htmlspecialchars($user['question_2']); ?></td>
                                <td><?php echo htmlspecialchars($user['answer_2']); ?></td>
                                <td><?php echo htmlspecialchars($user['question_3']); ?></td>
                                <td><?php echo htmlspecialchars($user['answer_3']); ?></td>
                                <td><?php echo htmlspecialchars($user['question_4']); ?></td>
                                <td><?php echo htmlspecialchars($user['answer_4']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="15">No hay usuarios registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
