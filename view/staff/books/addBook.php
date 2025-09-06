<?php 
    include_once('../../../config.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    isLogin();
    ensureStaffOrAdmin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\staff\books\bookIndex.css">
    <title>Add user</title>
</head>
<body>
    <!--Header-->
    <?php include('C:\xampp\htdocs\bookStore\view\layouts\staff\staffHeader.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>Add Book</h2>

        <form action="../../../backend/books/addBook.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
            <input type="text" name="bookName" id="bookName" placeholder="Book name" required>
            <br>
            <input type="text" name="author" id="author" placeholder="Author" required>
            <br>
            <input type="text" name="publisher" id="publisher" placeholder="Publisher" required>
            <br>
            <input type="text" name="category" id="category" placeholder="Category" required>
            <br>
            <textarea name="description" id="description" style="width: 300px; height: 150px;" placeholder="Enter description..."></textarea>
            <br>
            <input type="text" name="price" id="price" placeholder="Price" required>
            <br>
            <input type="text" name="quantity" id="quantity" placeholder="Quantity" required>
            <br>
            <input type="file" name="bookCover" id="bookCover" placeholder="Book cover">
            <br>
            <input type="submit" name="create">
            <a href="bookIndex.php">Cancel</a>
        </form>
    </div>
</body>
</html>