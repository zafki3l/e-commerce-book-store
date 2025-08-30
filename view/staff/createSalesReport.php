<?php 
    session_start();
    include(__DIR__ . '/../../backend/connect.php');
    include(__DIR__ . '/../../backend/SalesReport/createSalesReport.php');

    $totalPrice = monthlyReport($conn);
    
    //Kiểm tra đăng nhập
    if (!isset($_SESSION['id'])) {
        header('Location: ../auth/login.php');
        exit();
    }

    //Chặn người dùng ko có quyền truy cập
    if ($_SESSION['role'] == 1) {
        exit('You do not have permission to access this site!');
    }

    $month = $_POST['month'] ?? '';

    if ($month == '') {
        $month = date('m');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\auth\login.css">
    <title>Sales Report</title>
</head>
<body>
    <!--Header-->
    <?php include('C:\xampp\htdocs\bookStore\view\layouts\staff\staffHeader.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>Sales Report</h2>
        <form action="createSalesReport.php" method="post">
            <input type="text" name="month" id="month" placeholder="month">
            <br>
            <input type="submit">
            <a href="dashboard.php">Cancel</a>
        </form>

        <p>Sales report of 
            <?php 
            if ($month == 1) {
                echo "January";
            }
            
            if ($month == 2) {
                echo "February";
            }

            if ($month == 3) {
                echo "March";
            }

            if ($month == 4) {
                echo "April";
            }

            if ($month == 5) {
                echo "May";
            }

            if ($month == 6) {
                echo "June";
            }

            if ($month == 7) {
                echo "July";
            }

            if ($month == 8) {
                echo "August";
            }

            if ($month == 9) {
                echo "September";
            }

            if ($month == 10) {
                echo "October";
            }

            if ($month == 11) {
                echo "November";
            } 

            if ($month == 12) {
                echo "December";
            }
            ?>:

            <?php echo $totalPrice ?>VNĐ
        </p>
    </div>
</body>
</html>