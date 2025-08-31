<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/admin/findIdToEditUser.css">
    <title>Find user id to edit</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/admin/adminHeader.php') ?>

    <div class="main-content">
        <form action="editUser.php">
            <input type="text" name="id" placeholder="User id">
            <input type="submit">
            <a href="dashboard.php">cancel</a>
        </form>
    </div>
</body>
</html>

<?php include('C:\xampp\htdocs\bookStore\backend\admin\findIdToEditUser.php') ?>