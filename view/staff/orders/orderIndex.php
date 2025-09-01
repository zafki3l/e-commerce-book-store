<?php
    session_start();
    include('C:\xampp\htdocs\bookStore\backend\connect.php');
    include('C:\xampp\htdocs\bookStore\backend\orders\findOrder.php');
    include('C:\xampp\htdocs\bookStore\backend\orders\getOrderTotalPriceById.php');

    //Kiểm tra người dùng đã đăng nhập chưa
    if (!isset($_SESSION['id'])) {
        header('Location: /bookStore/view/auth/login.php');
        exit();
    }

    //Nếu như role = 1 thì chặn quyền truy cập
    if ($_SESSION['role'] == 1) {
        exit('You do not have permission to access this site!');
    }

    $username = $_SESSION['username'];

    $orderList = getFindOrder($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\staff\books\bookIndex.css">
    <title>Index Order</title>
</head>
<body>
    <!--Header-->
    <?php include('../../layouts/staff/staffHeader.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <h2>THIS IS ORDER MANAGEMENT</h2>
        <h3>WELCOME, <?php echo htmlspecialchars($username) ?></h3>
        <form action="orderIndex.php" method="post">
            <input type="text" name="id" id="id" placeholder="Find order by order id">
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
                    <th>User Name</th>
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
                            <td><?php echo htmlspecialchars($order['id']) ?></td>
                            <td><?php echo htmlspecialchars($order['user_id']) ?></td>
                            <td><?php echo htmlspecialchars($order['username']) ?></td>
                            <td><?php echo htmlspecialchars(getOrderTotalPriceById($mysqli, $order['id'])) ?></td>
                            <td>
                                <?php 
                                    switch($order['status']) {
                                        case 1: $statusName = 'Pending'; break;
                                        case 2: $statusName = 'Being delivered'; break;
                                        case 3: $statusName = 'Completed'; break;
                                        default: echo htmlspecialchars('Unknown');
                                    }
                                    echo htmlspecialchars($statusName);
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($order['created_at']) ?></td>
                            <td><?php echo htmlspecialchars($order['update_at']) ?></td>
                            <td><a href="viewOrderDetail.php?id=<?php echo htmlspecialchars($order['id']) ?>">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>