<?php

function redirect(string $key) : string
{
    $key = htmlentities(trim($key));
    $hostname = "localhost";
    $username = "shortly";
    $password = "!QSeFtHu8";
    $dbname = "shortly";
    $table = "shorten_table";
    $is_key_found = false;
    $redirect_link = '';

    // Create connection
    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    // Check connection
    if (!$conn){
        die("Connection failed: " . $conn->connect_error);
    }
    // Query to get URLs and tokens from database
    $sql_get = "SELECT long_url, token FROM $table";

    foreach (mysqli_query($conn, $sql_get) as $row) {
        if ($row['token'] == $key){
            global $is_key_found;
            $is_key_found = true;
            global $redirect_link;
            $redirect_link = "Location: " . $row['long_url'];
            break;
        }
    }

    if (!$is_key_found){
        global $redirect_link;
        $redirect_link = "Location: http://shortly";
        }
    $conn -> close();

    return $redirect_link;

}

