<?php
    include('config.php');

    //Khởi tạo mysqli
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    //Kiểm tra kết nối
    if ($mysqli->connect_errno != 0) {
        echo $mysqli->connect_error;
        exit();
    }
?>