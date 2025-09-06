<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/csrf.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    // VALIDATE TOKEN
    validateToken($_POST['token']);

    // KIỂM TRA ĐĂNG NHẬP VÀ QUYỀN TRUY CẬP
    isLogin();
    ensureStaffOrAdmin();

    //Lưu dữ liệu nhập vào vào biến
    $order_id = $_POST['order_id'];
    $book_id = $_POST['book_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    //Sử dụng prepared statement để chống SQL Injection
    $stmt = $mysqli->prepare(
        "INSERT INTO orderDetails (order_id, book_id, price, quantity)
        VALUES (?, ?, ?, ?)"
    );

    //Truyền dữ liệu nhập vào từ form vào câu truy vấn và thực thi
    $stmt->bind_param('iidi', $order_id, $book_id, $price, $quantity);

    if ($stmt->execute()) {
        header("Location: /bookStore/view/staff/orders/viewOrderDetail.php?id=$order_id");
        exit();
    }
?>