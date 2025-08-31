<?php
    include_once __DIR__ . '/../connect.php';
    //Hàm findUser để sửa user theo id
    function findIdtoEditUser($mysqli)
    {
        $data = [];
        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare(
            "SELECT * FROM users WHERE id = ?"
        );

        if(!empty($_GET['id'])) {
            $id = $_GET['id']; 
        } else {
            $sql = $mysqli->query("SELECT * FROM users ORDER BY id LIMIT 1");

            $query = $sql->fetch_assoc();
            $id = $query['id'];
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