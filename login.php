<?php
session_start();
include "db_conn.php";

if (isset($_POST['user']) && isset($_POST['pass'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$user = validate($_POST['user']);
$pass = validate($_POST['pass']);

if (empty($user)) {
    header("Location: index.php?error=Username is required");
    exit();
} else if (empty($pass)) {
    header("Location: index.php?error=Password is required");
    exit();
} else {
    //hashing the password
    $pass = md5($pass);

    $sql = "SELECT * FROM users WHERE `user_name`='$user' AND `password`='$pass'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['user_name'] === $user && $row['password'] === $pass) {
            //echo "Logged In!";
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header('Location: home.php');
            exit();
        }
    } else {
        header("Location: index.php?error=Incorrect User Name or Password");
        exit();
    }
}