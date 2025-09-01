<?php 
    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: ../auth/login.php');
        exit();
    }

    if ($_SESSION['role'] != 3) {
        exit('You do not have permission to access this site!');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/admin/deleteUser.css">
    <title>Delete user</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/admin/adminHeader.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>Type a user id to delete</h2>

        <form action="../../backend/admin/deleteUser.php" method="post">
            <input type="text" name="id" id="id" placeholder="id" required>
            <input type="submit">
            <a href="dashboard.php">Cancel</a>
        </form>
    </div>
</body>
</html>