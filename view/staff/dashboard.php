<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    isLogin();
    ensureStaffOrAdmin();

    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/staff/dashboard.css">
    <title>Document</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/staff/staffHeader.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <h2>THIS IS STAFF DASHBOARD</h2>
        <h3>WELCOME, <?php echo htmlspecialchars($username); ?></h3>
        <br>
        <a href="books/bookIndex.php">Book Management</a>
        <br>
        <a href="orders/orderIndex.php">Order Management</a>
        <br>
        <a href="createSalesReport.php">Create Monthly Sales Report</a>
        <br>
    </div>
</body>
</html>