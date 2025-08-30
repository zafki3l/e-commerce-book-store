<?php 
    include(__DIR__ . '/../connect.php');

    $id = $_POST['id'];

    $sql = "DELETE FROM orders
            WHERE id = '$id'";
    
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: /bookStore/view/staff/orders/orderIndex.php');
        exit();
    }
?>