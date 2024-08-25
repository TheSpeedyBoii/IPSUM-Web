<?php

class User
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function incorrect_password($password, $confirm_password)
    {
        if ($password !== $confirm_password) {
            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script language='JavaScript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Las contraseñas no coinciden',
                        confirmButtonColor: '#D63030',
                        confirmButtonText: 'OK',
                        timer: 6000
                    }).then(() => {
                        location.assign('../view/register.php');
                    });
                });
                </script>";
            exit();
        }
    }

    public function validateEmail($email)
    {
        $email_regex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        if (!preg_match($email_regex, $email)) {
            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script language='JavaScript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'El correo no es valido',
                        confirmButtonColor: '#D63030',
                        confirmButtonText: 'OK',
                        timer: 6000
                    }).then(() => {
                        location.assign('../view/register.php');
                    });
                });
                </script>";
            exit();
        }
    }
    public function emailExist($email)
    {
        $count = 0;
        $sql = "SELECT COUNT(email) FROM users WHERE email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script language='JavaScript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'El usuario ya existe',
                        confirmButtonColor: '#D63030',
                        confirmButtonText: 'OK',
                        timer: 6000
                    }).then(() => {
                        location.assign('../view/register.php');
                    });
                });
                </script>";
            exit();
        }
    }

    public function addUser($name, $last_name, $email, $phone, $country, $password, $photo, $role, $question1, $question2, $question3, $question4)
    {
        if (empty($name) || empty($last_name) || empty($password) || empty($phone) || empty($email) || empty($country) || empty($question1) || empty($question2) || empty($question3) || empty($question4)) {
            echo "
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <script language='JavaScript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Faltan datos',
                            confirmButtonColor: '#D63030',
                            confirmButtonText: 'OK',
                            timer: 6000
                        }).then(() => {
                            location.assign('../view/register.php');
                        });
                    });
                    </script>";
        } else {
            $PasswordHash = password_hash($password, PASSWORD_DEFAULT);
            // ---------------------------------------------------------- ---------------------------------------------------------- ------------------------------------------------------------------------------------------------------------
            $photo_name = $name . $photo['name'];
            $photo_tmp = $photo['tmp_name'];
            $photo_folder = 'C:/wamp64/www/IPSUM-Web/profile_photos/';
            $folder_destiny = $photo_folder . $photo_name;
            if (move_uploaded_file($photo_tmp, $folder_destiny)) {

                $stmt = $this->connection->prepare("INSERT INTO users (first_name, last_name, email, phone, country, pass, photo, id_role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $name, $last_name, $email, $phone, $country, $PasswordHash, $folder_destiny, $role);
                $stmt->execute();

                $userId = $this->connection->insert_id;

                $stmt = $this->connection->prepare("INSERT INTO questions (user_id, question_1, question_2, question_3, question_4) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("issss", $userId, $question1, $question2, $question3, $question4);
                $stmt->execute();

                $stmt->close();
                echo '<script>window.location.href="../view/login.php";</script>';

            } else {
                echo "<script>console.log('Salio mal al mover');</script>";
            }

        }
    }
}