<?php 
    session_start();
    include('C:\xampp\htdocs\bookStore\backend\connect.php');
    
    include('findIdToEditOrder.php');

    if (!isset($_SESSION['id'])) {
        header('Location: ../auth/login.php');
        exit();
    }

    if ($_SESSION['role'] == 1) {
        exit('You do not have permission to access this site!');
    }

    $order = findOrder($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\auth\login.css">
    <title>Edit order</title>
</head>
<body>

    <!--Main content-->
    <div class="main-content">
        <h2>Edit Order</h2>

        <form action="/bookStore/backend/orders/editOrder.php" method="post">
            <label for="">Order id</label>
            <input type="text" name="id" id="id" value="<?php echo $order['id'] ?>" placeholder="Order id">
            <br>
            <label for="">User id</label>
            <input type="text" name="user_id" id="user_id" value="<?php echo $order['user_id'] ?>" placeholder="User id">
            <br>
            <label for="">Status</label>
            <input type="text" name="status" id="status" value="<?php echo $order['status'] ?>" placeholder="Status">
            <br>
            <input type="submit">
            <a href="orderIndex.php">Cancel</a>
        </form>
    </div>
</body>
</html>