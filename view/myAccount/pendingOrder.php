<?php
    include_once('../../config.php');
    include_once(ROOT_PATH . '/backend/myOrder/pendingOrder.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    isLogin();

    $orders = $data;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../public/css/homepage/homepage.css">

    <title>Pending Order</title>
</head>
<body>
        <!--Header-->
    <?php include('../layouts/header.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>Pending Orders</h2>
        <h3>WELCOME, <?php echo htmlspecialchars($_SESSION['username']); ?></h3>

        <br>
        <a href="myAccount.php">Cancel</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['bookName']) ?></td>
                            <td><?php echo htmlspecialchars($order['price']) ?></td>
                            <td><?php echo htmlspecialchars($order['quantity']) ?></td>
                            <td><?php echo htmlspecialchars($order['price'] * $order['quantity']) ?></td>
                            <td><?php echo htmlspecialchars($order['status'] == 1 ? "Pending" : "Unknown") ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>

    <!--Footer-->
    <?php include('../layouts/footer.php') ?>
</body>
</html>