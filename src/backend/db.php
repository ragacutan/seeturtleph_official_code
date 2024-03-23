<?php

    // Db credentials
    $host_name = "mysql_db";
    $username = "root";
    $password = "root";
    $db_name = "db_turtle";

    // Connect to a databse (hostname, username, password and database name)
    $connection = mysqli_connect($host_name, $username, $password, $db_name);

    if(!$connection) {
        die("Connection failed : " . mysqli_connect_error());
    }
?>