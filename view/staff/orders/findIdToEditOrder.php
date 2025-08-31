<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\bookStore\public\css\staff\orders\findIdToEditOrder.css">
    <title>Add user</title>
</head>
<body>
    <!--Header-->
    <?php include('C:\xampp\htdocs\bookStore\view\layouts\staff\staffHeader.php') ?>

    <!--Main content-->
    <div class="main-content">
        <h2>Find id to edit order</h2>

        <form action="editOrder.php" method="get">
            <input type="text" name="id" id="id" placeholder="Order id" required>
            <br>
            <input type="submit">
            <a href="orderIndex.php">Cancel</a>
        </form>
    </div>
</body>
</html>

<?php include('C:\xampp\htdocs\bookStore\backend\orders\findIdToEditOrder.php') ?>