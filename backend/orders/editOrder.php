<?php 
    include(__DIR__ . '/../connect.php');

    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders
            SET user_id = '$user_id',
                status = '$status'
            WHERE id = '$id'";
    
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: /bookStore/view/staff/orders/orderIndex.php');
        exit();
    } else {
        header('Location: /bookStore/view/staff/orders/editOrder.php');
        exit('Error');
    }
?>