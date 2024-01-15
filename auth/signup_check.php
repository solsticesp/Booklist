<?php
session_start();
include "db/config/db_conn.php";

if (isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['name']) && isset($_POST['re_pass'])) {
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
$name = validate($_POST['name']);
$re_password = validate($_POST['re_pass']);

$user_data = 'user=' . $user . '&name=' . $name;


if (empty($user)) {
    header("Location: pages/signup/signup.php?error=Username is required&$user_data");
    exit();
} else if (empty($pass)) {
    header("Location: pages/signup/signup.php?error=Password is required&$user_data");
    exit();
} else if (empty($name)) {
    header("Location: pages/signup/signup.php?error=Name is required&$user_data");
    exit();
} else if (empty($re_password)) {
    header("Location: pages/signup/signup.php?error=Repeat password is required&$user_data");
    exit();
} else if ($pass !== $re_password) {
    header("Location: pages/signup/signup.php?error=The confirmation password does not match&$user_data");
    exit();
} else {
    //hashing the pass
    $pass = md5($pass);

    $sql = "SELECT * FROM users WHERE `user_name`='$user'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        header("Location: pages/signup/signup.php?error=The user name is taken try another&$user_data");
        exit();
    } else {
        $sql2 = "INSERT INTO users(`user_name`, `password`, `name`) VALUES ('$user','$pass','$name')";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2) {
            header("Location: pages/signup/signup.php?success=Your account has been created successfully&$user_data");
            exit();
        } else {
            header("Location: pages/signup/signup.php?error=Unknown error occured&$user_data");
            exit();
        }
    }
}
