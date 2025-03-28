<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //db_connect.inc
    //Check what server you are accessing
    if ($_SERVER['SERVER_NAME'] == 'localhost')
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "yap";
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
?>