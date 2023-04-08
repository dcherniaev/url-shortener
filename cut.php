<?php
//echo create_short_url("https://www.w3schools.com/php/php_mysql_select.asp");
function create_short_url(string $url) : string
    {
        $url = htmlentities(trim($url));
        $hostname = "localhost";
        $username = "shortly";
        $password = "!QSeFtHu8";
        $dbname = "shortly";
        $table = "shorten_table";
        $is_url_found = false;
        $result = '-';

        // Create connection
        $conn = mysqli_connect($hostname, $username, $password, $dbname);
        // Check connection
        if (!$conn){
            die("Connection failed: " . $conn->connect_error);
        }
        // Query to get URLs and tokens from database
        $sql_get = "SELECT long_url, token FROM $table";

        foreach (mysqli_query($conn, $sql_get) as $row) {
            if ($row['long_url'] == $url){
                global $result;
                $result = "https://shortly.com?s=" . $row['token'];
                global $is_url_found;
                $is_url_found = true;
            }
        }

        if (!$is_url_found){
            $created = date("Y-m-d");
            $expiring = date("Y-m-d", strtotime("+30 weeks"));
            $token = get_unique_token($conn, $sql_get);

            $sql_insert = "INSERT INTO $table (token, long_url, created, expiring)
            VALUES ('$token', '$url', '$created', '$expiring')";

            if (mysqli_query($conn, $sql_insert)) {
                $result = "https://shortly.com?s=" . $token;
            } else {
                $result = "ERROR IN INSERT";
            }
        }
        $conn -> close();
        return $result;

}
        function get_unique_token(mysqli $conn, string $sql): string{
            $seed = str_split('abcdefghijklmnopqrstuvwxyz0123456789');
            shuffle($seed);
            $token = '';
            foreach (array_rand($seed, 10) as $k) $token .= $seed[$k];
            foreach (mysqli_query($conn, $sql) as $row) {
                if ($row['token'] == $token){
                    get_unique_token($conn);
                }
            }
            return $token;
        }
















