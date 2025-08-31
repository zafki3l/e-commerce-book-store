<?php
    session_start();
    include('C:\xampp\htdocs\bookStore\backend\connect.php');
    include('C:\xampp\htdocs\bookStore\backend\books\findBook.php');


    if (!isset($_SESSION['id'])) {
        header('Location: /bookStore/view/auth/login.php');
        exit();
    }

    if ($_SESSION['role'] == 1) {
        exit('You do not have permission to access this site!');
    }

    $username = $_SESSION['username'];
    $bookList = getFindBook($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\staff\books\bookIndex.css">
    <title>Index Book</title>
</head>
<body>
    <!--Header-->
    <?php include('../../layouts/staff/staffHeader.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <h2>THIS IS BOOK MANAGEMENT</h2>
        <h3>WELCOME, <?php echo $username; ?></h3>
        <form action="bookIndex.php" method="post">
            <input type="text" name="book" id="book" placeholder="Find book by name, author, or id">
            <input type="submit">
        </form>
        <br>
        <a href="addBook.php">Add book</a>
        <a href="editBook.php">Edit Book</a>
        <a href="deleteBook.php">Delete Book</a>

        
        <table border="1">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Book Cover</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach($bookList as $book): ?>
                        <tr>
                            <td><?php echo $book['id'] ?></td>
                            <td><?php echo $book['bookName'] ?></td>
                            <td><?php echo $book['author'] ?></td>
                            <td><?php echo $book['publisher'] ?></td>
                            <td><?php echo $book['category'] ?></td>
                            <td><?php echo $book['description'] ?></td>
                            <td><?php echo $book['price'] ?></td>
                            <td><?php echo $book['quantity'] ?></td>
                            <td><?php echo (($book['status'] > 0) ? "In stock" : "Out stock") ?></td>
                            <td><?php echo $book['bookCover'] ?></td>
                            <td><?php echo $book['created_at'] ?></td>
                            <td><?php echo $book['update_at'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>