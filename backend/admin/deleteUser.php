<?php
    include('../connect.php');
    $id = $_POST['id'];

    $sql = "DELETE FROM users
            WHERE id = '$id'";
    
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../../view/admin/dashboard.php');
        exit();
    }
?>