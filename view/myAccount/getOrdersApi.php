<?php
include_once(__DIR__ . '/../../config.php');
include_once(ROOT_PATH . '/backend/auth/authUser.php');
include_once(ROOT_PATH . '/connect.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

isLogin();

$userId = $_SESSION['id'] ?? null;

if (!$userId) {
    http_response_code(401);
    echo json_encode(["error" => "Not logged in"]);
    exit;
}

$sql = "SELECT 
            o.id AS orderId, 
            o.status, 
            o.created_at,
            SUM(od.quantity) AS totalQuantity,
            SUM(od.quantity * od.price) AS totalPrice,
            GROUP_CONCAT(b.bookName SEPARATOR ', ') AS bookNames,
            GROUP_CONCAT(b.bookCover SEPARATOR ',') AS bookCovers
        FROM orders o
        JOIN orderDetails od ON o.id = od.order_id
        JOIN books b ON od.book_id = b.id
        WHERE o.user_id = ?
        GROUP BY o.id, o.status, o.created_at
        ORDER BY o.created_at DESC";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

$baseUrl = "http://localhost/bookStore/public/images/";

while ($row = $result->fetch_assoc()) {
    $covers = array_map('trim', explode(',', $row['bookCovers']));
    $covers = array_map(function($cover) use ($baseUrl) {
        return $baseUrl . $cover;
    }, $covers);
    $row['bookCovers'] = $covers;

    $row['bookNames'] = array_map('trim', explode(',', $row['bookNames']));

    switch ((int)$row['status']) {
        case 1: $row['statusText'] = "Pending"; break;
        case 2: $row['statusText'] = "Being Delivered"; break;
        case 3: $row['statusText'] = "Completed"; break;
        default: $row['statusText'] = "Unknown";
    }

    $orders[] = $row;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($orders, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
