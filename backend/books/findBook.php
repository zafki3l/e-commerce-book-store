<?php 
    include(__DIR__ . '/../connect.php');
    function getFindBook($conn)
    {
        $book = $_POST['book'] ?? '';
        $result = [];

        $sql = "SELECT * FROM books
            WHERE id = '$book'
                OR bookName LIKE '%$book%'
                OR author LIKE '%$book%'
                OR publisher LIKE '%$book%'";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            echo "ERROR<br>";
        } else {
            while ($value = mysqli_fetch_assoc($query)) {
                $result[] = $value;
            }
        }

        return $result;
    }
?>