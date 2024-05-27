<?php

    $database= new mysqli("health-care-database.c1mqu4i64rnf.ap-south-1.rds.amazonaws.com","admin","Amrita2025","health-care-database");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>
