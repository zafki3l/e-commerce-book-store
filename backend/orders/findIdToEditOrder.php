<?php
    include_once __DIR__ . '/../connect.php';
    function findIdToEditOrder($mysqli)
    {
        $data = [];

        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare("SELECT * FROM orders WHERE id = ?");


        /**
         * - Nếu người dùng đã nhập id thì lưu id đã nhập vào $id
         * - Nếu chưa thì lấy id = 1
         */
        if(!empty($_GET['id'])) {
            $id = $_GET['id']; 
        } else {
            $sql = $mysqli->query("SELECT * FROM orders ORDER BY id LIMIT 1");

            $query = $sql->fetch_assoc();
            $id = $query['id'];
        }

        /**
         * - Truyền dữ liệu nhập vào từ form vào câu truy vấn
         * - Thực thi câu truy vấn
         * - Lấy ra kết quả và chuyển nó về mảng kết hợp (Associative Array)
         */
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data;
    }
?>