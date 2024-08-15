<?php

require_once ("../model/connect.php");
require_once ("../model/validateUser.php");

$email = $_POST['email'];
$password = $_POST['password'];

$conexion = new Conexion();
$conn = $conexion->conMysql();

$validateLogin = new User($email, $password, $conexion);
$validateLogin -> validateLogin();

?>