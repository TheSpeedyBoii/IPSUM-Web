<?php

require_once("../model/connect.php");
require_once("../model/validateUser.php");

$email = $_POST['email'];
$password = $_POST['password'];

$conexion = new Conexion();
$conn = $conexion->conMysql();

$validarr = new User($email, $password, $conn);
$validarr->validateLogin();
