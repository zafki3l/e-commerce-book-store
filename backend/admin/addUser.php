<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/csrf.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    // VALIDATE TOKEN
    validateToken($_POST['token']);

    // KIỂM TRA ĐĂNG NHẬP VÀ QUYỀN TRUY CẬP
    isLogin();
    ensureAdmin();

    // Lưu dữ liệu nhập vào của user
    $username = trim((string) $_POST['username']);
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $address = trim($_POST['address']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = (int) $_POST['role'];

    // Dùng prepared statement để chống SQL Injection
    $stmt = $mysqli->prepare(
        "INSERT INTO users(username, email, address, password, role)
        VALUES (?, ?, ?, ?, ?)"
    );

    // Truyền dữ liệu nhập vào của người dùng vào câu truy vấn và thực thi truy vấn
    $stmt->bind_param('ssssi', $username, $email, $address, $password, $role);
    if ($stmt->execute()) {
        header('Location: ../../view/admin/dashboard.php');
        exit();
    }
?>