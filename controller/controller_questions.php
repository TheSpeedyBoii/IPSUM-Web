<?php

require_once("../model/getQuestions.php");
require_once("../model/connect.php");

$connection = new Connection();
$conn = $connection->conMysql();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questionsToUpdate = [];

    for ($i = 1; $i <= 4; $i++) {
        $questionId = $_POST["question-{$i}-id"] ?? null;
        $questionText = $_POST["question-{$i}"] ?? null;
        
        if (!empty($questionId) && !empty($questionText)) {
            $questionsToUpdate[$questionId] = $questionText;
        }
    }

    if (!empty($questionsToUpdate)) {
        $questionsModel = new Questions($conn, $questionsToUpdate);
        $questionsModel->updateQuestions();
    }
}

$getQuestions = new Questions($conn);
$questions = $getQuestions->getQuestions();
