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
    <title>Document</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/admin/adminHeader.php') ?>

    <!--Main content-->
    <div class="main-content">
    <div class="dashboard-header">
        <h2>Admin Dashboard</h2>
        <h3>Welcome, <?php echo htmlspecialchars($username); ?></h3>
    </div>

    <div class="dashboard-actions">
        <form action="dashboard.php" method="post" class="search-form">
            <input type="text" name="user" id="user" placeholder="Find user by name or id">
            <input type="submit" value="Search" id="submit">
        </form>
        <a href="addUser.php" class="btn">+ Create user</a>
    </div>

    <div class="dashboard-table">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($userList as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']) ?></td>
                        <td><?php echo htmlspecialchars($user['username']) ?></td>
                        <td><?php echo htmlspecialchars($user['email']) ?></td>
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
                            <a href="editUser.php?id=<?php echo htmlspecialchars($user['id']) ?>" class="btn btn-edit">Edit</a>
                            <form action="../../backend/admin/deleteUser.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                <button type="submit" class="btn btn-delete">Delete</button>
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