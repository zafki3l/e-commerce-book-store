<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/connect.php');

    //Lưu dữ liệu nhập vào vào biến
    $user_id = $_POST['user_id'];

    //Sử dụng prepared statement để chống SQL Injection
    $stmt = $mysqli->prepare(
        "INSERT INTO orders (user_id)
        VALUES (?)"
    );

    //Truyền dữ liệu nhập vào vào câu truy vấn
    $stmt->bind_param('i', $user_id);

    //Nếu như tạo order thành công thì chuyển về trang orderIndex
    if ($stmt->execute()) {
        header('Location: /bookStore/view/staff/orders/orderIndex.php');
        exit();
    }
?>