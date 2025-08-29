<?php
    include('../connect.php');
    $id = $_POST['id'];

    $sql = "DELETE FROM books
            WHERE id = '$id'";
    
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../../view/staff/books/bookIndex.php');
        exit();
    }
?>