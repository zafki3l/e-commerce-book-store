<?php 
    session_start();
    include(__DIR__ . '/../../backend/connect.php');
    include(__DIR__ . '/../../backend/SalesReport/createSalesReport.php');

    $totalPrice = monthlyReport($mysqli);
    
    //Kiểm tra đăng nhập
    if (!isset($_SESSION['id'])) {
        header('Location: ../auth/login.php');
        exit();
    }

    //Chặn người dùng ko có quyền truy cập
    if ($_SESSION['role'] == 1) {
        exit('You do not have permission to access this site!');
    }

    $month = (!empty($_POST['month'])) ? $_POST['month'] : date('m');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\staff\createSalesReport.css">
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

        <p> 
            <?php 
                switch($month) {
                    case 1: $monthName = "January"; break;
                    case 2: $monthName = "February"; break;
                    case 3: $monthName = "March"; break;
                    case 4: $monthName = "April"; break;
                    case 5: $monthName = "May"; break;
                    case 6: $monthName = "June"; break;
                    case 7: $monthName = "July"; break;
                    case 8: $monthName = "August"; break;
                    case 9: $monthName = "September"; break;
                    case 10: $monthName = "October"; break;
                    case 11: $monthName = "November"; break;
                    case 12: $monthName = "December"; break;
                    default: echo "ERROR";
                }
            ?>
            <?php echo "Sales report of {$monthName}: " . $totalPrice ?>VNĐ
        </p>
    </div>
</body>
</html>