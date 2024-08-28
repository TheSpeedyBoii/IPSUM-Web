<?php
session_start();
//Romper la sesión
session_destroy();
//Romper la cookie
setcookie(session_name(), '', time() - 3600, '/');
//Regresar al Login
header('Location: ../view/login.php');

exit();