<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\staff\books\findIdToEditBook.css">
    <title>Find ID to edit book</title>
</head>
<body>
    <!--Header-->
    <?php include('C:\xampp\htdocs\bookStore\view\layouts\staff\staffHeader.php') ?>
    
    <div class="main-content">
        <h2>Type a book id to edit</h2>
        <form action="editBook.php">
            <input type="text" name="id" placeholder="Book id">
            <input type="submit">
            <a href="bookIndex.php">cancel</a>
        </form>
    </div>
</body>
</html>

<?php include('C:\xampp\htdocs\bookStore\backend\books\findIdToEditBook.php') ?>