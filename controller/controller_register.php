<?php
require_once("../model/connect.php");
require_once("../model/validateRegister.php");


$name = $_POST['name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];
$question1 = $_POST['question-1'];
$question2 = $_POST['question-2'];
$question3 = $_POST['question-3'];
$question4 = $_POST['question-4'];
$photo = $_FILES['photo'];
$role = 1;
$connection = new Connection();
$conn = $connection->conMysql();

$user = new User($conn);

$user->incorrect_password($password, $confirm_password);
$user->validateEmail($email);
$user->emailExist($email);
$user->addUser($name, $last_name, $email, $phone, $country, $password, $photo, $role, $question1, $question2, $question3, $question4);
