<?php 
    include_once(__DIR__ . '/../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once('csrf.php');

    session_start();

    // VALIDATE TOKEN
    validateToken($_POST['token']);

    // Lấy thông tin người dùng đã đăng nhập
    $user_id = $_SESSION['id'] ?? 0;
    $book_id = $_POST['book_id'] ?? 0;
    $book_price = $_POST['price'] ?? 0;
    $quantity = $_POST['quantity'] ?? 1;
    $guestPassword = password_hash(hex2bin(random_bytes(32)), PASSWORD_DEFAULT);

    if ($book_id) {
        // Nếu như khách hàng đã đăng nhập
        if (!$user_id) {
            // Tạo thông tin khách hàng mới vào bảng users, cho role = 0 (Guest)
            $fullName = $_POST['fullname'];
            $email = $_POST['guest_email'];

            // Kiểm tra guest đã tồn tại trong CSDL chưa
            $stmt = $mysqli->prepare(
                "SELECT id FROM users WHERE email = ? AND role = 0"
            );

            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $guest = $result->fetch_assoc();

            /**
             * - Nếu như guest đã tồn tại thì chỉ cần update username vào id cũ
             * - Nếu như guest chưa tồn tại thì tạo mới user
             */
            if ($guest) {
                $user_id = $guest['id'];
                $stmt = $mysqli->prepare("UPDATE users SET username = ? WHERE id = ?");
                $stmt->bind_param('si', $fullName, $user_id);
                $stmt->execute();
            } else {
                $stmt = $mysqli->prepare(
                    "INSERT INTO users (username, email, password, role)
                    VALUES (?, ?, ?, 0)"
                );

                $stmt->bind_param('sss', $fullName, $email, $guestPassword);
                $stmt->execute();
                $user_id = $stmt->insert_id;
            }
        }

        // Tạo đơn hàng
        $stmt = $mysqli->prepare("INSERT INTO orders (user_id) VALUES (?)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $orderId = $stmt->insert_id;

        // Thêm chi tiết đơn hàng
        $stmt = $mysqli->prepare("INSERT INTO orderDetails (order_id, book_id, price, quantity) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iidi", $orderId, $book_id, $book_price, $quantity);
        $stmt->execute();

        header('Location: ../view/homepage/index.php');
    } else {
        echo "Can not buy! ERROR";
    }
?>