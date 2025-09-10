<?php
include_once('../../../config.php');
include_once(ROOT_PATH . '/connect.php');
include_once(ROOT_PATH . '/backend/orders/getOrderDetailList.php');
include_once(ROOT_PATH . '/backend/orders/getOrderTotalPrice.php');

header('Content-Type: application/json; charset=utf-8');

$order_id = $_GET['id'] ?? null;
if (!$order_id) {
    echo json_encode(["error" => "Missing order id"]);
    exit;
}

$orderDetailList = getOrderDetailList($mysqli, $order_id);
$totalPrice = getOrderTotalPrice($mysqli, $order_id);

echo json_encode([
    "items" => $orderDetailList,
    "totalPrice" => $totalPrice
]);
