<?php

require_once("../model/connect.php");
require_once("../model/getUsers.php");

$email = $_SESSION["Email"];

$connection = new Connection();
$conn = $connection->conMysql();

$getUser = new User($email, $conn);
$userData = $getUser->getUser();
