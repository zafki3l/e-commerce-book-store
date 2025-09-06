<?php
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/csrf.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    session_start();

    // VALIDATE TOKEN
    validateToken($_POST['token']);

    // KIỂM TRA ĐĂNG NHẬP VÀ QUYỀN TRUY CẬP
    isLogin();
    ensureAdmin();

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