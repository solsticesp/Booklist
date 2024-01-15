<?php
include("db/config/db_conn.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];


    $query = "DELETE FROM books WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Query Failed";
    } else {
        header("Location: pages/home/home.php?delete_msg=You have deleted data successfully");
    }
}
