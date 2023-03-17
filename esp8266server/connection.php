<?php
//db variables
    $host = "localhost";
    $dbname = "ESP8266watering";
    $user = "root";
    $password = "";

    try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
        echo 'conection ok <br>';
    }
    catch(Exception $e){
        die('ERROR: '. $e->GetMessage());

    }

    ?>