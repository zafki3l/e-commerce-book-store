<?php 
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../auth/login.php');
        exit();
    }

    if ($_SESSION['role'] != 3) {
        exit('You do not have permission to access this site!');
    }

    //Lưu tên đăng nhập của user vào $username
    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/admin/addUser.css">
    <title>Add user</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/admin/adminHeader.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>Add user</h2>

        <form action="../../backend/admin/addUser.php" method="post">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <br>
            <input type="text" name="email" id="email" placeholder="Email" required>
            <br>
            <input type="text" name="password" id="password" placeholder="Password" required>
            <br>
            <select name="role" id="role" required>
                <option value="1">User</option>
                <option value="2">Staff</option>
                <option value="3">Admin</option>
            </select>
            <br>
            <input type="submit">
            <a href="dashboard.php">Cancel</a>
        </form>
    </div>
</body>
</html>