<?php 
    session_start();
    include('C:\xampp\htdocs\bookStore\backend\connect.php');
    include('findIdtoEditUser.php');

    $user = findUser($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/admin/editUser.css">
    <title>Edit user</title>
</head>
<body>

    <!--Main content-->
    <div class="main-content">
        <h2>Edit user</h2>

        <form action="../../backend/admin/editUser.php" method="post">
            <input type="text" name="id" id="id" placeholder="id_user" value="<?php echo $user['id'] ?>" required>
            <br>
            <input type="text" name="username" id="username" value="<?php echo $user['username'] ?>" placeholder="Username" required>
            <br>
            <input type="text" name="email" id="email" value="<?php echo $user['email'] ?>" placeholder="Email" required>
            <br>
            <input type="text" name="role" id="role" value="<?php echo $user['role'] ?>" placeholder="Role" required>
            <br>
            <input type="submit">
            <a href="findIdtoEditUser.php">Cancel</a>
        </form>
    </div>
</body>
</html>