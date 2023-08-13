<?php

    $database= new mysqli("localhost","root","","8box_appointment");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>