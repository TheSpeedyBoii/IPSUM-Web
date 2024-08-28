<?php

require_once("../model/getQuestions.php");
require_once("../model/connect.php");

$connection = new Connection();
$conn = $connection->conMysql();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $questionsToUpdate = [];

    //Itera sobre los campos de preguntas en el formulario.
    for ($i = 1; $i <= 4; $i++) {

        //Por cada pregunta obtiene el id y el texto del formulario.
        $questionId = $_POST["question-{$i}-id"] ?? null;
        $questionText = $_POST["question-{$i}"] ?? null;

        //Validar que tanto el ID como el texto de la pregunta no esten vacios.
        if (!empty($questionId) && !empty($questionText)) {

            //Agregar la pregunta al array de las actualizaciones.
            $questionsToUpdate[$questionId] = $questionText;
        }
    }

    //Si existen preguntas para actualizar instancia la clase y le pasa el array de preguntas.
    if (!empty($questionsToUpdate)) {
        $questionsModel = new Questions($conn, $questionsToUpdate);
        $questionsModel->updateQuestions();
    }
}

$getQuestions = new Questions($conn);
$questions = $getQuestions->getQuestions();
