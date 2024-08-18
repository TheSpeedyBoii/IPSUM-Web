<?php

class User {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }


    public function emailExist($email){
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
        
        public function addUser($name, $last_name, $email, $phone,$country, $mdPassword, $food, $artist, $place, $color) {
            $stmt = $this->connection->prepare("INSERT INTO users (first_name, last_name, email, phone, country, pass, id_role) VALUES (?, ?, ?, ?, ?, ?, 1)");
            $stmt->bind_param("ssssss", $name, $last_name, $email, $phone, $country, $mdPassword);
            $stmt->execute();
            
            $userId = $this->connection->insert_id;
            
            $stmt = $this->connection->prepare("INSERT INTO questions (user_id, favorite_food, favorite_artist, favorite_place, favorite_color) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $userId, $food, $artist, $place, $color);
            $stmt->execute();
            
            $stmt->close();
        }

        
}

?>