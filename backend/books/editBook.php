<?php 
    include('../connect.php');

    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $bookName = $_POST['bookName'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $bookCover = $_POST['bookCover'];

        $image_name = $_FILES['bookCover']['name'];

        $tmp = explode(".", $image_name);

        $newFileName = round(microtime(true)) . '.' . end($tmp);

        $uploadPath = "C:/xampp/htdocs/bookStore/public/images/" . $newFileName;

        move_uploaded_file($_FILES['bookCover']['tmp_name'], $uploadPath);

        $sql = "UPDATE books
                SET bookName = '$bookName',
                    author = '$author',
                    publisher = '$publisher',
                    category = '$description',
                    price = '$price',
                    quantity = '$quantity',
                    bookCover = '$newFileName'
                WHERE id = '$id'";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            header('Location: ../../view/staff/books/bookIndex.php');
            exit();
        }
    }
?>