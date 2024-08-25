<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario y Tabla</title>
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
            <input type="email" name="question-3" id="question_3" placeholder="">
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
                        <th>País</th>
                        <th>Teléfono</th>
                        <th>Pregunta 1</th>
                        <th>Pregunta 2</th>
                        <th>Pregunta 3</th>
                        <th>Pregunta 4</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Juan</td>
                        <td>Juan</td>
                        <td>Pérez</td>
                        <td>juan.perez@example.com</td>
                        <td>España</td>
                        <td>123456789</td>
                        <td>Respuesta 1</td>
                        <td>Respuesta 2</td>
                        <td>Respuesta 3</td>
                        <td>Respuesta 4</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
