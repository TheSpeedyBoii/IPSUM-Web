<?php
class Connection
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "db_system";

    public function conMysql()
    {
        $connect = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($connect->connect_error) {
            die('conexion a la base de datos fallida' . $connect->connect_error);
        }
        return $connect;
    }
}