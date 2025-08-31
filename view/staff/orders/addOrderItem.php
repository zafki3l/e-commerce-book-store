<?php 
    session_start();
    
    //Kiểm tra đăng nhập
    if (!isset($_SESSION['id'])) {
        header('Location: ../auth/login.php');
        exit();
    }

    //Chặn người dùng ko có quyền truy cập
    if ($_SESSION['role'] == 1) {
        exit('You do not have permission to access this site!');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\staff\orders\addOrderItem.css">
    <title>Add order</title>
</head>
<body>
    <!--Header-->
    <?php include('C:\xampp\htdocs\bookStore\view\layouts\staff\staffHeader.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>Add order item</h2>

        <form action="/bookStore/backend/orders/addOrderItem.php" method="post">
            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($_GET['id']) ?>">
            <input type="text" name="book_id" id="book_id" placeholder="book id" required>
            <br>
            <input type="text" name="price" id="price" placeholder="price" required>
            <br>
            <input type="text" name="quantity" id="quantity" placeholder="quantity" required>
            <br>
            <input type="submit">
            <a href="orderIndex.php">Cancel</a>
        </form>
    </div>
</body>
</html>