<?php


function getConnection(){

    $servername = "localhost";
    $username = "root";
    $password = "123456";
    $database = "sanakin_db";

    $conn = new mysqli($servername, $username, $password, $database);
    try {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    } catch (Exception $error) {
        echo "Connection failed: " . $error->getMessage();
    }
    return $conn;
}


?>