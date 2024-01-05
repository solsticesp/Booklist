<?php

include "db_conn.php";


if(isset($_POST['add_book'])){

    $title = $_POST['b_title'];
    $author = $_POST['author_name'];
    $isbn = $_POST['b_isbn'];
    $u_id = $_POST['u_id'];

    if($title == "" || empty($title)){
        header('Location:home.php?error=You need to fill in the title!');
        exit();
    }
    else if($author == "" || empty($author)){
        header('Location:home.php?error=You need to fill in the author!');
        exit();
    }
    else if($isbn == "" || empty($isbn)){
        header('Location:home.php?error=You need to fill in the isbn!');
        exit();
    }
    else{
        
        $query = "INSERT INTO books (`book_title`, `book_author`, `isbn`, `userid`) VALUES ('$title', '$author', '$isbn', '$u_id')";

        $result = mysqli_query($conn,$query);

        if(!$result){
            echo "Query Failed";
        }
        else {
            header("Location: home.php?insert_msg=Your data has been added succssfuly");
        }

    }

}
?>