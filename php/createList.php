<?php
session_start();
require 'databaseConnect.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$list_name = trim($_POST['list_name']);

// Validate input
if (empty($list_name)) {
    echo json_encode(['success' => false, 'message' => 'List name is required']);
    exit;
}

// SQL query (no escaping)
$sql = "INSERT INTO grocery_lists (user_id, list_name, shared, shared_with, shared_permissions)
        VALUES ('$user_id', '$list_name', 0, '', 'edit')";

if (mysqli_query($conn, $sql)) {
    $list_id = mysqli_insert_id($conn);
    $_SESSION['list_id']= $list_id;
    echo json_encode(['success' => true, 'list_id' => $list_id]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
}
?>
