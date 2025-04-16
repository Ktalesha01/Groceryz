<?php
session_start();
require 'databaseConnect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error']);
    exit;
}

$item_id = $_POST['item_id'];

$sql = "DELETE FROM list_items WHERE item_id = '$item_id'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
