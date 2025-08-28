<?php
    include(__DIR__ . '/../connect.php');
    function getUserList($conn)
    {
        $sql = 'SELECT * FROM users';
        $userList = [];

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            echo 'Error';
        } else {
            while($user = mysqli_fetch_assoc($query)) {
                $userList[] = $user;
            }
        }

        return $userList;
    }
?>