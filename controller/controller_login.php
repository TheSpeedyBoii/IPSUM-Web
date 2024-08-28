<?php

require_once("../model/connect.php");
require_once("../model/validateUser.php");


//Obtiene los valores del formulario de inicio de sesión.
$email = $_POST['email'];
$password = $_POST['password'];

$connection = new Connection();
$conn = $connection->conMysql();

$validate = new User($email, $password, $conn);
$validate->validateLogin();

