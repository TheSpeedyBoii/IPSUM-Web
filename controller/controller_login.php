<?php

<<<<<<< HEAD
require_once("../model/connect.php");
require_once("../model/validateUser.php");
=======
require_once ("../model/connect.php");
require_once ("../model/validateUser.php");
>>>>>>> d7078e8fd605cb8cb11e27f121f0b792b1b54b34

$email = $_POST['email'];
$password = $_POST['password'];

$conexion = new Conexion();
$conn = $conexion->conMysql();

<<<<<<< HEAD
$validarr = new User($email, $password, $conn);
$validarr->validateLogin();
=======
$validateLogin = new User($email, $password, $conexion);
$validateLogin -> validateLogin();

?>
>>>>>>> d7078e8fd605cb8cb11e27f121f0b792b1b54b34
