<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/connect.php');

    //Bắt đầu SESSION để lưu thông tin đăng nhập của user
    session_start();

    //Lưu thông tin nhập vào của user vào biến 
    $email = $_POST['email'];
    $password = $_POST['password'];

    /**
     * Lấy thông tin user theo email (do email là UNIQUE nên chỉ trả về 1 kết quả)
     * Sử dụng prepared statement để chống tấn công SQL Injection
     */
    $stmt = $mysqli->prepare(
        "SELECT id, username, email, password, role 
        FROM users
        WHERE email = ?"
    );

    /**
     * - Gắn email của người dùng nhập vào câu lệnh truy vấn theo kiểu string
     * - Sau khi gắn dữ liệu, sử dụng execute để thực thi câu truy vấn
     * - Lấy ra kết quả truy vấn và chuyển nó thành mảng kết hợp (Associative Array)
     */
    $stmt->bind_param('s', $email); 
    $stmt->execute(); 
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    /** 
     * - Kiểm tra thông tin đăng nhập
     * - Nếu user không tồn tại hoặc mật khẩu không trùng khớp -> chuyển về trang login kèm error = 1
     * - Nếu thông tin nhập vào đúng thì lưu thông tin user vào SESSION
     */
    if (!$data || !password_verify($password, $data['password'])) {
        header('Location: ../../view/auth/login.php?error=1');
        exit();
    } else {
        // Lưu thông tin của users vào trong Session
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['role'] = $data['role'];

        header('Location: ../../view/homepage/index.php');
        exit();
    }
?>