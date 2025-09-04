<?php
    session_start();

    //Nếu người dùng nhấn nút logout thì xóa SESSION
    if (isset($_POST['logout'])) {
        session_destroy();
        header('Location: ../../view/auth/login.php');
        exit();
    }
?>