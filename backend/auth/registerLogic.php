<?php 
    include('../connect.php');
    
    //Lấy dữ liệu nhập vào của user và lưu vào biến
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //Sử dụng prepared statement để chống SQL Injection
    $stmt = $mysqli->prepare(
        "INSERT INTO users (username, email, password)
        VALUES (?, ?, ?)"
    );

    //Truyền dữ liệu nhập vào câu truy vấn
    $stmt->bind_param('sss', $username, $email, $password);

    if ($stmt->execute()) {
        //Nếu câu truy vấn được thực thi thì chuyển tới trang login
        header('Location: ../../view/auth/login.php');
        exit();
    } else {
        //Nếu không thì quay trở lại trang register
        header('Location: ../../view/auth/register.php');
        exit();
    }
?>