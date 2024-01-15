<?php

$serverName = "localhost";
$uname = "root";
$password = "";

$db_name = "crud_operation";


$conn = mysqli_connect($serverName, $uname, $password, $db_name);


if (!$conn) {
    echo "Connection failed!";
}
