<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once('authUser.php');

    // Lấy dữ liệu nhập vào của user và lưu vào biến
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Kiểm tra user đã tồn tại
    $isUserExist = checkUserExist($mysqli, $email);
    
    if ($isUserExist && $isUserExist['role'] == 0) {
        // Nếu như user tồn tại và role = 0, tức là guest, chỉ cần update thông tin và chuyển guest thành user        
        $stmt = $mysqli->prepare(
            "UPDATE users 
            SET username = ?,
                password = ?,
                role = 1
            WHERE email = ?"
        );

        $stmt->bind_param('sss', $username, $password, $email);
        $stmt->execute();
    } else if ($isUserExist && $isUserExist['role'] != 0) {
        // Nếu như role != 1 -> Không phải là guest thì báo lỗi user đã tồn tại
        header('Location: ../../view/auth/register.php?error=EmailExists');
        exit();
    } else { 
        // Nếu như user chưa tồn tại -> Tạo mới user
        $stmt = $mysqli->prepare(
            "INSERT INTO users (username, email, password)
            VALUES (?, ?, ?)"
        );

        $stmt->bind_param('sss', $username, $email, $password);
        $stmt->execute();
    }

    // Đăng ký thành công -> chuyển hướng tới trang login cho user đăng nhập
    header('Location: ../../view/auth/login.php');
    exit();
?>