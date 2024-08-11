<?php

class User {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }


    /*public function emailExist($email){
            $count = 0;
            $stmt = $this->connection->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fecth();
            $stmt->close();
            return $count > 0;

        }
    */
    public function addUser($name, $last_name, $email, $phone, $mdPassword) {
            $stmt = $this->connection->prepare("INSERT INTO users (first_name, last_name, email, password, phone) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $last_name, $email, $mdPassword, $phone);
            $stmt->execute();
            $stmt->close();
        }
}

?>