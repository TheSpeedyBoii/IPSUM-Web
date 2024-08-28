<?php
class User
{
    private $email;
    private $connection;

    public function __construct($email, $conn)
    {
        $this->email = $email;
        $this->connection = $conn;
    }
    
    //Función para traer la información del usuario dentro de la sesión.
    public function getUser()
    {
        //Consulta la base de datos en la tabla users y a la tabla answers, con esto traemos toda la información relacionada al usuario.
        $getUser = $this->connection->query("
            SELECT users.*, answers.*
            FROM users
            LEFT JOIN answers ON users.user_id = answers.id_user
            WHERE users.email = '$this->email'");

        //Definimos un array donde se va almacenar la información del usuario.
        $userArray = array();

        //Si encuentra coincidencias de la consulta.
        if ($getUser->num_rows > 0) {

            //Obtenemos la fila de resultados.
            $userData = $getUser->fetch_assoc();

            //Aqui definimos una ruta absoluta para la imagen,
            //esto se realiza debido a que dentro de la vista del usuario no podemos visualizar la imagen si se suministra una ruta absoluta.
            $absolutePath = 'C:/wamp64/www/IPSUM-Web/';

            //Definimos una variable relativa en donde vamos a manipular la cadena de texto (ruta) de la imagen
            //Y recortamos la ruta absoluta y añadimos ../ para convertir la ruta de la foto en una relativa.
            $relativePath = str_replace($absolutePath, '../', $userData['photo']);

            //Le pasamos ese valor de $relativePath a donde se encuentra la foto dentro del arreglo.
            $userData['photo'] = $relativePath;

            //Le pasamos la información del usuario a el array que definimos antes.
            $userArray = $userData;
        }

        return $userArray;
    }

    //Función para traer a todos los usuarios dentro la base de datos.
    public function getAllUsers()
    {
        //Realizamos una consulta a las tablas de users, answers y roles.
        $getUsers = $this->connection->query("
        SELECT users.*, 
           answers.*,
           roles.role
            FROM users
            LEFT JOIN answers ON users.user_id = answers.id_user
            LEFT JOIN roles ON users.id_role = roles.id_role
        ");

        //Definimos un array.
        $allusersArray = array();

        //Verifica si la consulta arrojo resultados.
        if ($getUsers->num_rows > 0) {

            //Itera sobre cada fila de resultados para almacenarlos en $userData.
            while ($userData = $getUsers->fetch_assoc()) {

                //Realizamos el mismo procedimiento para recortar la ruta absoluta de cada usuario y convertirla en relativa.
                $absolutePath = 'C:/wamp64/www/IPSUM-Web/';
                $relativePath = str_replace($absolutePath, '../', $userData['photo']);
                $userData['photo'] = $relativePath;

                //Se almacena la fila de cada usuario dentro de esta matriz.
                $allusersArray[] = $userData;
            }
        }

        return $allusersArray;
    }


}
