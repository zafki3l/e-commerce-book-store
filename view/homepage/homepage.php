<?php 
    session_start();
    $username = $_SESSION['username'] ?? ''; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/homepage/homepage.css">
    <title>Document</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/header.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>WELCOME</h2>
    </div>

    <!--Footer-->
    <?php include('../layouts/footer.php') ?>
</body>
</html>