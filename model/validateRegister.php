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

    /*public function validateEmail($email){
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
    }*/
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

    public function addUser($name, $last_name, $email, $phone, $country, $password, $role, $food, $artist, $place, $color)
    {
        if (empty($name) || empty($last_name) || empty($password) || empty($phone) || empty($email) || empty($country) || empty($food) || empty($artist) || empty($place)  || empty($color)) {
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
            $mdPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->connection->prepare("INSERT INTO users (first_name, last_name, email, phone, country, pass, id_role) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $name, $last_name, $email, $phone, $country, $mdPassword, $role);
            $stmt->execute();

            $userId = $this->connection->insert_id;

            $stmt = $this->connection->prepare("INSERT INTO questions (user_id, favorite_food, favorite_artist, favorite_place, favorite_color) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $userId, $food, $artist, $place, $color);
            $stmt->execute();

            $stmt->close();
            echo '<script>window.location.href="../view/login.php";</script>';
        }
    }
}
