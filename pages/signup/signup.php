<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href="styles/login.css">
</head>

<body>
    <form method="post" action="auth/signup_check.php">
        <h2>SIGN UP</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error">
                <?php echo $_GET['error']; ?>
            </p>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <p class="success">
                <?php echo $_GET['success']; ?>
            </p>
        <?php } ?>

        <label for="name">Name: </label>
        <?php if (isset($_GET['name'])) { ?>
            <input type="text" name="name" placeholder="Name" autocomplete="off" value="<?php echo $_GET['name']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="name" placeholder="Name"><br>
        <?php } ?>

        <label for="username">Username: </label>
        <?php if (isset($_GET['user'])) { ?>
            <input type="text" name="user" placeholder="Username" autocomplete="off"
                value="<?php echo $_GET['user']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="user" placeholder="Username"><br>
        <?php } ?>

        <label for="password">Password: </label>
        <input type="password" name="pass" placeholder="Password" autocomplete="off"><br>


        <label for="password">Repeat password: </label>
        <input type="password" name="re_pass" placeholder="Password" autocomplete="off"><br><br>


        <button type="submit">SignUp</button>
        <a href="index.php" class="ca">Already have un account?</a>
    </form>
</body>

</html>