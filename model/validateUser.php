<?php
session_start();

class User
{
    private $email;
    private $password;
    private $connection;


    public function __construct($email, $password, $connection)
    {
        $this->email = $email;
        $this->password = $password;
        $this->connection = $connection;
    }

    public function validateLogin()
    {

        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $validate_login = $stmt->get_result();

        if ($validate_login->num_rows > 0) {
            $user_DB = $validate_login->fetch_assoc();
            $validate_email = $user_DB['email'];
            $role = $user_DB['id_role'];
            $passHash = $user_DB['pass'];

            $_SESSION["Email"] = $validate_email;
            $_SESSION["Role"] = $role;

            if (password_verify($this->password, $passHash)) {
                if ($role == 2) {
                    header("Location: ../view/admin_panel.php");
                } else {
                    header("Location: ../view/welcome.php");
                }
                exit;
            } else {
                echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Falla al comparar contraseñas',
                confirmButtonColor: '#D63030',
                confirmButtonText: 'OK',
                timer: 6000
            }).then(() => {
                location.assign('../view/login.php');
            });
            </script>";
                exit();
            }
        }

        echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
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
    </script>";
    }
}
