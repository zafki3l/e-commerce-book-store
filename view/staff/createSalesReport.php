<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/SalesReport/createSalesReport.php');
    include_once(ROOT_PATH . '/backend/SalesReport/totalOrder.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    isLogin();
    ensureStaffOrAdmin();
    
    $username = $_SESSION['username'];  
    $totalPrice = monthlyReport($mysqli);
    $totalOrder = totalOrder($mysqli);
    $month = (!empty($_POST['month'])) ? $_POST['month'] : date('m');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bookStore/public/css/staff/createSalesReport.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sales Report</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/staff/staffHeader.php'); ?>

    <div class="bookmanage">
        <div class="sidebar">
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

   
        <!--Main content-->
        <div class="main-content">
            <div class="content-right">
                <div class="content1">
                    <h2>Sales Report</h2>
                </div>

                <div class="content2">
                    <form action="createSalesReport.php" method="post">
                        <!-- <input type="text" name="month" id="book" placeholder="month"> -->
                         <select name="month" id="book">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                         </select>
                        <input type="submit" id="submit">
                        <!-- <a href="dashboard.php">Cancel</a> -->
                    </form>
                    <div class="noti">
                        <h2>
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
                            <?php echo "Sale report of {$monthName} " . ":" ?>
                            </hq>
                    </div>
                    

                    <div class="report1">
                        <div class="total">
                            <div class="order-total">
                                <div class="shopping">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </div>
                                <div class="about">
                                    <h3>Total Order</h3>
                                    <p><?php echo $totalOrder ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="income">
                            <div class="money">

                                <div class="money-icon">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                </div>
                                <div class="about">
                                    <h3>Total Income</h3>
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
                                        <?php echo $totalPrice ?>VNĐ
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</body>
</html>