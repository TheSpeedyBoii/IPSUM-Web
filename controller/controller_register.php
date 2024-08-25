<?php
require_once("../model/connect.php");
require_once("../model/validateRegister.php");

$secret = '6Ld6GS8qAAAAAKtlzQnCYyC-DUH8WeNxQ3GiSWVE'; 

$name = $_POST['name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];
$question1 = $_POST['question-1'];
$question2 = $_POST['question-2'];
$question3 = $_POST['question-3'];
$question4 = $_POST['question-4'];
$photo = $_FILES['photo'];
$role = 1;

$connection = new Connection();
$conn = $connection->conMysql();

$user = new User($conn);

if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {
    
        $user->incorrect_password($password, $confirm_password);
    
        $user->validateEmail($email);

        $user->emailExist($email);

        $user->addUser($name, $last_name, $email, $phone, $country, $password, $photo, $role, $question1, $question2, $question3, $question4);
    } else {
        
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
} else {
   
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script language='JavaScript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Por favor, completa la verificación reCAPTCHA',
                confirmButtonColor: '#D63030',
                confirmButtonText: 'OK',
                timer: 6000
            }).then(() => {
                location.assign('../view/register.php');
            });
        });
        </script>";
}
