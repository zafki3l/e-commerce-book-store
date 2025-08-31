<?php
    include_once __DIR__ . '/../connect.php';
    //Lưu id nhập vào từ form
    $id = $_POST['id'];

    //Sử dụng prepared statement để chống SQL Injection
    $stmt = $mysqli->prepare(
        "DELETE FROM users WHERE id = ?"
    );

    //Truyền dữ liệu nhập vào câu truy vấn
    $stmt->bind_param('i', $id);

    //Nếu câu truy vấn được thực thi -> thành công -> chuyển về dashboard
    if ($stmt->execute()) {
        header('Location: ../../view/admin/dashboard.php');
        exit();
    }
?>