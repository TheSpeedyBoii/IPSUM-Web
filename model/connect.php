<?php
class SQL_Connect {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $mysqlconnect;

    public function __construct() {
        $this->mysqlconnect = mysqli_connect($this->host, $this->user, $this->password);

        if ($this->mysqlconnect === false) {
            die("SQL is not connected");
        } else {
            echo "SQL is connected";
        }
    }
}

$connection = new SQL_Connect();
?>
