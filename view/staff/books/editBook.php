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
    <!-- <link rel="stylesheet" href="\bookStore\public\css\staff\books\editBook.css"> -->
    <title>Add user</title>
    <style>
        .main-content {
            background-color: #ca122f;
            flex: 1;
            /* padding: 100px 0;  */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        html, body {
            height: 100vh;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .add-box{
            background-color: #fff;
            width: 350px;
            height: auto;
            border-radius: 10px;
            /* position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); */
            margin: 0 auto;
            margin-top: 70px;
        }

        .content1{
            background-color: #FFDE5C;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 10px;
            color: black;
            margin-bottom: 20px;
            text-align: center;
        }


        .input-group{
            position: relative;
            margin-left: 20px;
        }

        .input-group label{
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: black;
            pointer-events: none;
            transition: .3s;
            
        }

        .input-group input{
            width: 300px;
            height: 40px;
            padding: 10px 10px 10px 8px;
            border: 1.2px solid black;
            outline: none;
            border-radius: 5px;
        }

        .input-group textarea{
            width: 300px;
            height: 40px;
            padding: 10px 10px 10px 8px;
            border: 1.2px solid black;
            outline: none;
            border-radius: 5px;
        }

        .input-group input:focus~label,
        .input-group input:valid~label{
            top: 0;
            font-size: 14px;
            background: #fff;
            color: #000;
        }

        .input-group textarea:focus~label,
        .input-group textarea:valid~label{
            top: 0;
            font-size: 14px;
            background: #fff;
            color: #000;
        }

        .submit{
            padding: 10px 30px;
            border-radius: 10px;
            border: none;
            background-color: #ec4964ff;
            color: #fff;
            margin-left: 50px;
        }

        .cuoi{
            text-align: center;
            margin: 25px 0;
            padding-bottom: 10px;
            a{
                text-decoration: none;
                margin-left: 20px;
            }
        }

    </style>
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
                    <div class="input-group">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>" required>
                    </div>   
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