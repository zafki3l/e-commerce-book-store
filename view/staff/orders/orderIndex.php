<?php
    include_once('../../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/orders/findOrder.php');
    include_once(ROOT_PATH . '/backend/orders/getOrderTotalPriceById.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    isLogin();
    ensureStaffOrAdmin();

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
            <input type="text" name="search" id="id" placeholder="Find order by order id">
            <input type="submit">
        </form>
        <br>
        <a href="addOrder.php">Create Order</a>
        
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
                            <td>
                                <a href="editOrder.php?id=<?php echo htmlspecialchars($order['id']) ?>" class="btn btn-edit">Edit</a>
                                <form action="../../../backend/orders/deleteOrder.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($order['id']); ?>">
                                    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>