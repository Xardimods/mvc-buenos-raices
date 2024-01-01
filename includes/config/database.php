<?php

function conectarDatabase() : mysqli {
    // Creating the DB conection - Database credentials
    $db = new mysqli(
    $_ENV["DB_HOST"], 
    $_ENV["DB_USER"], 
    $_ENV["DB_PASS"], 
    $_ENV["DB_NAME"]
); 

    if(!$db) {
        echo "Error Conection.";
        exit;
    }

    return $db; 
}