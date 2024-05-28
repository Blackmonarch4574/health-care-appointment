<?php

    $database= new mysqli("php-database.cqbtncjorbsc.us-east-1.rds.amazonaws.com","admin","12345678","edoc");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>