<?php
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');
    
    // KIỂM TRA ĐĂNG NHẬP VÀ QUYỀN TRUY CẬP
    isLogin();
    ensureStaffOrAdmin();

    function getIdToEditOrder($mysqli)
    {
        $id = $_GET['id'];
        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare("SELECT * FROM orders WHERE id = ?");

        /**
         * - Truyền dữ liệu nhập vào từ form vào câu truy vấn
         * - Thực thi câu truy vấn
         * - Lấy ra kết quả và chuyển nó về mảng kết hợp (Associative Array)
         */
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();

        return $order;
    }
?>