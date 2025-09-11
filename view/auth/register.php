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
        <div class="register-container">
            <h2>REGISTER</h2>
            <form action="../../backend/auth/registerLogic.php" method="post">
                <div>
                    <div>
                        <label for="username">Username: *</label>
                        <input type="text" name="username" id="username" placeholder="Username" required>
                    </div>
                    <div>
                        <label for="email">Email: * </label>
                        <input type="email" name="email" id="email" placeholder="email" required>
                    </div>
                    <div>
                        <label for="address">Address: * </label>
                        <input type="text" name="address" id="address" placeholder="address" required>
                    </div>
                    <div>
                        <label for="password">Password: *</label>
                        <input type="password" name="password" id="password" placeholder="password" required>
                    </div>
                    <div>
                        <label for="password-confirmation">Password confirm: *</label>
                        <input type="password" name="password-confirmation" id="password-confirmation" placeholder="Confirm your password" required>
                    </div>
                </div>
                <div>
                    <button type="submit">Register</button>
                </div>
            </form>
            <p>
                Already have an account?
                <a href="login.php">Login</a>
            </p>
        </div>
    </div>
    <!--Footer-->
    <?php include('../layouts/footer.php'); ?>
</body>
</html>