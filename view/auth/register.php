<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="../../public/css/auth/register.css">
    <title>Register</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/header.php'); ?>

    <!--Main content-->
    <div class="main-content">
        <h2>REGISTER</h2>
        <form action="../../backend/auth/registerLogic.php" method="post">
            <div>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <br>
                <input type="email" name="email" id="email" placeholder="email" required>
                <br>
                <input type="password" name="password" id="password" placeholder="password" required>
                <br>
                <input type="password" name="password-confirmation" id="password-confirmation" placeholder="Confirm your password" required>
            </div>
            <div>
                <input type="submit">
                <br>
                <p>
                    Already have an account?
                    <a href="login.php">Login</a>
                </p>
            </div>
        </form>
    </div>
    <!--Footer-->
    <?php include('../layouts/footer.php'); ?>
</body>
</html>