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
    <!-- <link rel="stylesheet" href="../../public/css/staff/dashboard.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        }

        body {
        flex-direction: column;
        min-height: 100vh;
        }

        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
        }
        
        .sidebar{
            width: 300px;
            height: 100vh;
            background-color: #faf9ea;
            color: #111014;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .name-user{
            text-align: center;
            padding-top: 15px;
            i{
                font-size: 80px;
                padding-bottom: 15px;
            }
        }

        hr{
            margin-top: 20px;
        }

        .btn{
            padding: 15px 30px 15px 5px;
            background-color: #faf9ea;
            border: none;
            font-size: 15px;
            width: 100%;
            border-radius: 10px;
            text-decoration: none;
            
        }

        .item-function{
            margin: 0px 20px;
            margin-bottom: 40px;
        }

        a:visited{
            color: black;
        }

        a:active {
            color: #ca122f;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/staff/staffHeader.php'); ?>

    <!--Main content-->
    <div class="sidebar">
        <!-- <h2>THIS IS STAFF DASHBOARD</h2> -->
        <div class="name-user">
            <i class="fa-solid fa-circle-user"></i>
            <h3>WELCOME, <?php echo htmlspecialchars($username); ?></h3>
        </div>

        <hr>
        
        <br>

        <div class="function">
            <div class="item-function">
                <i class="fa-solid fa-book"></i>
                <a href="books/bookIndex.php" class="btn">Book Management</a>
            </div>

            <div class="item-function">
                <i class="fa-solid fa-receipt"></i>
                <a href="orders/orderIndex.php" class="btn">Order Management</a>
            </div>

            <div class="item-function">
                <i class="fa-solid fa-filter"></i>
                <a href="createSalesReport.php" class="btn">Create Monthly Sales Report</a>
            </div>

        </div>
    </div>
</body>
</html>