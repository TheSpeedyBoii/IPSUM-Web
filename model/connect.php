<?php
class SQL_Connect {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "db_system";
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password);

        if ($this->conn === false) {
            die("SQL is not connected: " . mysqli_connect_error());
        }

        $retval = mysqli_select_db($this->conn, $this->dbname);

        if (!$retval) {
            die('Could not select database: ' . mysqli_error($this->conn));
        }

    }

    public function getConn() {
        return $this->conn;
    }
}

$connection = new SQL_Connect();
$conn = $connection->getConn();
?>

