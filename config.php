<?php
    // Đường dẫn gốc (root)
    if (!defined('ROOT_PATH')) {
        define('ROOT_PATH', __DIR__);
    }

    // Cấu hình database
    if (!defined('DB_HOST')) {
        define('DB_HOST', 'localhost');
    }
    if (!defined('DB_USER')) {
        define('DB_USER', 'root');
    }
    if (!defined('DB_PASS')) {
        define('DB_PASS', '');
    }
    if (!defined('DB_NAME')) {
        define('DB_NAME', 'bookstore');
    }
?>
