<?php 
    include('../connect.php');

    //Lưu dữ liệu nhập vào của user
    $username = (string) $_POST['username'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = (int) $_POST['role'];

    //Dùng prepared statement để chống SQL Injection
    $stmt = $mysqli->prepare(
        "INSERT INTO users(username, email, password, role)
        VALUES (?, ?, ?, ?)"
    );

    //Truyền dữ liệu nhập vào của người dùng vào câu truy vấn và thực thi truy vấn
    $stmt->bind_param('sssi', $username, $email, $password, $role);
    if ($stmt->execute()) {
        header('Location: ../../view/admin/dashboard.php');
        exit();
    }
?>