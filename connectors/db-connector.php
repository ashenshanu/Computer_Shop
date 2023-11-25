<?php


function getConnection(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "mrpc";

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