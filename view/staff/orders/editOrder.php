<?php 
    include_once('../../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/orders/getIdToEditOrder.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    isLogin();
    ensureStaffOrAdmin();

    $order = getIdToEditOrder($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bookStore/public/css/staff/orders/editOrder.css">
    <title>Edit order</title>
</head>
<body>
    <!--Header-->
    <?php include('../../layouts/staff/staffHeader.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <div class="add-box">
            <div class="content1">
                <h2>Edit Order</h2>
            </div>

            <div class="content2">


                <form action="/bookStore/backend/orders/editOrder.php" method="post">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">

                    <div class="input-group">
                        <label for="">Order id</label>
                        <input type="text" name="id" id="id" value="<?php echo htmlspecialchars($order['id']) ?>" readonly>
                    </div>
                    <br>

                    <div class="input-group">
                        <label for="">User id</label>
                        <input type="text" name="user_id" id="user_id" value="<?php echo htmlspecialchars($order['user_id']) ?>">
                    </div>
                    <br>

                    <div class="input-group">
                        <label for="">Status</label>   
                        <br>                    
                        <input type="text" name="status" id="status" value="<?php echo htmlspecialchars($order['status']) ?>">
                    </div>
                    <br>

                    <div class="cuoi">
                        <input class="submit" type="submit">
                        <a href="orderIndex.php">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>