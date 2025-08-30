<?php 
    include(__DIR__ . '/../connect.php');

    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO orders (user_id)
            VALUES ('$user_id')";
    
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: /bookStore/view/staff/orders/orderIndex.php');
        exit();
    } else {
        header('Location: /bookStore/view/staff/orders/addOrder.php');
        exit('Error');
    }
?>