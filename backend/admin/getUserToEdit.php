<?php
    include_once('../../config.php');
    include_once(ROOT_PATH . '/connect.php');

    //Lấy ra user từ để edit
    function getUserToEdit($mysqli)
    {
        $id = $_GET['id'];

        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare(
            "SELECT * FROM users
            WHERE id = ?"
        );

        /**
         * - Truyền id của user vào câu truy vấn
         * - Thực thi câu truy vấn
         * - Lấy ra kết quả và chuyển thành mảng kết hợp (Associative Array)
         */
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        return $user;
    }
?>