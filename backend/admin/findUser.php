<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    // KIỂM TRA ĐĂNG NHẬP VÀ QUYỀN TRUY CẬP
    isLogin();
    ensureAdmin();

    function getFindUser($mysqli)
    {
        $data = [];

        //Nếu như người dùng nhập vào thì trả ra kết quả tìm kiếm
        if (isset($_POST['user'])) {
            //Lưu dữ liệu nhập vào
            $user_input = $_POST['user'];
            $user_id = $user_input;
            $username = "%$user_input%";

            //Sử dụng prepared statement để chống SQL Injection
            $stmt = $mysqli->prepare(
                "SELECT * FROM users
                WHERE id = ?
                OR username LIKE ?"
            );

            /**
             * - Truyền tham số nhập vào của user vào câu truy vấn
             * - Thực thi câu truy vấn
             * - Lấy ra kết quả và chuyển thành mảng kết hợp (Associative Array)
             */
            $stmt->bind_param('is', $user_id, $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
        } else { //Chưa thì vẫn hiển thị tất cả kết quả
            $sql = $mysqli->query("SELECT * FROM users");

            $data = $sql->fetch_all(MYSQLI_ASSOC);
        }

        return $data;
    }
?>