<?php
    include_once('../../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/orders/getOrderDetailList.php');
    include_once(ROOT_PATH . '/backend/orders/getOrderTotalPrice.php');

    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: /bookStore/view/auth/login.php');
        exit();
    }

    if ($_SESSION['role'] == 1) {
        exit('You do not have permission to access this site!');
    }

    $username = $_SESSION['username'];
    $order_id = $_GET['id'];

    $orderDetailList = getOrderDetailList($mysqli, $order_id);
    $totalPrice = getOrderTotalPrice($mysqli, $order_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\staff\orders\viewOrderDetail.css">
    <title>Order Detail</title>
</head>
<body>
    <!--Header-->
    <?php include('../../layouts/staff/staffHeader.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <h2>THIS IS ORDER DETAIL MANAGEMENT</h2>
        <h3>WELCOME, <?php echo $username; ?></h3>
        <br>
        <a href="addOrderItem.php?id=<?php echo htmlspecialchars($order_id)?>">Add order item</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order ID</th>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Book Author</th>
                    <th>Book Publisher</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDetailList as $orderDetail): ?>
                    <?php $rowTotal = $orderDetail['price'] * $orderDetail['quantity']; ?>
                    <tr>
                        <td><?php echo htmlspecialchars($orderDetail['id']) ?></td>
                        <td><?php echo htmlspecialchars($orderDetail['order_id']) ?></td>
                        <td><?php echo htmlspecialchars($orderDetail['book_id']) ?></td>
                        <td><?php echo htmlspecialchars($orderDetail['bookName']) ?></td>
                        <td><?php echo htmlspecialchars($orderDetail['author']) ?></td>
                        <td><?php echo htmlspecialchars($orderDetail['publisher']) ?></td>
                        <td><?php echo htmlspecialchars($orderDetail['price']) ?></td>
                        <td><?php echo htmlspecialchars($orderDetail['quantity']) ?></td>
                        <td><?php echo htmlspecialchars($rowTotal) ?></td>
                        <td><?php echo htmlspecialchars($orderDetail['created_at']) ?></td>
                        <td><?php echo htmlspecialchars($orderDetail['update_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="8"><b>Order Total Price</b></td>
                    <td colspan="3"><?php echo htmlspecialchars($totalPrice) ?></td>
                </tr>
            </tbody>
        </table>

        <a href="orderIndex.php">Cancel</a>
    </div>
</body>
</html>