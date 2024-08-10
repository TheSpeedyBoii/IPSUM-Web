<?php

    $host= "localhost";
    $user= "root";
    $password= "";

    $mysqlconnect = mysqli_connect("$host", "$user", "$password");

    if($mysqlconnect == false){
        die("SQL is not connected");
    }
    else
        echo("SQL is connected");

?>