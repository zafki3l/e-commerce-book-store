<?php 
    session_start();
    include('C:\xampp\htdocs\bookStore\backend\connect.php');
    include('findIdToEditBook.php');

    $book = findIdToEditBook($mysqli);

    if (!isset($_SESSION['id'])) {
        header('Location: ../auth/login.php');
        exit();
    }

    if ($_SESSION['role'] == 1) {
        exit('You do not have permission to access this site!');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\staff\books\editBook.css">
    <title>Add user</title>
</head>
<body>

    <!--Main content-->
    <div class="main-content">
        <h2>Edit Book</h2>

        <form action="../../../backend/books/editBook.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
            <input type="text" name="bookName" id="bookName" value="<?php echo $book['bookName'] ?>" placeholder="Book name">
            <br>
            <input type="text" name="author" id="author" value="<?php echo $book['author'] ?>" placeholder="Author">
            <br>
            <input type="text" name="publisher" id="publisher" value="<?php echo $book['publisher'] ?>" placeholder="Publisher">
            <br>
            <input type="text" name="category" id="role" value="<?php echo $book['category'] ?>" placeholder="Category">
            <br>
            <textarea name="description" id="description" style="width: 300px; height: 150px;" placeholder="Enter description..."><?php echo $book['description'] ?></textarea>
            <br>
            <input type="text" name="price" id="price" value="<?php echo $book['price'] ?>" placeholder="Price">
            <br>
            <input type="text" name="quantity" id="quantity" value="<?php echo $book['quantity'] ?>" placeholder="Quantity">
            <br>
            <input type="hidden" name="oldBookCover" value="<?php echo $book['bookCover']; ?>">
            <input type="file" name="bookCover" id="bookCover" placeholder="Book cover">
            <br>
            <input type="submit" name="edit">
        </form>
    </div>
</body>
</html>