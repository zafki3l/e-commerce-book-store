<?php 
    include('../../config.php');
    include_once(ROOT_PATH . '/backend/admin/getUserToEdit.php');
    include_once(ROOT_PATH . '/connect.php');

    if (!isset($_SESSION['id'])) {
        header('Location: ../auth/login.php');
        exit();
    }

    if ($_SESSION['role'] != 3) {
        exit('You do not have permission to access this site!');
    }

    //Lấy ra user cần edit
    $user = getUserToEdit($mysqli);
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
    <!-- Header -->
    <?php include('../layouts/admin/adminHeader.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>Edit user</h2>

        <form action="../../backend/admin/editUser.php" method="post">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
            <input type="text" name="id" id="id" placeholder="id_user" value="<?php echo $user['id'] ?>" readonly>
            <br>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']) ?>" placeholder="Username" required>
            <br>
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($user['email']) ?>" placeholder="Email" required>
            <br>
            <select name="role" id="role">
                <option value="1" <?php echo ($user['role'] == 1) ? 'selected': '' ?>>User</option>
                <option value="2" <?php echo ($user['role'] == 2) ? 'selected': '' ?>>Staff</option>
                <option value="3" <?php echo ($user['role'] == 3) ? 'selected': '' ?>>Admin</option>
            </select>
            <br>
            <input type="submit">
            <a href="dashboard.php">Cancel</a>
        </form>
    </div>
</body>
</html>