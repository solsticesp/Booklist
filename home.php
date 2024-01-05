<?php
session_start();
include("db_conn.php");


if (isset($_SESSION["id"]) && isset($_SESSION["user_name"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>HOME</title>
        <link rel="stylesheet" href="homestyle.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="autocomplete.js" defer></script>

    </head>

    <body>

        <nav class="navbar bg-transparent">
            <div class="container d-flex">
                <a class="navbar-brand p-2 flex-grow-1" href="home.php">
                    <img src="./pics/owl-blue.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                    Hello,
                    <?php echo $_SESSION['user_name']; ?>!
                </a>

                <div class="nav-item p-2">

                    <div class="search-box">
                        <input type="text" id="input-box" placeholder="Search for a Book" autocomplete="off">

                        <button type="submit"><img class="search-icon" src="pics/Search_icon_xs.svg.png"></button>
                    </div>
                    
                    <div id="autosuggest" class="position-absolute bg-secondary list-group"></div>

                </div>

                <a href="logout.php" class="nav-item fs-5"><img src="pics/logout.png" alt="logout" width="35" height="40" class="d-inline-block align-text-top"></img></a>
            </div>
        </nav>

        <br>
        <h1 id="main_title">READING WISH LIST</h1>

        <div class="container">
            <div class="d-flex justify-content-end  py-2">

                <!-- <h2 class="fs-3 mb-0">ADD TO LIST </h2> -->

                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                    ADD TO LIST</button>
                    
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $currentUser = $_SESSION['id'];


                    $query = "SELECT * FROM books where `userid`='$currentUser'";

                    $result = mysqli_query($conn, $query);

                    if (!$result) {
                        echo "Query failed!";} 
                        else {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['book_title']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['book_author']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['isbn']; ?>
                                    </td>
                                    <td><a href="update_page.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-success">Update <img src="pics/update.png" width="20" height="20"></img></a></td>
                                    <td><a href="delete_book.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger">Delete <img src="pics/delete2.png" width="20" height="20"></img></a></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
                   
            <br>
            <br>
            
            <?php
            if (isset($_GET['error'])) {
                echo '<h6 class="alert alert-danger" role="alert">' . $_GET['error'] . '</h6>';
            }
            ?>

            <?php
            if (isset($_GET['insert_msg'])) {
                echo '<h5 class="alert alert-success" role="alert">' . $_GET['insert_msg'] . '</h5>';
            }
            ?>

            <?php
            if (isset($_GET['update_msg'])) {
                echo '<h5 class="alert alert-success" role="alert">' . $_GET['update_msg'] . '</h5>';
            }
            ?>

            <?php
            if (isset($_GET['delete_msg'])) {
                echo '<h5 class="alert alert-success" role="alert">' . $_GET['delete_msg'] . '</h5>';
            }
            ?>

            <!-- Modal -->
            <form action="insert_data.php" method="post">
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLongTitle">ADD BOOK</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="b_title">Title</label>
                                    <input type="text" name="b_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="author_name">Author</label>
                                    <input type="text" name="author_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="b_title">ISBN</label>
                                    <input type="text" name="b_isbn" class="form-control">
                                </div>
                                <div class="form-group d-none">
                                    <label for="u_id">User ID</label>
                                    <input type="text" name="u_id" class="form-control" value=<?php echo $_SESSION['id']; ?>>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-success" name="add_book" value="ADD"></input>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </body>

    </html>
    <?php
} else {
    header('Location: index.php');
    exit();
}
?>