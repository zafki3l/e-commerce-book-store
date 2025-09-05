<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    
    $sql = $mysqli->query("DROP TABLE orders");

    if ($sql) {
        echo 'Drop the table successfully!<br>';
    } else {
        echo 'Cannot drop table!<br>';
    }
?>