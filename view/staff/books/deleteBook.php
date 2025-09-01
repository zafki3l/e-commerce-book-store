<?php 
    session_start();

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
    <link rel="stylesheet" href="\bookStore\public\css\staff\books\deleteBook.css">
    <title>Delete book</title>
</head>
<body>
    <!--Header-->
    <?php include('C:\xampp\htdocs\bookStore\view\layouts\staff\staffHeader.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>Type a book id to delete</h2>

        <form action="../../../backend/books/deleteBook.php" method="post">
            <input type="text" name="id" id="id" placeholder="id" required>
            <input type="submit">
            <a href="bookIndex.php">Cancel</a>
        </form>
    </div>
</body>
</html>