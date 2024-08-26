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
    
    public function getUser()
    {
        $getUser = $this->connection->query("
            SELECT users.*, answers.*
            FROM users
            LEFT JOIN answers ON users.user_id = answers.id_user
            WHERE users.email = '$this->email'");

        $userArray = array();

        if ($getUser->num_rows > 0) {

            $userData = $getUser->fetch_assoc();

            $absolutePath = 'C:/wamp64/www/IPSUM-Web/';
            $relativePath = str_replace($absolutePath, '../', $userData['photo']);
            $userData['photo'] = $relativePath;
            $userArray = $userData;
        }

        return $userArray;
    }

    public function getAllUsers()
    {
        $getUsers = $this->connection->query("
        SELECT users.*, 
           answers.*,
           roles.role
            FROM users
            LEFT JOIN answers ON users.user_id = answers.id_user
            LEFT JOIN roles ON users.id_role = roles.id_role
        ");


        $allusersArray = array();

        if ($getUsers->num_rows > 0) {

            while ($userData = $getUsers->fetch_assoc()) {

                $absolutePath = 'C:/wamp64/www/IPSUM-Web/';
                $relativePath = str_replace($absolutePath, '../', $userData['photo']);
                $userData['photo'] = $relativePath;

                $allusersArray[] = $userData;
            }
        }

        return $allusersArray;
    }


}
