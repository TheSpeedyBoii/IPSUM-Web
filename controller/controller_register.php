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
$food = $_POST['food'];
$artist = $_POST['artist'];
$place = $_POST['place'];
$color = $_POST['color'];
$photo = $_FILES['photo'];
$role = 1;
$conexion = new Conexion();
$conn = $conexion->conMysql();

$user = new User($conn);

$user->incorrect_password($password, $confirm_password);
$user->validateEmail($email);
$user->emailExist($email);
$user->addUser($name, $last_name, $email, $phone, $country, $password, $photo, $role, $food, $artist, $place, $color);
$user->addPhoto($photo, $conn);
