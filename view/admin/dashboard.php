<?php 
    include('../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/admin/findUser.php');

    //Lưu tên đăng nhập của users vào $username
    $username = $_SESSION['username'];

    //Lấy ra danh sách users
    $userList = getFindUser($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/admin/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/admin/adminHeader.php') ?>

    <!--Main content-->
    <div class="main-content">

            <div class="table-ad">
                <div class="content1">

                    <h2>THIS IS ADMIN DASHBOARD</h2>
                    <h3>WELCOME, <?php echo $username; ?></h3>
                </div>
            
                <div class="content2">
                    <form action="dashboard.php" method="post">
                        <input type="text" name="user" id="user" placeholder="Find user by name or id">
                        <input type="submit" id="submit">
                    </form>
                    <br>
                    <!-- <a href="addUser.php">
                        <button>Create user</button>
                    </a> -->
                    <a href="addUser.php" class="btn">Create User</a>
                </div>

                <table border="1">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th style="width: 20%;">Username</th>
                            <th style="width: 20%">Email</th>
                            <th style="width: 10%">Address</th>
                            <th style="width: 10%">Role</th>
                            <th style="width: 15%">Created at</th>
                            <th style="width: 15%">Updated at</th>
                            <th style="width: 15%">Action</th>
                    </tr>
            </thead>
            <tbody>
                <?php foreach($userList as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']) ?></td>
                        <td><?php echo htmlspecialchars($user['username']) ?></td>
                        <td><?php echo htmlspecialchars($user['email']) ?></td>
                        <td><?php echo htmlspecialchars($user['address']) ?></td>
                        <td>
                            <?php 
                                switch ($user['role']) {
                                    case 0: $roleName = 'Guest'; break;
                                    case 1: $roleName = 'User'; break;
                                    case 2: $roleName = 'Staff'; break;
                                    case 3: $roleName = 'Admin'; break;
                                    default: $roleName = 'Unknown';
                                }
                                echo htmlspecialchars($roleName);
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($user['created_at']) ?></td>
                        <td><?php echo htmlspecialchars($user['update_at']) ?></td>
                        <td>
                            <a href="editUser.php?id=<?php echo htmlspecialchars($user['id']) ?>" class="btn">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form class="action" action="../../backend/admin/deleteUser.php" method="post">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                <button type="submit" class="btn">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>