<?php

function database_connect()
{
    $conn = new mysqli(DB_HOST,DB_USERNAME, DB_PASSWORD, DB_NAME);
    if(!$conn){
        exit('Connection failed');
    }
    return $conn;
}

function database_disconnect($conn)
{
    if(isset($conn)) $conn->close();
}