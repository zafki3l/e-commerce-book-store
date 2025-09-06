<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32)); // tạo token ngẫu nhiên
    }

    function isLogin() 
    {   
        // Nếu như chưa đăng nhập thì chuyển về trang login
        if (!isset($_SESSION['id'])) {
            header('Location: ../auth/login.php');
            exit();
        }
    }

    function ensureAdmin() 
    {
        // Chỉ có admin mới được truy cập
        if ($_SESSION['role'] != 3) {
            exit('You do not have permission to access this site!');
        }   
    }

    function ensureStaffOrAdmin()
    {
        // Chỉ có staff và admin mới được truy cập
        if ($_SESSION['role'] !== 2 && $_SESSION['role'] !== 3) {
            exit('You do not have permission to access this site!');
        }
    }

    // Kiểm tra user đã tồn tại chưa
    function checkUserExist($mysqli, $email) 
    {
        $stmt = $mysqli->prepare(
            "SELECT role FROM users
            WHERE email = ?"
        );        

        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        return $user;
    }
?>