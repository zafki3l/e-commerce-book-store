<?php 
    include('../../backend/connect.php');
    include('../../backend/admin/getUserList.php');
    $userList = getUserList($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/auth/login.css">
    <title>Document</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/header.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>THIS IS ADMIN DASHBOARD</h2>
        <a href="addUser.php">Add user</a>
        <a href="editUser.php">Edit user</a>
        <a href="deleteUser.php">Delete user</a>
        
        <table border="1">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
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
                        <td><?php echo $user['password'] ?></td>
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

    <!--Footer-->
    <?php include('../layouts/footer.php') ?>
</body>
</html>