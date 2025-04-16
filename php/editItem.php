<?php
session_start();
include('databaseConnect.php'); // Database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $field = $_POST['field'];
    $value = $_POST['value'];
    $user_id = $_SESSION['user_id'];

    // Direct SQL query to update the item
    $sql = "UPDATE grocery_items SET $field = '$value' WHERE item_id = '$item_id' AND user_id = '$user_id'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
