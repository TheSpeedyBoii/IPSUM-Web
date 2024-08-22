<?php
session_start();

class User
{
    private $email;

    private $password;
    private $conexion;


    public function __construct($email, $password, $conexion)
    {
        $this->email = $email;
        $this->password = $password;
        $this->conexion = $conexion;
    }

    public function validateLogin()
    {
        $validate_login = $this->conexion->query("SELECT * FROM users WHERE email ='$this->email'");
        if ($validate_login->num_rows > 0) {
            $user_DB = $validate_login->fetch_assoc();
            $validate_email = $user_DB['email'];
            $passHash = $user_DB['pass'];
            $_SESSION["Email"] = $validate_email;
            if (password_verify($this->password, $passHash)) {
                echo '<script>window.location.href="../view/welcome.php";</script>';
                exit;
            } else {
                echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script language='JavaScript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Falla al comparar contraseñas',
                        confirmButtonColor: '#D63030',
                        confirmButtonText: 'OK',
                        timer: 6000
                    }).then(() => {
                        location.assign('../view/login.php');
                    });
                });
                </script>";
                exit();
            }
        }
        echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script language='JavaScript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Usuario No Existe o Contraseña Incorrecta. Verifique Su Informacion',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    timer: 5000
                  }).then(() => {
                    location.assign('../view/login.php');
                  });
        });
            </script>";
    }
}
