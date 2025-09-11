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

    <style>
        .main-content {
            background-color: #ca122f;
            flex: 1;
            padding: 100px 0; 
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .add-box{
            background-color: #fff;
            width: 350px;
            height: 450px;
            border-radius: 10px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .content1{
            background-color: #FFDE5C;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 10px;
            color: black;
            margin-bottom: 20px;
            text-align: center;
        }


        .input-group{
            position: relative;
            margin-left: 20px;
        }

        .input-group label{
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: black;
            pointer-events: none;
            transition: .3s;
            
        }

        .input-group input{
            width: 300px;
            height: 40px;
            padding: 10px 10px 10px 8px;
            border: 1.2px solid black;
            outline: none;
            border-radius: 5px;
            /* background: transparent; */
        }

        .input-group input:focus~label,
        .input-group input:valid~label{
            top: 0;
            font-size: 14px;
            background: #fff;
            color: #000;
        }


        select {
            width: 300px;
            height: 40px;
            padding: 8px 12px;
            border: 1.5px solid #333;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            background: #fff;
            color: #333;
            transition: 0.3s;
            appearance: none; 
            margin-left: 20px;
        }

        select option {
            padding: 10px;
            font-size: 16px;
        }

        .submit{
            padding: 10px 30px;
            border-radius: 10px;
            border: 2px solid black;
            background-color: #ec4964ff;
            color: #fff;
            margin-left: 50px;
        }

        .cuoi{
            text-align: center;
            margin-top: 45px;
            a{
                text-decoration: none;
                margin-left: 20px;
            }
        }
    </style>
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
                    <input type="text" name="address" id="address" required>
                    <label for="">Address</label>
                </div>

                <br>

                <div class="input-group">
                    <input type="password" name="password" id="password" required>
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