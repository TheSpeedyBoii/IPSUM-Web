<?php
require_once("../model/connect.php");
require_once("../model/validateRegister.php");


//Llave secreta para el reCAPTCHA
$secret = '6Le9Iy8qAAAAABB57vGNyYxOXwD8-uERb9nwvh6W';

//Obtenemos toda la información del formulario del registro y se lo pasamos como variables a los metodos.
$name = $_POST['name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];
$question1 = $_POST['question-1-label'];
$question2 = $_POST['question-2-label'];
$question3 = $_POST['question-3-label'];
$question4 = $_POST['question-4-label'];
$answer1 = $_POST['answer-1'];
$answer2 = $_POST['answer-2'];
$answer3 = $_POST['answer-3'];
$answer4 = $_POST['answer-4'];
$photo = $_FILES['photo'];
$role = 1;

$connection = new Connection();
$conn = $connection->conMysql();

$user = new User($conn);
$response = $user->reCaptcha($secret);

//Verifica la respuesta de la función reCaptcha para poder hacer el registro del usuario.
if ($response) {
    $user->incorrect_password($password, $confirm_password);
    $user->validateEmail($email);
    $user->emailExist($email);
    $user->addUser($name, $last_name, $email, $phone, $country, $password, $photo, $role, $answer1, $answer2, $answer3, $answer4, $question1, $question2, $question3, $question4);

} else {

    //Si $response no es true, indica que hubo un problema en la validación del reCAPTCHA.
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script language='JavaScript'>
        document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
         icon: 'error',
         title: 'Error en la validación reCAPTCHA',
         confirmButtonColor: '#D63030',
         confirmButtonText: 'OK',
         timer: 6000
            }).then(() => {
            location.assign('../view/register.php');
            });
        });
        </script>";

}




