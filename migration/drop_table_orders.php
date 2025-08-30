<?php 
    include('../backend/connect.php');

    $sql = "DROP TABLE orders";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo 'Drop the table successfully!<br>';
    } else {
        echo 'Cannot drop table!<br>';
    }
?>