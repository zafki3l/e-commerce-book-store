<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>REGISTER</h2>
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
</body>
</html>