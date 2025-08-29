<?php 
    include('../connect.php');

    if (isset($_POST['edit'])) {
        if (!empty($_FILES['bookCover']['name'])) {
            $id = $_POST['id'];
            $bookName = mysqli_real_escape_string($conn, $_POST['bookName']);
            $author = mysqli_real_escape_string($conn, $_POST['author']);
            $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
            $bookCover = $_POST['bookCover'];
            $status = (int) (($quantity > 0) ? "1" : "0");

            $image_name = $_FILES['bookCover']['name'];

            $tmp = explode(".", $image_name);

            $newFileName = round(microtime(true)) . '.' . end($tmp);

            $uploadPath = "C:/xampp/htdocs/bookStore/public/images/" . $newFileName;

            move_uploaded_file($_FILES['bookCover']['tmp_name'], $uploadPath);

            $sql = "UPDATE books
                    SET bookName = '$bookName',
                        author = '$author',
                        publisher = '$publisher',
                        category = '$category',
                        description = '$description',
                        price = '$price',
                        quantity = '$quantity',
                        status = '$status',
                        bookCover = '$newFileName'
                    WHERE id = '$id'";

            $query = mysqli_query($conn, $sql);

            if ($query) {
                header('Location: ../../view/staff/books/bookIndex.php');
                exit();
            }
        } else {
            $id = $_POST['id'];
            $bookName = mysqli_real_escape_string($conn, $_POST['bookName']);
            $author = mysqli_real_escape_string($conn, $_POST['author']);
            $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
            $bookCover = $_POST['oldBookCover'];
            $status = (int) (($quantity > 0) ? "1" : "0");

            $sql = "UPDATE books
                    SET bookName = '$bookName',
                        author = '$author',
                        publisher = '$publisher',
                        category = '$category',
                        description = '$description',
                        price = '$price',
                        quantity = '$quantity',
                        status = '$status',
                        bookCover = '$bookCover'
                    WHERE id = '$id'";

            $query = mysqli_query($conn, $sql);

            if ($query) {
                header('Location: ../../view/staff/books/bookIndex.php');
                exit();
            }
        }
    }
?>