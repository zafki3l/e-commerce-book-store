<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/auth/login.css">
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

<?php
    include('C:\xampp\htdocs\bookStore\backend\connect.php'); 
    function findUser($conn)
    {
        $id = (int) $_GET['id']; 

        $sql = "SELECT * FROM users WHERE id = '$id'";

        $query = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($query);

        return $user;
    }
?>