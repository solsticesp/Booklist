<?php
session_start();
include("db_conn.php");

if (isset($_SESSION["id"]) && isset($_SESSION["user_name"])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Update</title>
        <link rel="stylesheet" type="text/css" href="homestyle.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>

    <body>
        <nav class="navbar bg-transparent">
            <div class="container d-flex">
                <a class="navbar-brand p-2 flex-grow-1" href="home.php">
                    <img src="./pics/owl-blue.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                    Hello,
                    <?php echo $_SESSION['user_name']; ?>!
                </a>

                <a href="logout.php" class="nav-item fs-5"><img src="pics/logout.png" alt="logout" width="35" height="40"
                        class="d-inline-block align-text-top"></img></a>
            </div>
        </nav>

        <br>
        <h1 id="main_title">READING WISH LIST</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query = "SELECT * FROM books WHERE `id`='$id'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo "Query Failed!";
            } else {
                $row = mysqli_fetch_assoc($result);
                //  print_r($row);
            }
        }
        ?>
        <?php
        if (isset($_POST['update_book'])) {
            if (isset($_GET['id_new'])) {
                $idnew = $_GET['id_new'];
            }

            $title = $_POST['b_title'];
            $author = $_POST['author_name'];
            $isbn = $_POST['b_isbn'];

            $query = "UPDATE books SET `book_title`='$title', `book_author`= '$author', `isbn`= '$isbn' WHERE `id`= '$idnew'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo "Query Failed";
            } else {
                header("Location: home.php?update_msg=You have updated the data successfully");
            }

        }

        ?>

        <form action="update_page.php?id_new=<?php echo $id ?>" method="post">
            <div class="form-group">
                <label for="b_title">Title</label>
                <input type="text" name="b_title" class="form-control" value="<?php echo $row['book_title']; ?>">
            </div>
            <div class="form-group">
                <label for="author_name">Author</label>
                <input type="text" name="author_name" class="form-control" value="<?php echo $row['book_author']; ?>">
            </div>
            <div class="form-group">
                <label for="b_title">ISBN</label>
                <input type="text" name="b_isbn" class="form-control" value="<?php echo $row['isbn']; ?>"><br>
            </div>
            <input type="submit" class="btn btn-success" name="update_book" value="UPDATE"></input>

        </form>

        <?php
} ?>