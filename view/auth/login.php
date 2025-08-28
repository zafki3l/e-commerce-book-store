<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/auth/login.css">
    <title>Login</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/header.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <h2>LOGIN</h2>
        <form action="../../backend/auth/loginLogic.php" method="post">
            <div>
                <input type="email" name="email" id="email" placeholder="email" required>
                <br>
                <input type="password" name="password" id="password" placeholder="password" required>
                <br>
            </div>
            <div>
                <input type="submit">
                <br>
                <p>
                    Don't have an account?
                    <a href="register.php">Register</a>
                </p>
            </div>
        </form>
    </div>
    <!--Footer-->
    <?php include('../layouts/footer.php'); ?>
</body>
</html>