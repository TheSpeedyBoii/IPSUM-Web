<?php

class User
{
    private $connection;

    //Contructor para la conexión a la base de datos.
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    //Función para validar contraseñas
    public function incorrect_password($password, $confirm_password)
    {
        //Solicita un mínimo de 8 caracteres para la contraseña.
        if (strlen($password) < 8) {
            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script language='JavaScript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'La contraseña debe tener al menos 8 caracteres',
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

        //Verifica que la contraseña y la confirmación de contraseña coincidan.
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

    //Función para validar el correo electrónico.
    public function validateEmail($email)
    {
        //Regex para verificar que el correo tenga el dominio de gmail.com.
        $email_regex = "/^[a-zA-Z0-9._%+-]+@gmail\.com$/";
        if (!preg_match($email_regex, $email)) {
            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script language='JavaScript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'El correo no es válido. Solo se permiten correos de Gmail.',
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
    
    //Verifica si el correo ya existe dentro de la base de datos.
    public function emailExist($email)
    {   
        //Inicializamos una variable para contar la existencia del usuario después de la consulta.
        $count = 0;

        //Realizamos una consulta a la tabla de users donde el email corresponda al usuario que intenta registrarse.
        $sql = "SELECT COUNT(email) FROM users WHERE email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        //Si encuentra una coincidencia va almacenar el numero dentro de la variable $count.
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        //Si esa coincidencia existe va a arrojar una alerta indicando que el usuario ya existe.
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

    //Función para registrar al usuario.
    public function addUser($name, $last_name, $email, $phone, $country, $password, $photo, $role, $answer1, $answer2, $answer3, $answer4, $question1, $question2, $question3, $question4)
    {
        //Verifica que los campos no se encuentren vacios.
        if (empty($name) || empty($last_name) || empty($password) || empty($phone) || empty($email) || empty($country) || empty($answer1) || empty($answer2) || empty($answer3) || empty($answer4)) {
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

            //Si los campos no se encuentran vacíos realiza el hash de la contraseña.
            $PasswordHash = password_hash($password, PASSWORD_DEFAULT);

            //Procesa y almacena la foto de perfil del usuario.

            //Construimos el nombre final de la foto, combinando el nombre del usuario con el nombre original de la foto.
            $photo_name = $name . $photo['name'];

            //Obtenemos la ubicación temporal del archivo subido.
            $photo_tmp = $photo['tmp_name'];

            //Define la carpeta donde se almacenarán las fotos de perfil.
            $photo_folder = 'C:/wamp64/www/IPSUM-Web/profile_photos/';

            //Construimos la ruta completa donde se almacenara el archivo, esto es lo que se pasará a la base de datos.
            $folder_destiny = $photo_folder . $photo_name;

            if (move_uploaded_file($photo_tmp, $folder_destiny)) {

                //Realizamos una consulta preparada para la inserción del usuario dentro de la base de datos a la tabla users.
                $stmt = $this->connection->prepare("INSERT INTO users (first_name, last_name, email, phone, country, pass, photo, id_role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $name, $last_name, $email, $phone, $country, $PasswordHash, $folder_destiny, $role);
                $stmt->execute();

                //Obtenemos el id del usuario al cual realizamos la ultima insersión y lo pasamos a la variable $userId.
                $userId = $this->connection->insert_id;

                //Realizamos otra consulta preparada para la insersión de las preguntas y respuestas del usuario dentro de la tabla answers.
                $stmt = $this->connection->prepare("INSERT INTO answers (id_user, question_1, answer_1, question_2, answer_2, question_3, answer_3, question_4, answer_4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issssssss", $userId, $question1, $answer1, $question2, $answer2, $question3, $answer3, $question4, $answer4);
                $stmt->execute();
                $stmt->close();

                //Si no ocurre ningún problema al momento de hacer las inserciones se le muestra una alerta confirmando el registro y se le redirige al login.
                echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script language='JavaScript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario registrado con éxito',
                        confirmButtonColor: '#D63030',
                        confirmButtonText: 'OK',
                        timer: 3000 // Tiempo para mostrar la alerta antes de redirigir
                    }).then(() => {
                        window.location.href = '../view/login.php';
                    });
                });
                </script>";
            } else {

                //Si ocurrió un problema, indica que algo salió mal.
                echo "<script>console.log('Salio mal al mover');</script>";
            }
        }
    }

    //Función para validar la respuesta del reCAPTCHA.
    public function reCaptcha($secret)
    {
        //Inicializamos una variable para obtener la respuesta de la validación del reCAPTCHA.
        $response = false;

        //Verifica que el token del reCAPTCHA existe y no se encuentra vacío.
        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

            //Envía una solicitud a la API, este envía la llave secreta que se define en el controlador y almacena la respuesta en $verifyResponse.
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);

            //Como la respuesta viene en formato JSON  se decodifica mediante la función json_decode.  
            $responseData = json_decode($verifyResponse);

            //Verifica si la respuesta de la solicitud al API fue correcta.
            if ($responseData->success) {

                //Da el valor de true a la variable de $response.
                $response = true;


            } else {

                //Si la respuesta no es satisfactoria envia una alerta indicando un error en la validación reCAPTCHA y envia al usuario al registro.
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
        }

        //Retorna la variable de $response.
        return $response;
    }
}