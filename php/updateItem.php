<?php
session_start();
require 'databaseConnect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error']);
    exit;
}

$item_id = $_POST['item_id'];
$column = $_POST['column'];
$value = $_POST['value'];

$allowed_columns = ['item_name', 'item_type', 'item_qty', 'item_done'];
if (!in_array($column, $allowed_columns)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid field']);
    exit;
}

$sql = "UPDATE list_items SET $column = '$value' WHERE item_id = '$item_id'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
