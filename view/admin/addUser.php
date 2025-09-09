<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    isLogin();
    ensureAdmin();  

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
        <div class="add-box">
            <div class="content1">
                <h2>Add User</h2>
            </div>
        
        <div class="content2">
            <form action="../../backend/admin/addUser.php" method="post">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                <div class="input-group">
                    <input type="text" name="username" id="username" required>
                    <label for="">User name</label>
                </div>
                
                <br>

                <div class="input-group">
                    <input type="text" name="email" id="email" required>
                    <label for="">Email</label>
                </div>

                <br>

                <div class="input-group">
                    <input type="text" name="password" id="password" required>
                    <label for="">Password</label>
                </div>

                <br>
                <select name="role" id="role" required>
                    <option value="1">User</option>
                    <option value="2">Staff</option>
                    <option value="3">Admin</option>
                </select>
                <br>

                <div class="cuoi">
                    <input class="submit" type="submit">
                    <a href="dashboard.php">Cancel</a>
                </div>
               
            </form>           
        </div>

        </div>
    </div>
</body>
</html>