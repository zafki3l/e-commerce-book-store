<?php 
    include_once('../../../config.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php'); 
    include_once(ROOT_PATH . '/backend/books/getIdToEditBook.php');

    isLogin();
    ensureStaffOrAdmin();

    $book = getIdToEditBook($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bookStore/public/css/staff/books/editBook.css">
    <title>Add user</title>
</head>
<body>
    <!--Header-->
    <?php include('../../layouts/staff/staffHeader.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <div class="add-box">
            <div class="content1">
                 <h2>Edit Book</h2>
            </div>

            <div class="content2">
                <form action="../../../backend/books/editBook.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                    <!-- <div class="input-group">
                        <input type="text" name="id" value="<?php echo $book['id']; ?>" readonly>
                        <label for="">Book ID</label>
                    </div>    -->
                    <br>
                    <div class="input-group">
                        <input type="text" name="bookName" id="bookName" value="<?php echo htmlspecialchars($book['bookName']) ?>">
                        <label for="">Book Name</label>
                    </div>    
                    <br>
                    <div class="input-group">
                        <input type="text" name="author" id="author" value="<?php echo htmlspecialchars($book['author']) ?>">
                        <label for="">Author</label>
                    </div>  
                    <br>
                    <div class="input-group">
                        <input type="text" name="publisher" id="publisher" value="<?php echo htmlspecialchars($book['publisher']) ?>" placeholder="Publisher">
                        <label for="">Publisher</label>
                    </div>  
                    <br>
                    <div class="input-group">
                        <input type="text" name="category" id="role" value="<?php echo htmlspecialchars($book['category']) ?>" placeholder="Category">
                        <label for="">Category</label>
                    </div> 
                    <br>
                    <div class="input-group">
                        <textarea name="description" id="description" style="width: 300px; height: 150px;" placeholder="Enter description..."><?php echo htmlspecialchars($book['description']) ?></textarea>
                        <label for="">Description</label>
                    </div> 
                    <br>
                    <div class="input-group">
                        <input type="text" name="price" id="price" value="<?php echo htmlspecialchars($book['price']) ?>" placeholder="Price">
                        <label for="">Price</label>
                    </div> 
                    <br>
                    <div class="input-group">
                        <input type="text" name="quantity" id="quantity" value="<?php echo htmlspecialchars($book['quantity']) ?>" placeholder="Quantity">
                        <label for="">Quantity</label>
                    </div>
                    <br>
                    <input type="hidden" name="oldBookCover" value="<?php echo htmlspecialchars($book['bookCover']) ?>">
                    <input style="margin-left: 20px;" type="file" name="bookCover" id="bookCover" placeholder="Book cover">
                    <br>
                    <div class="cuoi">
                        <input class="submit" type="submit" name="edit">
                        <a href="bookIndex.php">Cancel</a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>