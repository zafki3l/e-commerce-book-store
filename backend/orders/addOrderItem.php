<?php 
    include(__DIR__ . '/../connect.php');

    $order_id = $_POST['order_id'];
    $book_id = $_POST['book_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO orderDetails (order_id, book_id, price, quantity)
            VALUES ('$order_id', '$book_id', '$price', '$quantity')";
    
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("Location: /bookStore/view/staff/orders/viewOrderDetail.php?id=$order_id");
        exit();
    } else {
        header('Location: /bookStore/view/staff/orders/addOrderItem.php');
        exit('Error');
    }
?>