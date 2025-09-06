<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32)); // tạo token ngẫu nhiên
    }

    // Tạo token
    function generateToken() 
    {
        $_SESSION['token'] = bin2hex(random_bytes(32)); // tạo 1 chuỗi string ngẫu nhiên dài 32 bytes
        
        return $_SESSION['token'];
    }

    function generateTokenExpire() 
    {
        $_SESSION['token-expire'] = time() + 3600; // token hết hạn trong 1 giờ kể từ khi tạo

        return $_SESSION['token-expire'];
    }

    // Validate token
    function validateToken($token) 
    {
        if (!isset($_SESSION['token']) || !isset($_SESSION['token-expire'])) return false;

        if ($token !== $_SESSION['token']) return false;

        if (time() >= $_SESSION['token-expire']) return false;

        // Nếu như token hợp lệ thì unset token và return true
        unset($_SESSION['token']);
        unset($_SESSION['token-expire']);
        return true;
    }
?>