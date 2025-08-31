<?php 
    include_once __DIR__ . '/../connect.php';
    //Lưu dữ liệu nhập vào của user vào biến
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $id = $_POST['id'];

    //Sử dụng prepared statement để chống SQL Injection
    $stmt = $mysqli->prepare(
        "UPDATE users
        SET username = ?, 
            email = ?,
            role = ?
        WHERE id = ?"
    );

    //Truyền dữ liệu nhập vào của user vào câu truy vấn và thực thi câu truy vấn đó
    $stmt->bind_param('sssi', $username, $email, $role, $id);
    if ($stmt->execute()) {
        header('Location: ../../view/admin/dashboard.php');
        exit();
    }
?>