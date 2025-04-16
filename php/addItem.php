<?php
session_start();
require '../databaseConnect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$list_id = $_SESSION['list_id'];
$name = $_POST['name'];
$type = $_POST['type'];
$qty = $_POST['qty'];

$sql = "INSERT INTO list_items (user_id, list_id, item_name, item_type, item_qty, item_done)
        VALUES ('$user_id', '$list_id', '$name', '$type', '$qty', 0)";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to add item']);
}
?>
