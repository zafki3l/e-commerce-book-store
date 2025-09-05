<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    
    //Lưu dữ liệu nhập vào từ form vào biến
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    //Sử dụng prepared statement để chống SQL Injection
    $stmt = $mysqli->prepare(
        "UPDATE orders
        SET user_id = ?,
            status = ? -- 1: pending, 2: being delivered, 3: completed
        WHERE id = ?"
    );
    
    //Truyền dữ liệu nhập vào vào câu truy vấn
    $stmt->bind_param('iii', $user_id, $status, $id);

    //Thực thi truy vấn, nếu thành công -> trả về trang orderIndex
    if ($stmt->execute()) {
        header('Location: /bookStore/view/staff/orders/orderIndex.php');
        exit();
    }
?>