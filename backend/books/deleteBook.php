<?php
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');

    //Lưu id nhập vào từ form vào biến $id
    $id = $_GET['id'];

    //Sử dụng prepared statement để chống SQL Injection
    $stmt = $mysqli->prepare(
        "DELETE FROM books WHERE id = ?"
    );
    
    //Truyền id nhập vào vào câu truy vấn
    $stmt->bind_param('i', $id);

    //Nếu thực thi thành công thì trả về trang bookIndex
    if ($stmt->execute()) {
        header('Location: ../../view/staff/books/bookIndex.php');
        exit();
    }
?>