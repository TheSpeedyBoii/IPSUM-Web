<?php

require_once '../model/connect.php';
require_once '../model/addUser.php';

class controller_register{
    public function returnManejos(){
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        if ($action == 'register') {
            $this->register();
        }
    }

    public function register(){
        $name = trim($_POST['name']);
        $last_name = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $country = trim($_POST['country']);
        $food = trim($_POST['food']);
        $artist = trim($_POST['artist']);
        $place = trim($_POST['place']);
        $color = trim($_POST['color']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm-password']);

        if ($password !== $confirm_password) {
            echo 'Las contraseñas no coinciden';
            return;
        }
        
        if (empty($name) || empty($last_name) || empty($password) || empty($phone) || empty($email) || empty($country) || empty($password) || empty($confirm_password)) {
            echo 'Por favor, complete todos los campos';
            return;
        }

        $email_regex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        if (!preg_match($email_regex, $email)) {
            echo 'La dirección de correo electrónico no es válida';
            return;
        }

        $connection = new SQL_Connect();
        $user = new User($connection->getConn());

        if ($user->emailExist($email)) {
            echo 'El correo electrónico ya está registrado';
            return;
        }

        $mdPassword = password_hash($password, PASSWORD_DEFAULT);
        $user->addUser($name, $last_name, $email, $phone, $country, $mdPassword, $food, $artist, $place, $color);
        header('Location: login.php');
        exit;
    }

}
?>