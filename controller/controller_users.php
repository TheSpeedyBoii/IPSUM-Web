<?php

require_once("../model/connect.php");
require_once("../model/getUsers.php");

//Usamos el valor que tenemos dentro de la sesión (Correo) para realizar la consulta.
$email = $_SESSION["Email"];

$connection = new Connection();
$conn = $connection->conMysql();

$getUser = new User($email, $conn);
$userData = $getUser->getUser();
$allUsers = $getUser->getAllUsers();
