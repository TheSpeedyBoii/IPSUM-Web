<?php
class User
{
    private $email;
    private $connection;

    public function __construct($email, $conexion)
    {
        $this->email = $email;
        $this->connection = $conexion;
    }

    public function getUser()
    {
        $getUser = $this->connection->query("
            SELECT users.*, questions.question_1, questions.question_2, questions.question_3, questions.question_4
            FROM users
            LEFT JOIN questions ON users.user_id = questions.user_id
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
    }
