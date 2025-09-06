<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    isLogin();

    $username = $_SESSION['username'] ?? ''; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/homepage/homepage.css">
    <title>My account</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/header.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>WELCOME <?php echo $username ?></h2>
        <h3>My Order</h3>
        <ul type="none">
            <li><a href="pendingOrder.php">Pending</a></li>
            <li><a href="beingDeliveredOrder.php">Being Delivered</a></li>
            <li><a href="CompletedOrder.php">Completed</a></li>
        </ul>
    <!--Footer-->
    <?php include('../layouts/footer.php') ?>
</body>
</html>