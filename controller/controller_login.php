<?php

require_once("../model/connect.php");
require_once("../model/validateUser.php");

$email = $_POST['email'];
$password = $_POST['password'];

$connection = new Connection();
$conn = $connection->conMysql();

$validate = new User($email, $password, $conn);
$validate->validateLogin();

