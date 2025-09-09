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
    <link rel="stylesheet" href="/bookStore/public/css/staff/books/addBook.css">
    <title>Add book</title>
</head>
<body>
    <!--Header-->
    <?php include('../../layouts/staff/staffHeader.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <div class="add-box">
            <div class="content1">
                <h2>Add Book</h2>
            </div>

            <div class="content2">
                <form action="../../../backend/books/addBook.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                    <div class="input-group">
                        <input type="text" name="bookName" id="bookName" required>
                        <label for="">Book Name</label>
                    </div>
                    
                    <br>

                    <div class="input-group">
                        <input type="text" name="author" id="author" required> 
                        <label for="">Author</label>                      
                    </div>

                    <br>

                    <div class="input-group">
                        <input type="text" name="publisher" id="publisher" required>
                        <label for="">Publisher</label>
                    </div>

                    <br>
                    <div class="input-group">
                        <input type="text" name="category" id="category" required>
                        <label for="">Category</label>
                    </div>

                    <br>
                    <div class="input-group">
                        <textarea name="description" id="description" style="width: 300px; height: 150px;" placeholder="Enter description..."></textarea>
                        <label for="">Description</label>
                    </div>
                    
                    <br>
                    <div class="input-group">
                        <input type="text" name="price" id="price" required>
                        <label for="">Price</label>
                    </div>

                    <br>
                    <div class="input-group">
                        <input type="text" name="quantity" id="quantity" required>
                        <label for="">Quantity</label>
                    </div>

                    <br>
                    <input style="margin-left: 20px;" type="file" name="bookCover" id="bookCover" placeholder="Book cover">

                    <br>
                    <div class="cuoi">
                        <input class="submit" type="submit" name="create">
                        <a href="bookIndex.php">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>