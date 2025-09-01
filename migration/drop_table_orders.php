<?php 
    include('../backend/connect.php');

    $sql = $mysqli->query("DROP TABLE orders");

    if ($sql) {
        echo 'Drop the table successfully!<br>';
    } else {
        echo 'Cannot drop table!<br>';
    }
?>