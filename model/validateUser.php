<?php
//Iniciar la sesión.
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

    //Función de validar el inicio de sesión del usuario.
    public function validateLogin()
    {   

        //Consulta a la base de datos para obtener el usuario mediante el email.
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();

        //Si encuentra una coincidencia almacena el resultado dentro de $validate_login.
        $validate_login = $stmt->get_result();


        if ($validate_login->num_rows > 0) {
            $user_DB = $validate_login->fetch_assoc();
            $validate_email = $user_DB['email'];
            $role = $user_DB['id_role'];
            $passHash = $user_DB['pass'];

            //Asignamos el correo y el rol a la variable de sesión.
            $_SESSION["Email"] = $validate_email;
            $_SESSION["Role"] = $role;

            //Comparamos la contraseña hasheada de la base de datos con la que nos proporciona el usuario.
            if (password_verify($this->password, $passHash)) {

                //Si el usuario cuenta con el rol 2 (admin) lo redirige al panel, si no dispone de este rol lo llevara a la vista de la tarjeta del usuario.
                if ($role == 2) {
                    header("Location: ../view/admin_panel.php");
                } else {
                    header("Location: ../view/welcome.php");
                }
                exit;

            //Si falla la comparación de las contraseñas le arroja esta alerta.
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

        //Si no encuentra una coincidencia por el correo le arroja esta alerta.
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