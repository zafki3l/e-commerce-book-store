<?php 
    session_start();
    include('../../backend/connect.php');
    include('../../backend/admin/findUser.php');

    if (!isset($_SESSION['id'])) {
        header('Location: ../auth/login.php');
        exit();
    }

    if ($_SESSION['role'] != 3) {
        exit('You do not have permission to access this site!');
    }

    $username = $_SESSION['username'];

    $userList = getFindUser($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/admin/dashboard.css">
    <title>Document</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/admin/adminHeader.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>THIS IS ADMIN DASHBOARD</h2>
        <h3>WELCOME, <?php echo $username; ?></h3>
        <form action="dashboard.php" method="post">
            <input type="text" name="user" id="user" placeholder="Find user by name or id">
            <input type="submit">
        </form>
        <br>
        <a href="addUser.php">Add user</a>
        <a href="findIdtoEditUser.php">Edit user</a>
        <a href="deleteUser.php">Delete user</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($GLOBALS['userList'] as $user): ?>
                    <tr>
                        <td><?php echo $user['id'] ?></td>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td>
                            <?php 
                                if ($user['role'] == 1) {
                                    echo "User";
                                }

                                if ($user['role'] == 2) {
                                    echo "Staff";
                                }

                                if ($user['role'] == 3) {
                                    echo "Admin";
                                }
                            ?>
                        </td>
                        <td><?php echo $user['created_at'] ?></td>
                        <td><?php 
                        echo $user['update_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>