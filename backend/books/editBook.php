<?php 
    include('../connect.php');
    $id = $_POST['id'];
    $bookName = $_POST['bookName'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $bookCover = $_POST['bookCover'];

    $sql = "UPDATE books
            SET bookName = '$bookName',
                author = '$author',
                publisher = '$publisher',
                category = '$description',
                price = '$price',
                quantity = '$quantity',
                bookCover = '$bookCover'
            WHERE id = '$id'";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../../view/staff/books/bookIndex.php');
        exit();
    }
?>