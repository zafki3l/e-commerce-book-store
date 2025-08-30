<?php 
    $role = $_SESSION['role'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/layouts/header.css">
    <title>Document</title>
</head>
<body>
    <div class="header">
        <ul type="none" class="nav-menu">
            <div class="nav-left">
                <li><a href="#">Books Category</a> </li>
                <li><a href="../homepage/homepage.php">Homepage</a></li>
                <?php if($role == 3): ?> <!--admin-->
                        <li><a href="../admin/dashboard.php">Admin Dashboard</a></li> <!--show dashboard for admin-->
                        <li><a href="../staff/dashboard.php">Staff Dashboard</a></li>
                <?php elseif($role == 2): ?>
                        <li><a href="../staff/dashboard.php">Staff Dashboard</a></li> <!--Show dashboard for staff-->
                <?php endif; ?>
                <li><a href="#">On Sales</a></li>
                <li><a href="#">New Books</a></li>
            </div>

            <div class="nav-right">
                <?php if(isset($_SESSION['username'])): ?>
                    <li><a href="#">Account</a></li>
                    <li>
                        <a href="#" onclick="document.getElementById('logoutForm').submit(); return false;">Logout</a>
                    </li>
                    <form id="logoutForm" action="../../backend/auth/logoutLogic.php" method="post" style="display:none;">
                        <input type="hidden" name="logout" value="1">
                    </form>
                <?php else: ?>
                    <li><a href="../auth/register.php">Register</a></li>
                    <li><a href="../auth/login.php">Login</a></li>
                <?php endif; ?>
            </div>
        </ul>
        <ul type="none" class="user-menu">
            <div class="search-bar">
                <form action="#" method="get">
                    <input type="text" name="name" placeholder="Search books..."/>
                </form>
            </div>
        </ul>
    </div>
</body>
</html>