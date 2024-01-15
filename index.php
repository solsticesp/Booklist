<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/login.css">
    <title>Вход</title>
</head>

<body>
    <form method="post" action="auth/login.php">
        <h2>LOGIN</h2>
        <h2>HERE</h2>

        <?php if (isset($_GET['error'])) { ?>
            <p class="error">
                <?php echo $_GET['error']; ?>
            </p>
        <?php } ?>

        <label for="username">Username: </label>
        <br>
        <input type="text" name="user" placeholder="Username" autocomplete="off">
        <br>
        <label for="password">Password: </label>
        <br>
        <input type="password" name="pass" placeholder="Password" autocomplete="off">
        <br><br>

        <div>
            <button type="submit">Login</button>

            <a href="pages/signup/signup.php" class="ca">Create an account</a>
        </div>
    </form>
</body>

</html>