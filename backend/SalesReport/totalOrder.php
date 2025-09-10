<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');
    
    // KIỂM TRA ĐĂNG NHẬP VÀ QUYỀN TRUY CẬP
    isLogin();
    ensureStaffOrAdmin();
    
    function totalOrder($mysqli) 
    {
        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare(
            "SELECT COUNT(*) as 'totalOrder'
            FROM orders o 
            WHERE MONTH(o.created_at) = ?"
        );

        $month = (empty($_POST['month'])) ? date('m') : $_POST['month'];

        /**
         * - Truyền dữ liệu vào câu truy vấn và thực thi nó
         * - Lấy ra kết quả truy vấn
         * - Chuyển kết quả thành mảng kết hợp (Associative Array)
         */
        $stmt->bind_param('i', $month);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data['totalOrder'] ?? 0;
    }
?>