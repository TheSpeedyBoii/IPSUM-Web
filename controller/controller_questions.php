<?php

require_once("../model/getQuestions.php");
require_once("../model/connect.php");


$connection = new Connection();
$conn = $connection->conMysql();

$updater = new Questions($conn);
$questions = $updater->getQuestions();

