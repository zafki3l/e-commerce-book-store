<?php 
    include('../connect.php');

    if (isset($_POST['create'])) {
        $bookName = $_POST['bookName'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $bookCover = $_POST['bookCover'];

        $image_name =  $_FILES['bookCover']['name'];    

        $tmp = explode(".", $image_name);

        $newFileName = round(microtime(true)) . '.' . end($tmp);

        $uploadPath = "C:/xampp/htdocs/bookStore/public/images/" . $newFileName;

        move_uploaded_file($_FILES['bookCover']['tmp_name'], $uploadPath);

        $sql = "INSERT INTO books(bookName, author, publisher, category, description, price, quantity, bookCover)
                VALUES ('$bookName', '$author', '$publisher', '$category', '$description', '$price', '$quantity', '$newFileName')";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            header('Location: ../../view/staff/books/bookIndex.php');
            exit();
        }
    }
?>