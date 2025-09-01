<?php
include('connect.php');

$id = $_GET['id'] ?? 0;

$stmt = $mysqli->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();
?>


