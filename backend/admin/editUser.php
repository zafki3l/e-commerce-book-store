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