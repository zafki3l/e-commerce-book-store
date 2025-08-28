<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/auth/login.css">
    <title>Add user</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/header.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>Type user id that you want delete</h2>

        <form action="../../backend/admin/deleteUser.php" method="post">
            <input type="text" name="id" id="id" placeholder="id" required>
            <input type="submit">
            <a href="dashboard.php">Cancel</a>
        </form>
    </div>

    <!--Footer-->
    <?php include('../layouts/footer.php') ?>
</body>
</html>