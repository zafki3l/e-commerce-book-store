<?php
    session_start();
    include('C:\xampp\htdocs\bookStore\backend\connect.php');

    if (!isset($_SESSION['id'])) {
        header('Location: /bookStore/view/auth/login.php');
        exit();
    }

    if ($_SESSION['role'] == 1) {
        exit('You do not have permission to access this site!');
    }

    $username = $_SESSION['username'];

    function getOrderDetailList($conn) 
    {
        $order_id = $_GET['id'];
        $sql = "SELECT od.id, 
                        od.order_id, 
                        od.book_id, 
                        b.bookName, 
                        b.author, 
                        b.publisher,
                        od.price,
                        od.quantity,
                        od.created_at,
                        od.update_at
        FROM orderDetails od
        INNER JOIN orders o ON od.order_id = o.id
        INNER JOIN books b ON od.book_id = b.id 
        WHERE o.id = '$order_id'";
        $result = [];

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            echo "ERROR<br>";
        } else {
            while ($value = mysqli_fetch_assoc($query)) {
                $result[] = $value;
            }
        }

        return $result;
    }

    function getOrderTotalPrice($conn) 
    {
        $order_id = $_GET['id'];
        $totalPrice = 0;

        $sql = "SELECT order_id, SUM(price * quantity) as 'TotalPrice'
                FROM orderDetails
                WHERE order_id = '$order_id'
                GROUP BY order_id";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            echo "ERROR<br>";
        } else {
            $value = mysqli_fetch_assoc($query);
            $totalPrice = $value['TotalPrice'];
        }

        return $totalPrice;
    }

    $orderDetailList = getOrderDetailList($conn);
    $totalPrice = getOrderTotalPrice($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bookStore/public/books/indexBook.css">
    <title>Order Detail</title>
</head>
<body>
    <!--Header-->
    <?php include('../../layouts/staff/staffHeader.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <h2>THIS IS ORDER DETAIL MANAGEMENT</h2>
        <h3>WELCOME, <?php echo $username; ?></h3>
        <form action="orderIndex.php" method="post">
            <input type="text" name="order" id="order" placeholder="Find order by order id or user id">
            <input type="submit">
        </form>
        <br>
        <a href="addOrder.php">Add order item</a>
        <a href="editOrder.php">Edit order item</a>
        <a href="deleteOrder.php">Delete order item</a>
        
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
                    <tr>
                        <td><?php echo $orderDetail['id'] ?></td>
                        <td><?php echo $orderDetail['order_id'] ?></td>
                        <td><?php echo $orderDetail['book_id'] ?></td>
                        <td><?php echo $orderDetail['bookName'] ?></td>
                        <td><?php echo $orderDetail['author'] ?></td>
                        <td><?php echo $orderDetail['publisher'] ?></td>
                        <td><?php echo $orderDetail['price'] ?></td>
                        <td><?php echo $orderDetail['quantity'] ?></td>
                        <th><?php 
                            $totalPrice = $orderDetail['price'] * $orderDetail['quantity'];

                            echo $totalPrice;
                        ?></th>
                        <td><?php echo $orderDetail['created_at'] ?></td>
                        <td><?php echo $orderDetail['update_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>Order Total Price</td>
                    <td><?php echo $totalPrice ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>