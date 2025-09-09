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
                <li><a href="../homepage/index.php">Homepage</a></li>
                <li><a href="/bookStore/view/admin/dashboard.php">Admin Dashboard</a></li>
            </div>

            <div class="nav-right">
                <?php if(isset($_SESSION['username'])): ?>
                    <li><a href="..\bookStore\view\myAccount\myAccount.php">Account</a></li>
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
    </div>
</body>
</html>