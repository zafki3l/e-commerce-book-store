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
    <link rel="stylesheet" href="\bookStore\public\css\staff\orders\addOrders.css">
    <title>Add order</title>
</head>
<body>
    <!--Header-->
    <?php include('C:\xampp\htdocs\bookStore\view\layouts\staff\staffHeader.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>Add order</h2>

        <form action="/bookStore/backend/orders/addOrder.php" method="post">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
            <input type="text" name="user_id" id="user_id" placeholder="User id" required>
            <br>
            <input type="submit">
            <a href="orderIndex.php">Cancel</a>
        </form>
    </div>
</body>
</html>