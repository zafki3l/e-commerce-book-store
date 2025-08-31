<?php
    include('C:\xampp\htdocs\bookStore\backend\connect.php'); 
    function findIdToEditBook($mysqli)
    {
        $data = [];
        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare("SELECT * FROM books WHERE id = ?");

        if(!empty($_GET['id'])) {
            $id = $_GET['id']; 
        } else {
            $id = 1;
        }

        /**
         * - Truyền id nhập vào từ form vào câu truy vấn
         * - Thực thi truy vấn
         * - Lấy ra kết quả truy vấn
         * - Chuyển thành mảng kết hợp (Associative Array)
         */
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data;
    }
?>