<?php
    session_start();
    include('C:\xampp\htdocs\bookStore\backend\connect.php');
    include('C:\xampp\htdocs\bookStore\backend\orders\findOrder.php');


    if (!isset($_SESSION['id'])) {
        header('Location: /bookStore/view/auth/login.php');
        exit();
    }

    if ($_SESSION['role'] == 1) {
        exit('You do not have permission to access this site!');
    }

    $username = $_SESSION['username'];
    $orderList = getFindOrder($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bookStore/public/books/indexBook.css">
    <title>Index Order</title>
</head>
<body>
    <!--Header-->
    <?php include('../../layouts/staff/staffHeader.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <h2>THIS IS ORDER MANAGEMENT</h2>
        <h3>WELCOME, <?php echo $username; ?></h3>
        <form action="orderIndex.php" method="post">
            <input type="text" name="order" id="order" placeholder="Find order by order id or user id">
            <input type="submit">
        </form>
        <br>
        <a href="addOrder.php">Create Order</a>
        <a href="editOrder.php">Edit Order</a>
        <a href="deleteOrder.php">Delete Order</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>View Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($orderList as $order): ?>
                        <tr>
                            <td><?php echo $order['id'] ?></td>
                            <td><?php echo $order['user_id'] ?></td>
                            <td><?php echo '0.00' ?></td>
                            <td>
                                <?php 
                                    if ($order['status'] == 1) {
                                        echo 'pending';
                                    } else if ($order['status'] == 2) {
                                        echo 'being delivered';
                                    } else if ($order['status'] == 3) {
                                        echo 'completed';
                                    } else {
                                        echo 'unknown';
                                    }
                                ?>
                            </td>
                            <td><?php echo $order['created_at'] ?></td>
                            <td><?php echo $order['update_at'] ?></td>
                            <td><a href="viewOrderDetail.php?id=<?php echo $order['id'] ?>">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>