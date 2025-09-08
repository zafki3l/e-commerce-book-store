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
        <div class="login-container">
            <h2>LOGIN</h2>
            <form action="../../backend/auth/loginLogic.php" method="post">
                <div>
                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" placeholder="email" required>
                    <br>
                    <label for="password">Password *</label>
                    <input type="password" name="password" id="password" placeholder="password" required>
                    <br>
                </div>
                <button type="submit">Login</button>
                <p>
                    Don't have an account?
                    <a href="register.php">Register</a>
                </p>
            </form>
        </div>
    </div>
    <!--Footer-->
    <?php include('../layouts/footer.php'); ?>
</body>
</html>