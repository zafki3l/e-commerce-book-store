<?php
    include_once('../../config.php');
    include_once(ROOT_PATH . '/connect.php');    
    
    function getIdToEditBook($mysqli)
    {
        $id = $_GET['id'];
        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare("SELECT * FROM books WHERE id = ?");
     
        /**
         * - Truyền id nhập vào từ form vào câu truy vấn
         * - Thực thi truy vấn
         * - Lấy ra kết quả truy vấn
         * - Chuyển thành mảng kết hợp (Associative Array)
         */
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $book = $result->fetch_assoc();

        return $book;
    }
?>