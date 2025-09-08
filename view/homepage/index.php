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
    <title>homepage</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/header.php') ?>
    <div class="header">
        <ul type="none" class="user-menu">
            <div class="search-bar">
                <form action="\bookStore\view\homepage\searchResult.php" method="get">
                    <input type="text" name="search" placeholder="Search books..."/>
                </form> 
            </div>
        </ul>
    </div>

    <!--Main content-->
    <div class="main-content">
        <!--NEW BOOKS-->
        <?php include('../bookSection/newBooks.php') ?>

        <?php include('../bookSection/onSales.php') ?>

        <?php include('../bookSection/bestSeller.php') ?>
    <!--Footer-->
    <?php include('../layouts/footer.php') ?>
</body>
</html>