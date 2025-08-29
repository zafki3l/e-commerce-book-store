<?php 
    include('../connect.php');
    $bookName = $_POST['bookName'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $bookCover = $_POST['bookCover'];

    $sql = "INSERT INTO books(bookName, author, publisher, category, description, price, quantity, bookCover)
            VALUES ('$bookName', '$author', '$publisher', '$category', '$description', '$price', '$quantity', '$bookCover')";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../../view/staff/books/bookIndex.php');
        exit();
    }
?>